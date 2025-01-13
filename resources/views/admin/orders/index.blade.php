@extends('layouts.dashboards.admin')

@section('title', 'Pedidos - Listado')

@section('content')

    <div class="px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:items-center mb-5">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Pedidos</h1>
                <p class="mt-2 text-sm text-gray-700">
                    En esta sección podras gestionar, configurar y activar las diferentes pasarelas y formas
                    de pago que Simplecom ofrece para tu comercio. Recordá descargar y leer los instructivos
                    de cada forma de pago para comenzar a operarla con tranquilidad.
                </p>
            </div>
        </div>

        @livewire('admin.orders.index')

    </div>
@endsection
