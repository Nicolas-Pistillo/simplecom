@extends('layouts.basic')

@section('title', 'Oficina central')

@section('content')

    <div class="flex min-h-screen flex-col justify-center px-6 lg:px-8"  
    style="background: linear-gradient(rgb(0 0 0 / 70%), rgb(0 0 0 / 70%)),
    url({{ asset('img/office-1.jpg') }}); background-position: center; 
    background-size: cover;">

        <div class="sm:mx-auto sm:w-full sm:max-w-sm text-white">
            <img class="mx-auto h-36 w-auto" src="{{ asset('img/simplecom/svg/logo-no-background.svg') }}"
                alt="Your Company" style="filter: drop-shadow(2px 4px 6px black)">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight">
                Administración central
            </h2>
        </div>

        <div class="mt-3 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6 mb-8" action="{{ route('superadmin.login') }}" method="POST">
                @csrf
                <div class="relative z-0">
                    <input type="text" id="email" name="email" required autocomplete="off" value="{{ old('email') }}" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-white appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="email" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Email
                    </label>
                </div>

                <div class="relative z-0">
                    <input type="password" id="password" name="password" required class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-white appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="password" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Contraseña
                    </label>
                </div>

                <x-button size="large" submit class="w-full">
                    Iniciar sesión
                </x-button>
                
            </form>

            @if ($errors->any())
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Las credenciales ingresadas son incorrectas</h3>
                    </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
