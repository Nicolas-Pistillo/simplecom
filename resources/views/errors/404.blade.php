@extends('layouts.basic')

@section('content')
    <section class="relative isolate min-h-screen">
        <img src="https://images.unsplash.com/photo-1545972154-9bb223aac798?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=3050&q=80&exp=8&con=-15&sat=-75"
            alt="" class="absolute inset-0 -z-10 h-full w-full object-cover object-top">
        <div class="mx-auto max-w-7xl px-6 py-32 text-center sm:py-40 lg:px-8">
            <p class="text-base font-semibold leading-8 text-white">404</p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-5xl">Pagina no encontrada</h1>
            <p class="mt-4 text-base text-white/70 sm:mt-6">
                Lo sentimos, parece que la página o el recurso que intentas visitar no existe.
            </p>
            <div class="mt-10 flex justify-center">
                <a href="{{ auth('operator')->check() ? route('admin.dashboard.index') : '/' }}" class="text-sm font-semibold hover:shadow-lg p-2 rounded-full transition-colors duration-300 leading-7 hover:bg-gray-50 hover:text-black text-white flex items-center">
                    <x-icon code="keyboard_backspace" class="mr-2" />
                    Volver al inicio
                </a>
            </div>
        </div>
    </section>

    <a href="{{ route('simplecom.landing') }}" class="absolute top-6 left-0">
        <img class="h-20 sm:h-24 lg:h-32 rounded-full mx-auto"
        src="{{ URL::to('img/simplecom/png/logo-no-background.png') }}" alt="Simplecom logo">
    </a>
@endsection
