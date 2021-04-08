@extends('Lucmas\Reservations\Views::admin.layout.master')

@section('pageTitle', __('Reservations::admin.dashboard'))

@section('main-content')
    <div class="row">
        @foreach($users ?? array() as $user)
            <div class="col-6 col-lg-4">
                <div class="card card-body my-2">
                    {{$user->name}}
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('page-js')
    <script>

    </script>
@endsection
