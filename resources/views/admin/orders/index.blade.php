@extends('layouts.dashboards.admin')

@section('title', 'Pedidos - Listado')

@section('content')

    <div class="px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Pedidos</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Aca vas a encontrar toda la información relacionada con 
                    las ventas que vaya generando tu comercio.
                </p>
            </div>
        </div>

        @livewire('admin.orders.index')

    </div>
@endsection
