<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

use Auth;
use DB;

class SsoService
{
    public function login($params)
    {
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

            if (!$data) {
                \Session::flash('error', 'Terjadi kesalahan pada sisi server');
            } elseif (!$data->status) {
                \Session::flash('error', 'Username atau password yang Anda masukkan salah');
            } else {
                $id = null;

                $check = User::where('username', $params['username'])->first();

                if (!$check) {
                    $user = new User;
                    $user->username = $data->data->username;
                    $user->email = $data->data->email;
                    $user->password = Hash::make('password123');
                    $user->save();

                    $id = $user->id;
                } else {
                    $id = $check->id;
                }

                DB::commit();
                Auth::loginUsingId($id);
            }
        } catch (Exception $ex) {
            DB::rollBack();
        }

        return redirect()->route('home');
    }

    public function check($username)
    {
        $returnValue = false;

        $data = app()->make('stdClass');
        $data->status = false;
        $data->data = null;

        try {
            if (env('APP_ENV') == 'live') {
                $url = 'https://sso.universitaspertamina.ac.id/api/username-check';
            } else {
                $url = 'http://localhost/pertamina/public/api/username-check';
            }

            $params = ['username' => $username];

            $data = postCurl($url, $params);

            if ($data->status) {
                $returnValue = true;
            }
        } catch (Exception $ex) {
            
        }

        return $returnValue;
    }
}