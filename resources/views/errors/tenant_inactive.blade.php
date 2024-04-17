@extends('layouts.basic')

@section('content')
    <main class="grid min-h-screen place-items-center bg-white px-6 lg:px-8">
        <div class="text-center">
            <img src="{{ URL::to('img/illustrations/server_down.svg') }}" alt="Out of service img"
            class="h-48 mx-auto mb-8">

            @if (Route::is('admin.*'))
                {{-- Ecommerce admin dashboard --}}
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                    Cuenta deshabilitada
                </h1>    

                <p class="mt-6 text-base leading-7 text-gray-600">
                    Tu cuenta se encuentra actualmente inoperativa. <br> 
                    Si crees que esto es un error sugerimos que te contactes con soporte para resolverlo.
                    <br> <br>
                    Muchas gracias
                </p>
            @else
                {{-- Ecommerce frontend --}}
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                    En mantenimiento
                </h1>    

                <p class="mt-6 text-base leading-7 text-gray-600">
                    El comercio <span class="text-blue-600">{{ tenant('ecommerce_name') }}</span>
                    se encuentra realizado tareas de mantenimiento y volvera a estar operativo a la brevedad.
                    <br> <br>
                    Muchas gracias
                </p>

                <div class="absolute bottom-4 right-4 flex items-center justify-center gap-x-6">
                    <a href="{{ route('simplecom.landing') }}" target="_blank">
                        <img src="{{ URL::to('img/simplecom/png/logo-color.png') }}" alt="Simplecom logo"
                        class="rounded-full h-28 sm:h-32 transition duration-300 hover:shadow-2xl" title="Visitar sitio oficial de Simplecom">
                    </a>
                </div>
            @endif
        </div>
    </main>
@endsection
