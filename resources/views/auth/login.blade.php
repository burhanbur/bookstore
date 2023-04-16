<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('front.layouts.head')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        @include('front.layouts.header')
    </header>
    <!-- Header Section End -->

    <!-- login form -->
    <div class="container">
        @if (\Session::get('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ \Session::get('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <div class="text-left">
                    <button class="site-btn"><i class="fa fa-sign-in"></i>&nbsp; Login</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        @include('front.layouts.footer')
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('front.layouts.javascript')

</body>

</html>