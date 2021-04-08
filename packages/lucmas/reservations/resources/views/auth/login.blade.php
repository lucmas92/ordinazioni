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
    @laravelPWA
</head>
<body class="text-left">
<header class="sticky-top bg-dark" >
    <img src="{{ asset('images/logo.png') }}" alt="@lang('Reservations::form.logo')"
         class="img-responsive" style="max-height: 50px;">
</header>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-lg-5 mt-5" style="max-width: 800px">
            <div class="my-md-5">
                <div class="row justify-content-around">
                    <div class="col-12 mt-5 text-left">
                        <form method="post" action="{{ route('login', app()->getLocale()) }}">
                            @csrf
                            @if(session()->has('message'))
                                <div class="alert alert-secondary alert-dismissible bg-warning">
                                    <button type="button" class="close" data-dismiss="alert"
                                            aria-label="@lang('Reservations::form.close')">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong> @lang(session()->get('message')) </strong> <br>
                                </div>
                            @endif
                            @if (isset($errors) && $errors->any())
                                <div class="alert alert-card alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"
                                            aria-label="@lang('Reservations::form.close')">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    @foreach ($errors->all() as $error)
                                        <strong>{{ $error }}</strong> <br>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group">

                                <label for="username"
                                       class="text-dark font-weight-bold">@lang('Reservations::form.username')</label>

                                <input id="username"
                                       type="text"
                                       class="form-control py-3 border-0 rounded-0"
                                       name="username"
                                       value="{{ old('username') }}"
                                       required
                                       autocomplete="username"
                                       autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password"
                                       class="text-dark font-weight-bold">@lang('Reservations::form.password')</label>
                                <input id="password"
                                       type="password"
                                       class="form-control py-3 border-0 rounded-0"
                                       name="password"
                                       required
                                       autocomplete="password">
                            </div>
                            <div class="form-group d-flex justify-content-end mt-4">
                                <label class="checkbox checkbox-primary ">
                                    <span class="font-weight-bold">@lang('Reservations::form.remember')</span>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="checkmark bg-white"></span>
                                </label>
                            </div>
                            <div class="d-block text-center">
                                <input type="submit" class="btn btn-dark btn-rounded px-4"
                                       value="@lang('Reservations::form.login')">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer-login fixed-bottom text-center text-muted py-3" style="background-color: #f5f5f5">
    Powered by <a class="text-muted" href="http://4words.it">Luca Massignani</a>
</footer>

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

</body>
