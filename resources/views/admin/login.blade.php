@extends('layouts.basic')

@section('favicon', URL::to('favicon.ico'))

@section('content')
    <div class="flex min-h-screen">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">

                <div class="relative mt-24">
                    <img class="absolute -top-36 left-0 h-20 object-contain" 
                    src="{{ tenant()->logo_url ? Storage::url(tenant()->logo_url) : URL::to('favicon.ico') }}"
                        alt="Ecommerce logo">
                    <h4 class="text-2xl font-bold leading-9 tracking-tight text-{{ tenant('color') }}-600">{{ tenant()->ecommerce_name }}
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
                        <x-alert color="red" icon="error" class="max-w-none mt-3" 
                        title="Credenciales Incorrectas">
                            Correo o contraseña inválidos
                        </x-alert>
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
