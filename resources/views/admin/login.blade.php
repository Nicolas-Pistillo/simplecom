@extends('layouts.basic')

@section('favicon', URL::to('favicon.ico'))

@section('content')
    <div class="flex min-h-screen">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">

                <div class="relative mt-24">
                    <img class="absolute -top-36 left-0 h-20 w-auto mx-auto" 
                    src="https://www.munishop.com.ar/webfiles/marketplace/logo.png?t=1681182743"
                        alt="Commerce logo">
                    <h4 class="text-2xl font-bold leading-9 tracking-tight text-blue-600">{{ tenant()->ecommerce_name }}
                    </h4>
                    <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">Panel de administración</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Por favor ingrese sus credenciales
                    </p>
                </div>

                <div class="mt-10">
                    <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                        @csrf

                        <x-input type="email" name="email" error="{{ $errors->first('email') }}" 
                        required label="Email" class="border-none px-0" value="{{ old('email') }}" />

                        <x-input type="password" name="password" error="{{ $errors->first('password') }}" 
                        required label="Contraseña" class="border-none px-0" />

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

                    @error('login-failed')
                        <x-alert type="error" class="mt-3">Credenciales incorrectas</x-alert>
                    @enderror
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block" style="filter: drop-shadow(0px 0px 8px #888)">
            <img class="absolute inset-0 h-full w-full object-cover"
                src="{{ URL::to('/img/simplecom/svg/logo-color.svg') }}" alt="">
        </div>
    </div>
@endsection
