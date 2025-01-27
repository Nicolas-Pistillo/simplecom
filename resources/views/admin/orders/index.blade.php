@extends('layouts.dashboards.admin')

@section('title', 'Pedidos - Listado')

@section('content')

    <div class="px-4 sm:px-6 lg:px-8">

        @livewire('admin.orders.index')

    </div>
@endsection
