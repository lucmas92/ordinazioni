<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('Reservations::form.login') - {{ config('app.name', 'Reseservations') }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @yield('page-css')
    {{--    @laravelPWA--}}
</head>
<body>
<div class="container-fluid" id="app">
    <reservation_qrcode></reservation_qrcode>

    <a class="btn btn-sm btn-outiline-elegant" href="/reservation/1">Tavolo 1</a>
    <a class="btn btn-sm btn-outiline-elegant" href="/reservation/2">Tavolo 2</a>
    <a class="btn btn-sm btn-outiline-elegant" href="/reservation/3">Tavolo 3</a>
</div>

<div id="bg"></div>
<footer class="footer-login fixed-bottom text-center text-muted py-2 small" style="background-color: #f5f5f5">
    Powered by <a class="text-muted" href="http://luca.massignani@altervista.org">Luca Massignani</a>
</footer>

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


</body>
