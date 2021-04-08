@extends('Lucmas\Reservations\Views::admin.layout.master')

@section('pageTitle', __('Reservations::admin.dashboard'))

@section('main-content')
    <div class="row border-bottom mb-3">
        <div class="col-12">
            <h3>Gestione Prodotti</h3>
        </div>
{{--        <div class="col-6 text-right">--}}
{{--            <button type="button" class="btn btn-success py-2" data-toggle="modal" data-target="#formModalProduct">--}}
{{--                @lang('Reservations::product.create_button')--}}
{{--            </button>--}}
{{--        </div>--}}
    </div>
    <products-list></products-list>
@endsection

@section('page-js')
@endsection
