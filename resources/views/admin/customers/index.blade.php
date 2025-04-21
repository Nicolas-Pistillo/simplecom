@extends('layouts.dashboards.admin')

@section('title', 'Clientes - Listado')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Clientes</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Desde acá podras administrar la información de todos tus clientes o 
                    personas que hayan realizado compras en tu comercio.
                </p>
            </div>
        </div>

        @livewire('admin.customers.index')

    </div>
@endsection