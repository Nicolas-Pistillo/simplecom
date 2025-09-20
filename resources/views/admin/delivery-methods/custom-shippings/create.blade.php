@extends('layouts.dashboards.admin')

@section('title', 'Nueva forma de envío')

@section('content')
    @livewire('admin.delivery-methods.custom-shippings.upsert')
@endsection