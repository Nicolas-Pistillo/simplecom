@extends('layouts.dashboards.admin')

@section('title', 'Envíos personalizados')
    
@section('content')
    @livewire('admin.delivery-methods.custom-shippings.index')
@endsection