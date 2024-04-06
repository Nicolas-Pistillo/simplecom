@extends('layouts.dashboards.admin')

@section('title', 'Productos - Nuevo')

@section('content')

    <div class="grid grid-cols-1 gap-x-8 gap-y-10 pb-12 md:grid-cols-3">

        <div>
            <x-button href="{{ route('admin.products.index') }}" type="secondary" class="inline-flex items-center">
                <x-icon code="arrow_back" class="mr-1" />
                Volver al listado
            </x-button>
        </div>

        <h2 class="text-2xl col-span-2 text-center md:text-left font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            Nuevo producto
        </h2>

    </div>

    @livewire('admin.products.create')

@endsection
