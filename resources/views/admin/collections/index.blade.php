@extends('layouts.dashboards.admin')

@section('title', 'Colecciones - Listado')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Colecciones</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Las colecciones son una forma de agrupar productos seleccionados 
                    bajo una cierta temática (por ejemplo "Verano" o "Navidad"). 
                    Desde acá podrás crear tus propias colecciones
                    para hacer más interesante tu catálogo a la vista de tus clientes.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button :href="route('admin.collections.create')" 
                class="inline-flex items-center gap-1">
                    <x-icon code="add" />
                    Nueva coleccion
                </x-button>
            </div>
        </div>
    </div>

    @session('collection_created')
        <x-toast title="Coleccion creada con exito" type="success" />
    @endsession

    @session('collection_updated')
        <x-toast title="Coleccion actualizada con exito" type="success" />
    @endsession

    <div class="text-center pt-8">
        @livewire('admin.collections.index')
    </div>
@endsection