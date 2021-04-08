@extends('Lucmas\Reservations\Views::layout.master')

@section('pageTitle', __('Reservations::license.info'))

@section('main-content')

    <reservation-products-list :table="{{ $table }}" :current_cart="{{$cart}}"></reservation-products-list>

@endsection
