@extends('layouts.dashboards.admin')

@section('title', 'Detalle de pedido')

@section('content')
    @livewire('admin.orders.show', compact('order'))
@endsection
