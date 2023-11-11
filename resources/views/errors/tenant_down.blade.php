@extends('layouts.basic')

@section('content')
    <main class="grid min-h-screen place-items-center bg-white px-6 lg:px-8">
        <div class="text-center">
            <img src="{{ URL::to('img/illustrations/cancel.svg') }}" alt="Out of service img"
            class="h-48 mx-auto mb-8">
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Fuera de servicio</h1>
            <p class="mt-6 text-base leading-7 text-gray-600">
                Lo sentimos. <span class="font-semibold">{{ tenant()->ecommerce_name }}</span> no se encuentra habilitado para operar en este momento. <br>
                Por favor, vuelva a intentarlo más tarde. <br> <br>

                Muchas gracias
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('simplecom.landing') }}">
                    <img src="{{ URL::to('img/simplecom/png/logo-color.png') }}" alt="Simplecom logo"
                    class="rounded-full h-28 sm:h-36 transition duration-300 hover:shadow-2xl" title="Visitar sitio oficial de Simplecom">
                </a>
            </div>
        </div>
    </main>
@endsection
