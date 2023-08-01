<?php

namespace App\Utilities;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;

use App\Services\SsoService;

trait AuthenticatesUsers
{
    use RedirectsUsers, ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // if (env('SSO_MODE')) {
        //     switch (env('APP_ENV')) {
        //         case 'local':
        //             return Redirect::to('http://localhost/pertamina/public/sso-login?redirect_url=http://localhost/akreditasi/public/auth');
        //             break;
        //         case 'live':
        //             return Redirect::to('https://sso.universitaspertamina.ac.id/sso-login?redirect_url=https://akreditasi.universitaspertamina.ac.id/auth');
        //             break;
        //         default:
        //             break;
        //     }                     
        // } else {             
            return view('auth.login');         
        // }
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // if (env('SSO_MODE')) {
        //     if (env('APP_ENV') == 'live') {
        //         $request->password = 'password123';
        //     } else {
        //         $request->password = 'burhan123';
        //     }
        // } else {             
            $this->validateLogin($request);         
        // }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->only('username', 'password');

        if (!env('SSO_MODE')) {
            if (!$this->ssoLogin($credentials)) {
                return $this->sendFailedLoginResponse($request);
            }
        }

        if ($this->attemptLogin($request)) {
            // if ($request->hasSession()) {
            //     $request->session()->put('auth.password_confirmed_at', time());
            // }

            return $this->sendLoginResponse($request);
        }

        Session::flash('error', 'Invalid credentials');

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function ssoLogin($params)
    {
        $returnValue = false;

        $data = app()->make('stdClass');
        $data->status = false;
        $data->data = null;

        DB::beginTransaction();

        try {
            if (env('APP_ENV') == 'live') {
                $url = 'https://sso.universitaspertamina.ac.id/api/login';
            } else {
                $url = 'http://localhost/pertamina/public/api/login';
            }

            $data = postCurl($url, $params);

            if (!@$data->data) {
                \Session::flash('error', 'Username atau password yang Anda masukkan salah');
            } else {
                $id = null;

                $check = User::where('username', $params['username'])->first();

                if ($check) {
                    $id = $check->id;
                } else {
                    $user = new User;
                    $user->username = $data->data->username;
                    $user->name = $data->data->name;
                    $user->email = $data->data->email;
                    $user->email_verified_at = date('Y-m-d H:i:s');
                    $user->password = Hash::make('password123');
                    $user->save();

                    $user->assignRole('user');

                    $id = $user->id;
                }

                DB::commit();
                Auth::loginUsingId($id);

                $returnValue = true;
            }
        } catch (Exception $ex) {
            DB::rollBack();
            \Session::flash('error', $ex->getMessage());
        }

        return $returnValue;
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        $request->validate([
            $field => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        $remember = $request->filled('remember');

        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        $user = User::where($field, $request->get($this->username()))->first();

        if (!$user) {
            $service = new SsoService;
            $check = $service->check($request->get($this->username()));

            if ($check) {
                $user = User::where($field, $request->get($this->username()))->first();
            }
        }

        if (!$user) return false; 

        if (env('SSO_MODE')) {
            $this->guard()->login($user, $remember);

            return true;
        }

        if (Hash::check($request->password, $user->password)) {
            $this->guard()->attempt($this->credentials($request));

            return true;
        }

        return false;
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        if (env('SSO_MODE')) {
            $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
                ? $this->username()
                : 'username';

            return [
                $field => $request->get($this->username()),
                'password' => $request->password,
            ];
        } else {
            return $request->only($this->username(), 'password');
        }
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        if (isset($_COOKIE['token_login']) || isset($_COOKIE['username'])) {                         
            $token_login = $_COOKIE['token_login'];             
            $username = $_COOKIE['username'];
        
            if (isset($_SERVER['HTTP_COOKIE'])){                 
                $cookies = explode(';', $_SERVER['HTTP_COOKIE']);                 
                foreach ($cookies as $cookie)                 
                {                     
                    $parts = explode('=', $cookie);                     
                    $name = trim($parts[0]);                     
                    setcookie($name, '', time() - 1000);                     
                    setcookie($name, '', time() - 1000, '/');                 
                }             
            }         
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if (env('SSO_MODE')) {
            if (env('APP_ENV') == 'local') {
                return $this->loggedOut($request) ?: Redirect::to("http://localhost/pertamina/public/sso-logout?token=$token_login&username=$username");
            } else {
                return $this->loggedOut($request) ?: Redirect::to("https://sso.universitaspertamina.ac.id/sso-logout?token=$token_login&username=$username");
            }
        }

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
