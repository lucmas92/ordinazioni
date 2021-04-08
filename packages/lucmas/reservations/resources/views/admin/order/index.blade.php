@extends('Lucmas\Reservations\Views::admin.layout.master')

@section('pageTitle', __('Reservations::admin.dashboard'))

@section('main-content')
    <div class="row border-bottom mb-3">
        <div class="col-12">
            <h3>Gestione Ordini</h3>
        </div>
    </div>
    <orders-list></orders-list>
@endsection

@section('page-js')
@endsection
