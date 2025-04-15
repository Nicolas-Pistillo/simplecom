@extends('layouts.dashboards.admin')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Colecciones</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Las colecciones son una forma de agrupar productos seleccionados 
                    bajo una cierta tematica (Por ejemplo "Coleccion de verano 2025"). 
                    Desde aca podras crear tus propias colecciones
                    para hacer mas interesante tu catálogo a la vista de tus clientes.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button href="https://" class="inline-flex items-center gap-1">
                    <x-icon code="add" />
                    Nueva coleccion
                </x-button>
            </div>
        </div>
    </div>
@endsection