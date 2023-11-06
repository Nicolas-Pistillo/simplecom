@extends('layouts.basic')

@section('content')
    <div class="flex min-h-screen">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">

                <div>
                    {{-- <img class="h-24 w-auto mx-auto rounded-full" 
                    src="{{ URL::to('/img/simplecom/png/logo-simple-black.png') }}"
                        alt="Commerce logo"> --}}
                    <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">Panel de administración</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Por favor ingrese sus credenciales
                    </p>
                </div>

                <div class="mt-10">
                    <div>
                        <form action="#" method="POST" class="space-y-6">

                            <x-input type="email" required label="Email" class="border-none px-0" />

                            <x-input type="password" required label="Contraseña" class="border-none px-0" />

                            <x-button submit class="w-full" size="large">Ingresar</x-button>

                            <div class="flex items-center justify-center">
                                <div class="flex items-center">
                                    <div class="text-xs leading-6">
                                        <a href="#" class="text-blue-600 hover:underline">
                                            Olvidé mi contraseña
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block" style="filter: drop-shadow(0px 0px 8px #888)">
            <img class="absolute inset-0 h-full w-full object-cover"
                src="{{ URL::to('/img/simplecom/svg/logo-color.svg') }}"
                alt="">
        </div>
    </div>
@endsection
