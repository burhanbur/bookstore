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

    <!-- Humberger Begin -->
    @include('front.layouts.humberger')
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        @include('front.layouts.header')
    </header>
    <!-- Header Section End -->

    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        @include('front.layouts.footer')
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('front.layouts.javascript')

</body>

</html>