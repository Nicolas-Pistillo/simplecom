@extends('layouts.basic')

@section('content')
    <main class="grid min-h-screen place-items-center bg-white px-6 lg:px-8">
        <div class="text-center">
            <img src="{{ URL::to('img/illustrations/server_down.svg') }}" alt="Out of service img"
            class="h-48 mx-auto mb-8">
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                Cuenta deshabilitada
            </h1>
            <p class="mt-6 text-base leading-7 text-gray-600">
                Tu cuenta se encuentra actualmente inoperativa. <br> 
                Si crees que esto es un error sugerimos que te contactes con soporte para resolverlo.
                <br> <br>
                Muchas gracias
            </p>
        </div>
    </main>
@endsection
