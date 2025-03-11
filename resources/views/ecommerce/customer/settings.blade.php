@extends('layouts.ecommerce')

@section('content')
    <div x-data="{ tab: 'information' }" class="bg-white mx-auto max-w-7xl 
    lg:flex lg:gap-x-16 lg:px-8 py-10">

        <aside scrollbar-thin
        class="flex overflow-x-auto border-b border-gray-900/5 
        lg:block lg:w-64 lg:flex-none lg:border-b-0 mb-8 lg:mb-0 border-r">
            <nav class="flex-none px-4 sm:px-6 lg:px-0">
                <ul role="list" class="flex gap-x-3 gap-y-1 whitespace-nowrap lg:flex-col">

                    <li @click="tab = 'information'" class="cursor-pointer">
                        <span
                            class="group flex items-center gap-x-3 transition duration-200
                        py-2 pl-2 pr-3 text-sm/6 font-semibold text-gray-700
                        rounded-l-none rounded-t-lg lg:rounded-tr-none lg:rounded-l-lg"
                            :class="tab === 'information'
                                ? '!text-blue-600 bg-gray-50' 
                                : 'hover:bg-gray-50'">
                            <x-icon code="account_circle" class="text-3xl" />
                            Datos personales
                        </span>
                    </li>

                    <li @click="tab = 'addresses'" class="cursor-pointer">
                        <span class="group flex items-center gap-x-3 transition duration-200
                        py-2 pl-2 pr-3 text-sm/6 font-semibold text-gray-700
                        rounded-l-none rounded-t-lg lg:rounded-tr-none lg:rounded-l-lg"
                            :class="tab === 'addresses'
                                ? '!text-blue-600 bg-gray-50' 
                                : 'hover:bg-gray-50'">
                            <x-icon code="location_on" class="text-3xl" />
                            Direcciones
                        </span>
                    </li>

                    <li @click="tab = 'invoicing'" class="cursor-pointer">
                        <span class="group flex items-center gap-x-3 transition duration-200
                        py-2 pl-2 pr-3 text-sm/6 font-semibold text-gray-700
                        rounded-l-none rounded-t-lg lg:rounded-tr-none lg:rounded-l-lg"
                            :class="tab === 'invoicing'
                                ? '!text-blue-600 bg-gray-50' 
                                : 'hover:bg-gray-50'">
                            <x-icon code="credit_card" class="text-3xl" />
                            Facturación
                        </span>
                    </li>

                    <li @click="tab = 'security'" class="cursor-pointer">
                        <span class="group flex items-center gap-x-3 transition duration-200
                        py-2 pl-2 pr-3 text-sm/6 font-semibold text-gray-700
                        rounded-l-none rounded-t-lg lg:rounded-tr-none lg:rounded-l-lg"
                            :class="tab === 'security'
                                ? '!text-blue-600 bg-gray-50' 
                                : 'hover:bg-gray-50'">
                            <x-icon code="fingerprint" class="text-3xl" />
                            Seguridad
                        </span>
                    </li>

                    <li @click="tab = 'notifications'" class="cursor-pointer">
                        <span class="group flex items-center gap-x-3 transition duration-200
                        py-2 pl-2 pr-3 text-sm/6 font-semibold text-gray-700
                        rounded-l-none rounded-t-lg lg:rounded-tr-none lg:rounded-l-lg"
                            :class="tab === 'notifications'
                                ? '!text-blue-600 bg-gray-50' 
                                : 'hover:bg-gray-50'">
                            <x-icon code="notifications" class="text-3xl" />
                            Notificaciones
                        </span>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="px-4 sm:px-6 lg:flex-auto lg:px-0 min-h-[60vh]">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">

                <div x-cloak x-show="tab === 'information'">
                    <h2 class="text-base/7 font-semibold text-gray-900">Datos personales</h2>
                    <p class="mt-1 text-sm/6 text-gray-500">
                        Esta información se usara para identificarte al momento de retirar un pedido
                        o generar el envío del mismo.
                    </p>

                    <dl class="mt-6 divide-y divide-gray-100 border-t border-gray-200 text-sm/6">
                        <div class="py-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                                Nombre completo
                            </dt>
                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                <h6 class="text-gray-900">{{ Auth::user()->full_name }}</h6>
                            </dd>
                        </div>
                        <div class="py-6 sm:flex">
                            <dt class="font-medium text-gray-500 sm:w-64 sm:flex-none sm:pr-6">
                                Email
                                <sup>
                                    <x-icon code="lock" class="text-[16px] text-blue-600"
                                        x-tooltip.raw="Por razones de seguridad, el email no se puede modificar" />
                                </sup>
                            </dt>
                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                <h6 class="text-gray-500">{{ Auth::user()->email }}</h6>
                            </dd>
                        </div>
                        <div class="py-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                                DNI
                            </dt>
                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                <h6 class="text-gray-900">
                                    {{ Auth::user()->document }}
                                </h6>
                            </dd>
                        </div>
                        <div class="py-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                                Teléfono
                            </dt>
                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                <h6 class="text-gray-900">
                                    {{ Auth::user()->phone }}
                                </h6>
                            </dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <x-button size="big">Modificar</x-button>
                    </div>
                </div>

                <div x-cloak x-show="tab === 'addresses'">

                    <h2 class="text-base/7 font-semibold text-gray-900">
                        Direcciones
                    </h2>

                    <p class="mt-1 text-sm/6 text-gray-500">
                        Desde aca podrás crear y editar tus direcciones de entrega para recibir tus pedidos.
                    </p>

                    <dl class="mt-6 divide-y divide-gray-100 border-t border-gray-200 text-sm/6">

                        @foreach (Auth::user()->addresses as $address)
                            <div class="py-6 sm:flex">
                                <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                                    {{ $address->label }}
                                </dt>
                                <dd class="mt-1 flex justify-between gap-3 flex-wrap sm:mt-0 sm:flex-auto">
                                    <h6 class="text-gray-900">

                                        @if (!empty($address->map_url))    
                                            <a href="{{ $address->map_url }}" target="_blank"
                                            x-tooltip.raw="Ver en el mapa" class="text-blue-700 hover:underline">
                                                {{ $address->summary }}
                                            </a>
                                        @else
                                            {{ $address->summary }}
                                        @endif

                                        @if (!empty($address->references))
                                            <small class="block">{{ $address->references }}</small>
                                        @endif
                                    </h6>
                                    <x-button type="secondary" class="h-max">
                                        Editar detalles
                                    </x-button>
                                </dd>
                            </div>
                        @endforeach
                    </dl>

                    <div class="mt-6">
                        <x-button size="large" class="py-3">Agregar dirección</x-button>
                    </div>
                </div>

                <div x-cloak x-show="tab === 'security'">
                    <h2 class="text-base/7 font-semibold text-gray-900">Bank accounts</h2>
                    <p class="mt-1 text-sm/6 text-gray-500">Connect bank accounts to your account.</p>

                    <ul role="list" class="mt-6 divide-y divide-gray-100 border-t border-gray-200 text-sm/6">
                        <li class="flex justify-between gap-x-6 py-6">
                            <div class="font-medium text-gray-900">TD Canada Trust</div>
                            <button type="button" class="font-semibold text-blue-600 hover:text-blue-500">Update</button>
                        </li>
                        <li class="flex justify-between gap-x-6 py-6">
                            <div class="font-medium text-gray-900">Royal Bank of Canada</div>
                            <button type="button" class="font-semibold text-blue-600 hover:text-blue-500">Update</button>
                        </li>
                    </ul>

                    <div class="flex border-t border-gray-100 pt-6">
                        <button type="button" class="text-sm/6 font-semibold text-blue-600 hover:text-blue-500"><span
                                aria-hidden="true">+</span> Add another bank</button>
                    </div>
                </div>

                <div x-cloak x-show="tab === 'notifications'">
                    <h2 class="text-base/7 font-semibold text-gray-900">Language and dates</h2>
                    <p class="mt-1 text-sm/6 text-gray-500">Choose what language and date format to use throughout your
                        account.</p>

                    <dl class="mt-6 divide-y divide-gray-100 border-t border-gray-200 text-sm/6">
                        <div class="py-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">Language</dt>
                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                <div class="text-gray-900">English</div>
                                <button type="button"
                                    class="font-semibold text-blue-600 hover:text-blue-500">Update</button>
                            </dd>
                        </div>
                        <div class="py-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">Date format</dt>
                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                <div class="text-gray-900">DD-MM-YYYY</div>
                                <button type="button"
                                    class="font-semibold text-blue-600 hover:text-blue-500">Update</button>
                            </dd>
                        </div>
                        <div class="flex pt-6">
                            <dt class="flex-none pr-6 font-medium text-gray-900 sm:w-64" id="timezone-option-label">
                                Automatic timezone</dt>
                            <dd class="flex flex-auto items-center justify-end">
                                <!-- Enabled: "bg-blue-600", Not Enabled: "bg-gray-200" -->
                                <button type="button"
                                    class="flex w-8 cursor-pointer rounded-full bg-gray-200 p-px ring-1 ring-inset ring-gray-900/5 transition-colors duration-200 ease-in-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                    role="switch" aria-checked="true" aria-labelledby="timezone-option-label">
                                    <!-- Enabled: "translate-x-3.5", Not Enabled: "translate-x-0" -->
                                    <span aria-hidden="true"
                                        class="w-8 h-8 translate-x-0 transform rounded-full bg-white shadow-sm ring-1 ring-gray-900/5 transition duration-200 ease-in-out"></span>
                                </button>
                            </dd>
                        </div>
                    </dl>
                </div>

                <div x-cloak x-show="tab === 'invoicing'">
                    <h2 class="text-base/7 font-semibold text-gray-900">Integrations</h2>
                    <p class="mt-1 text-sm/6 text-gray-500">Connect applications to your account.</p>

                    <ul role="list" class="mt-6 divide-y divide-gray-100 border-t border-gray-200 text-sm/6">
                        <li class="flex justify-between gap-x-6 py-6">
                            <div class="font-medium text-gray-900">QuickBooks</div>
                            <button type="button" class="font-semibold text-blue-600 hover:text-blue-500">Update</button>
                        </li>
                    </ul>

                    <div class="flex border-t border-gray-100 pt-6">
                        <button type="button" class="text-sm/6 font-semibold text-blue-600 hover:text-blue-500"><span
                                aria-hidden="true">+</span> Add another application</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
