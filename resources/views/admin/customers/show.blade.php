@extends('layouts.dashboards.admin')

@section('title', 'Clientes - Detalle')

@section('content')
    @livewire('admin.customers.show', compact('customer'))  
@endsection