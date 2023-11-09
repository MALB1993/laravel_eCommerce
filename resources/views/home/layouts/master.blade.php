<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/home/assets/img/favicon.png" />

    <!-- CSS
============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/home/assets/css/bootstrap.min.css" />
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="/home/assets/css/icons.min.css" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/home/assets/css/plugins.css" />
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="/home/assets/css/style.css" />
    <!-- Modernizer JS -->
    <!-- <script src="/home/assets/js/vendor/modernizr-2.8.3.min.js"></script> -->
    @yield('stylesheet')
</head>

<body>
    <div class="wrapper">

        {{-- header --}}
        @include('home.sections.header')
        @include('home.sections.mobileCanvas')

        @yield('content')

        {{-- footer --}}
        @include('home.sections.footer')

    </div>

    <!-- All JS is here
============================================ -->

    <!-- jQuery JS -->
    <script src="/home/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- Popper JS -->
    <script src="/home/assets/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/home/assets/js/bootstrap.min.js"></script>
    <!-- Plugins JS -->
    <script src="/home/assets/js/plugins.js"></script>
    <!-- Ajax Mail -->
    <script src="/home/assets/js/ajax-mail.js"></script>
    <!-- Main JS -->
    <script src="/home/assets/js/main.js"></script>
    @yield('javascript')
</body>

</html>
