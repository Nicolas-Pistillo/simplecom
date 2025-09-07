@extends('layouts.dashboards.admin')

@section('title', 'Nuevo envío personalizado')

@section('content')
    @livewire('admin.delivery-methods.custom-shippings.upsert')
@endsection