@extends('layouts.dashboards.superadmin')

@section('title', 'Tenants - Nuevo')

@section('content')

    <x-button type="secondary" class="inline-flex items-center" href="{{ route('superadmin.tenants.index') }}">
        <x-icon code="arrow_back" class="mr-1" /> Volver atras
    </x-button>

    <div class="space-y-10 divide-y divide-gray-900/10 mb-8">

        <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
            <div class="px-4 sm:px-0">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Información del tenant</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">
                    Aca va a ir un poco de info para ayudar a crear el tenant la proxima vez
                </p>
            </div>

            <form action="{{ route('superadmin.tenants.store') }}" method="POST" 
            class="bg-white shadow-md ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            @csrf
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        
                        <x-input class="sm:col-span-3" placeholder="Sólo minusculas y sin espacios" 
                        error="{{ $errors->first('name') }}" name="name" label="Subdominio" 
                        value="{!! old('name') !!}" />

                        <x-input class="sm:col-span-3" placeholder="Por ejemplo: Distribuidora Martinez" 
                        label="Nombre del comercio" name="ecommerce_name" error="{{ $errors->first('ecommerce_name') }}" 
                        value="{!! old('ecommerce_name') !!}" />

                        {{-- <div class="sm:col-span-6">
                            <x-input class="sm:col-span-3" placeholder="Sólo minusculas y sin espacios" 
                            label="Nombre del comercio" name="name" error="{{ $errors->first('name') }}" />
                        </div> --}}
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <x-button type="primary" submit>Crear tenant</x-button>
                </div>
            </form>
        </div>
    </div>

@endsection
