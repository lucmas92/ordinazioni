@extends('Lucmas\Reservations\Views::layout.master')

@section('pageTitle', __('Reservations::license.info'))

@section('main-content')
    {{$message ?? ''}}
@endsection
