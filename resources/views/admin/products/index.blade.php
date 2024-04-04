@extends('layouts.dashboards.admin')

@section('title', 'Productos - Listado')

@section('content')

    <div x-data="" class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Productos</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Los operadores son usuarios que representan al equipo de tu comercio.
                    Cada uno tendrá acceso solo a las funciones que les corresponda según el rol que les asignes.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button href="{{ route('admin.products.create') }}" class="flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Nuevo producto
                </x-button>
            </div>
        </div>

        <ul role="list" class="divide-y divide-gray-100">

            @for ($i = 0; $i < 4; $i++)
                @include('admin.products.product-item')
            @endfor

        </ul>
    </div>

@endsection
