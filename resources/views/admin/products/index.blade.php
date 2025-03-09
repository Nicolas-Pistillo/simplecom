@extends('layouts.dashboards.admin')

@section('title', 'Productos - Listado')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
@endsection

@section('content')

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Productos</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Esta es la parte más importante de tu negocio 😎. Crea y administra tus productos
                    de la forma que creas más conveniente.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button href="{{ route('admin.products.create') }}" class="inline-flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Nuevo producto
                </x-button>
            </div>
        </div>

        @if (Session::has('product_created'))
            <x-toast type="success" time="5000" title="Producto creado con éxito" />
        @endif

        @if (Session::has('product_updated'))
            <x-toast type="success" time="5000" title="Producto actualizado con éxito" />
        @endif

        @livewire('admin.products.index')
    </div>

@endsection
