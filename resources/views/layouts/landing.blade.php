<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title')</title>
    <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
    <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical SEO -->
    <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <script
    src="https://js.sentry-cdn.com/8d01b7652242a566ea5c5074ca8621d5.min.js"
    crossorigin="anonymous"
    ></script>
    @yield('head-style')
    @cookieconsentscripts
</head>

<body>
    <!-- Layout Content -->
    @yield('content')
    <!--/ Layout Content -->
    @yield('footer-script')
    @cookieconsentview
</body>

</html>