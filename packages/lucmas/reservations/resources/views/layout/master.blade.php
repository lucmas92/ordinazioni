<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle') - {{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    @yield('page-css')
    @laravelPWA
</head>
<body>
<header class="sticky-top bg-dark">
        <img src="{{ asset('images/logo.png') }}" alt="@lang('Reservations::form.logo')"
             class="img-responsive m-1" style="max-height: 50px;">
</header>

<div class="container-fluid" id="app">
    @yield('main-content')
</div>

<div id="bg"></div>

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script>

    $( document ).ready(function() {
        new WOW().init();
    });

</script>
@yield('page-js')
</body>
</html>
