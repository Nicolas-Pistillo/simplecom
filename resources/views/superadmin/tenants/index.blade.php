@extends('layouts.dashboards.superadmin')

@section('title', 'Tenants')

@section('content')

    @if ($tenants->isEmpty())
        <div class="text-center mt-8">

            <x-icon code="add_business" class="text-gray-400" style="font-size: 48px" />

            <h3 class="text-sm font-semibold text-gray-900 mb-5">Aún no hay tenants en simplecom</h3>

            <x-button href="{{ route('superadmin.tenants.create') }}">
                Crear uno ahora
            </x-button>
        </div>
    @else
        <div class="px-4 sm:px-6 lg:px-8">

            @if (Session::has('tenant_created'))
                <x-alert class="mb-6 animate__bounceInLeft" type="success" dismissible>
                    Tenant creado exitosamente
                </x-alert>
            @endif

            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Listado de tenants</h1>
                </div>

                <x-button href="{{ route('superadmin.tenants.create') }}"
                    class="inline-block mt-4 sm:ml-16 sm:mt-0 sm:flex-none" type="primary">Nuevo tenant</x-button>
            </div>

            <div class="my-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto md:overflow-x-visible sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">

                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                        Nombre</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Estado</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Plan</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Rubro</th>
                                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">
                                        Acciones</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($tenants as $tenant)
                                    <tr>
                                        <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">

                                                    <img class="{{ $tenant->logo_url ? 'h-11 w-28 object-contain' : 'h-11 w-11 rounded-full' }}"
                                                    src="{{ $tenant->logo_url ? Storage::url($tenant->logo_url) : "https://ui-avatars.com/api/?color=fff&background=2563eb&name=$tenant->ecommerce_name" }}"
                                                    alt="Logo del comercio">

                                                </div>
                                                <div class="ml-4">
                                                    <h4 class="font-medium text-gray-900"> {{ $tenant->ecommerce_name }}</h4>
                                                    <div class="mt-1 text-gray-500 flex items-center">
                                                        <a href="http://{{ $tenant->domain() }}"
                                                            title="Ir a su ecommerce" target="_blank"
                                                            class="text-blue-600 hover:underline flex items-center">
                                                            {{ $tenant->domain() }}
                                                        </a>
                                                        <x-icon code="open_in_new" class="ml-1 text-blue-600 text-sm" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                            @if ($tenant->active)
                                                <x-badge color="green">Activo</x-badge>
                                            @else
                                                <x-badge color="red">Inactivo</x-badge>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                            <p class="text-gray-900"> {{ $tenant->plan->name }} </p>
                                        </td>

                                        <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                            <p class="text-gray-900"> {{ $tenant->sector->name }} </p>
                                        </td>

                                        <td class="relative whitespace-nowrap py-5 pr-4 font-medium text-center sm:pr-0">

                                            <div x-data="{ open: false }" class="relative inline-block">

                                                <x-icon code="more_vert" @click="open = !open"
                                                class="text-gray-500 cursor-pointer transition duration-300
                                                rounded-full p-1 hover:bg-gray-100 hover:shadow-md" />

                                                <!-- Tenant actions dropdown -->
                                                <div x-cloak x-show="open" @click.away="open = false"
                                                    x-transition:enter="transition ease-out duration-200"
                                                    x-transition:enter-start="transform opacity-0 scale-95"
                                                    x-transition:enter-end="transform opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-75"
                                                    x-transition:leave-start="transform opacity-100 scale-100"
                                                    x-transition:leave-end="transform opacity-0 scale-95"
                                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right text-left rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                                    tabindex="-1">
                                                    <div class="py-1" role="none">
                                                        <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                                        <a href="#"
                                                            class="transition-colors duration-200 text-gray-700 block px-4 py-2 text-sm hover:bg-gray-50"
                                                            role="menuitem">Ver detalles</a>
                                                        <a href="#"
                                                            class="transition-colors duration-200 text-gray-700 block px-4 py-2 text-sm hover:bg-gray-50"
                                                            role="menuitem">Eliminar</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
