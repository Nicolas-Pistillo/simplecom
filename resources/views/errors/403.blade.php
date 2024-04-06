{{-- @extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden')) --}}

@extends('layouts.basic')

@section('content')
    <main class="grid min-h-screen place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-base font-semibold text-blue-600">403</p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">No autorizado</h1>
            <p class="mt-6 text-base leading-7 text-gray-600 w-4/5 md:w-3/4 mx-auto">
                Lo sentimos, <span class="text-gray-700 font-semibold">{{ Auth::user()->name }}</span>. 
                No tenés permiso para acceder a la página o recurso que intentas visitar, si crees que esto es un error
                contactate con el administrador de <span class="text-gray-700 font-semibold">{{ tenant('ecommerce_name') }}</span>.

                <br> <br>

                Tu rol actual: <span class="font-semibold text-blue-600"> {{ Auth::user()->role }} </span>
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <x-button size="big" type="soft" href="/admin" class="flex items-center">
                    <x-icon code="arrow_back" class="mr-2" />
                    Ir al inicio
                </x-button>
            </div>
        </div>

        <a href="{{ route('simplecom.landing') }}" target="_blank" class="fixed bottom-6 right-6 ">
            <img src="{{ URL::to('img/simplecom/png/logo-color.png') }}" alt="simplecom-logo"
            class="h-24 rounded-full shadow-md cursor-pointer">
        </a>
    </main>
@endsection
