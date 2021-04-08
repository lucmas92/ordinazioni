@extends('Lucmas\Reservations\Views::admin.layout.master')

@section('pageTitle', __('Reservations::admin.dashboard'))

@section('main-content')
    <div class="row border-bottom mb-3">
        <div class="col-12">
            <h3>Gestione Tavoli</h3>
        </div>
    </div>
    <tables-list></tables-list>
@endsection

@section('page-js')
@endsection
