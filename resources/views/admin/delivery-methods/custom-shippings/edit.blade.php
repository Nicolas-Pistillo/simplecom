@extends('layouts.dashboards.admin')

@section('title', 'Actualizar forma de envío')

@section('content')
    @livewire('admin.delivery-methods.custom-shippings.upsert', compact('method'))
@endsection