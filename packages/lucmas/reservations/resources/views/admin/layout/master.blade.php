<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle') - {{ config('app.name') }}</title>serser
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Bootstrap CSS CDN -->

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}">

    <!-- Our Custom CSS -->
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>

<div class="wrapper" id="app">

    <!-- Sidebar  -->
    <nav id="sidebar">
        @include('Lucmas\Reservations\Views::admin.layout.nav')
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="height: 70px">
            <div class="container-fluid">

                <i class="fas text-white fa-align-left h3-responsive" id="sidebarCollapse" style="cursor: pointer"></i>

                <a href="{{route('admin.dashboard')}}" class="text-center">
                    <img src="{{ asset('images/logo.png') }}" alt="@lang('Reservations::form.logo')"
                         class="img-responsive m-1" style="max-height: 50px;">
                </a>

            </div>
        </nav>


        <div class="container-fluid">
            @yield('main-content')
        </div>
    </div>
</div>

<div id="bg"></div>
<div class="overlay"></div>


<!-- JQuery -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<!-- jQuery Custom Scroller CDN -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#dismiss, .overlay').on('click', function () {
            $('#sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').addClass('active');
            $('.overlay').addClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
</script>

@yield('page-js')
</body>

</html>
