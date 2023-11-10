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
            x-data="{submiting: false}" @submit="submiting = true"
            class="bg-white shadow-md ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            @csrf
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        
                        <x-input class="sm:col-span-3" placeholder="Sólo minusculas y sin espacios" 
                        error="{{ $errors->first('name') }}" name="name" label="Subdominio" 
                        value="{{ old('name') }}" />

                        <x-input class="sm:col-span-3" placeholder="Por ejemplo: Distribuidora Martinez" 
                        label="Nombre del comercio" name="ecommerce_name" error="{{ $errors->first('ecommerce_name') }}" 
                        value="{!! old('ecommerce_name') !!}" />

                        <div class="sm:col-span-3">
                            <label for="sector" class="text-sm text-gray-500 sm:pt-1.5">Rubro</label>
                            <div class="mt-1">
                                <select id="sector" name="sector_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option>Seleccionar un rubro...</option>
                                    @foreach ($sectors as $sector)
                                        <option @if(old('sector_id') == $sector->id) selected @endif 
                                        value="{{ $sector->id }}">{{ $sector->name }}</option>
                                    @endforeach
                                </select>
                                @error('sector_id')
                                    <small class="text-xs text-red-500">{{ $errors->first('sector_id') }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="plan" class="text-sm text-gray-500 sm:pt-1.5">Plan</label>
                            <div class="mt-1">
                                <select id="plan" name="plan_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option>Seleccionar un plan...</option>
                                    @foreach ($plans as $plan)
                                        <option @if(old('plan_id') == $plan->id) selected @endif 
                                        value="{{ $plan->id }}">{{ $plan->name }}</option>
                                    @endforeach
                                </select>
                                @error('plan_id')
                                    <small class="text-xs text-red-500">{{ $errors->first('plan_id') }}</small>
                                @enderror
                            </div>
                        </div>

                        <hr class="w-full sm:col-span-6">

                        <h4 class="sm:col-span-6 flex items-center text-sm text-gray-700">
                            Cuenta del administrador principal
                            <x-icon data-tooltip-target="admin-account-help" 
                            code="help" class="ml-1 text-blue-600" style="font-size: 20px" />
                            <x-tooltip id="admin-account-help">
                                Será el encargado de iniciar sesión por primera vez como administrador del comercio, <br> 
                                también controlara los roles e información de los demás tipos de administradores
                            </x-tooltip>
                        </h4>

                        <x-input type="email" class="sm:col-span-3 border-none p-0"
                        error="{{ $errors->first('admin_email') }}" name="admin_email" label="Email administrador" 
                        value="{{ old('admin_email') }}" />

                        <x-input type="password" class="sm:col-span-3 border-none p-0" placeholder="Luego se le pedira cambiarla por seguridad"
                        label="Contraseña administrador" name="admin_password" error="{{ $errors->first('admin_password') }}"
                        value="{{ old('admin_password') }}" />
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">

                    <x-button submit x-show="!submiting" type="primary">Crear tenant</x-button>

                    <div x-show="submiting" class="flex items-center">
                        <div role="status">
                            <svg aria-hidden="true" class="w-6 h-6 mr-2 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Creando tenant...</span>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
