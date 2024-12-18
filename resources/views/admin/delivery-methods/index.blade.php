@extends('layouts.dashboards.admin')

@section('title', 'Formas de entrega - Listado')

@section('content')
    
    @livewire('admin.delivery-methods.upsert')

@endsection