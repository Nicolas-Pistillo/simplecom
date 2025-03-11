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
                                ?
                                '!text-blue-600 bg-gray-50' :
                                'hover:bg-gray-50'">
                            <x-icon code="account_circle" class="text-3xl" />
                            Datos personales
                        </span>
                    </li>

                    <li @click="tab = 'addresses'" class="cursor-pointer">
                        <span
                            class="group flex items-center gap-x-3 transition duration-200
                        py-2 pl-2 pr-3 text-sm/6 font-semibold text-gray-700
                        rounded-l-none rounded-t-lg lg:rounded-tr-none lg:rounded-l-lg"
                            :class="tab === 'addresses'
                                ?
                                '!text-blue-600 bg-gray-50' :
                                'hover:bg-gray-50'">
                            <x-icon code="location_on" class="text-3xl" />
                            Direcciones
                        </span>
                    </li>

                    <li @click="tab = 'invoicing'" class="cursor-pointer">
                        <span
                            class="group flex items-center gap-x-3 transition duration-200
                        py-2 pl-2 pr-3 text-sm/6 font-semibold text-gray-700
                        rounded-l-none rounded-t-lg lg:rounded-tr-none lg:rounded-l-lg"
                            :class="tab === 'invoicing'
                                ?
                                '!text-blue-600 bg-gray-50' :
                                'hover:bg-gray-50'">
                            <x-icon code="credit_card" class="text-3xl" />
                            Facturación
                        </span>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="px-4 sm:px-6 lg:flex-auto lg:px-0 min-h-[60vh]">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">

                <div x-cloak x-show="tab === 'information'" x-data="{ open: false }">
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
                        <x-button @click="open = true" size="big">Modificar</x-button>
                    </div>

                    <x-drawer ref="open">
                        <div class="h-full">
                            <form wire:submit='save' class="h-full flex flex-col justify-between">

                                <div class="mb-3">

                                    <h3 class="text-lg text-gray-700 font-semibold mb-3">Datos personales</h3>

                                    <hr class="mb-6">

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                                            Nombre
                                        </label>
                                        <div class="mt-2">
                                            <input type="text" wire:model='name' name="name" autocomplete="off"
                                                class="block w-full 
                                              rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                                              sm:text-sm sm:leading-6">
                                        </div>
                                        @error('name')
                                            <small class="text-red-500"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                                            Email
                                        </label>
                                        <div class="mt-2">
                                            <input type="email" wire:model='email' name="email" autocomplete="off"
                                                class="block w-full 
                                              rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                                              sm:text-sm sm:leading-6">
                                        </div>
                                        @error('email')
                                            <small class="text-red-500"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    {{-- <div class="mb-6">
                                            <label class="block text-sm font-semibold leading-6 text-gray-500">
                                                Rol
                                            </label>
                                            <div class="mt-2">
                                                <select wire:model.live='role' name="role" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                                    <option>Seleccionar un rol</option>
                                                    @foreach ($roles as $roleItem)
                                                        <option @if ($role == $roleItem->id) selected @endif 
                                                        value="{{ $roleItem->name }}">{{ $roleItem->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                    <small class="text-xs text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div> --}}

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                                            Area (opcional)
                                        </label>
                                        <div class="mt-2">
                                            <input type="text" wire:model='area' name="area" autocomplete="off"
                                                class="block w-full 
                                              rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                                              sm:text-sm sm:leading-6">
                                        </div>
                                        @error('area')
                                            <small class="text-red-500"> {{ $message }} </small>
                                        @else
                                            <small class="text-gray-500">Por ejemplo: Marketing, Soporte, Diseño etc.</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex items-center py-6">

                                    <x-button submit wire:loading.remove wire:target='save' size="large"
                                        class="w-full mr-4">Guardar</x-button>

                                    <x-spinner wire:loading wire:target='save' class="w-full" />

                                    <x-button wire:loading.remove wire:target='save' wire:click='cancelForm' size="large"
                                        class="w-full" type="secondary">
                                        Cancelar
                                    </x-button>
                                </div>

                            </form>
                        </div>
                    </x-drawer>
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
                        <x-button @click="$dispatch('open-new-address-panel')" 
                        size="large" class="py-3">Agregar dirección</x-button>
                    </div>
                </div>

                <div x-cloak x-show="tab === 'invoicing'" x-data="{ open: false }">
                    <h2 class="text-base/7 font-semibold text-gray-900">Facturación</h2>
                    <p class="mt-1 text-sm/6 text-gray-500">
                        Se emitirán las facturas de tus pedidos con esta información.
                    </p>

                    <dl class="mt-6 divide-y divide-gray-100 border-t border-gray-200 text-sm/6">
                        <div class="py-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                                Condición fiscal
                            </dt>
                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                <h6 class="text-gray-900">{{ Auth::user()->tax_condition->name() }}</h6>
                            </dd>
                        </div>
                        <div class="py-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                                Razón social
                            </dt>
                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                <h6 class="text-gray-900">
                                    {{ Auth::user()->invoice_social_reason ?? Auth::user()->full_name }}
                                </h6>
                            </dd>
                        </div>
                        <div class="py-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                                CUIT/DNI
                            </dt>
                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                <h6 class="text-gray-900">
                                    {{ Auth::user()->invoice_document ?? Auth::user()->document }}
                                </h6>
                            </dd>
                        </div>
                        <div class="py-6 sm:flex">
                            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                                Domicilio fiscal
                            </dt>
                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                <h6 class="text-gray-900">
                                    {{ Auth::user()->invoice_address }}
                                </h6>
                            </dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <x-button @click="open = true" size="big">Modificar</x-button>
                    </div>

                    <x-drawer ref="open">
                        <div class="h-full">
                            <form wire:submit='save' class="h-full flex flex-col justify-between">

                                <div class="mb-3">

                                    <h3 class="text-lg text-gray-700 font-semibold mb-3">Datos de facturación</h3>

                                    <hr class="mb-6">

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                                            Nombre
                                        </label>
                                        <div class="mt-2">
                                            <input type="text" wire:model='name' name="name" autocomplete="off"
                                                class="block w-full 
                                              rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                                              sm:text-sm sm:leading-6">
                                        </div>
                                        @error('name')
                                            <small class="text-red-500"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                                            Email
                                        </label>
                                        <div class="mt-2">
                                            <input type="email" wire:model='email' name="email" autocomplete="off"
                                                class="block w-full 
                                              rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                                              sm:text-sm sm:leading-6">
                                        </div>
                                        @error('email')
                                            <small class="text-red-500"> {{ $message }} </small>
                                        @enderror
                                    </div>

                                    {{-- <div class="mb-6">
                                            <label class="block text-sm font-semibold leading-6 text-gray-500">
                                                Rol
                                            </label>
                                            <div class="mt-2">
                                                <select wire:model.live='role' name="role" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                                    <option>Seleccionar un rol</option>
                                                    @foreach ($roles as $roleItem)
                                                        <option @if ($role == $roleItem->id) selected @endif 
                                                        value="{{ $roleItem->name }}">{{ $roleItem->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                    <small class="text-xs text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div> --}}

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                                            Area (opcional)
                                        </label>
                                        <div class="mt-2">
                                            <input type="text" wire:model='area' name="area" autocomplete="off"
                                                class="block w-full 
                                              rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                                              sm:text-sm sm:leading-6">
                                        </div>
                                        @error('area')
                                            <small class="text-red-500"> {{ $message }} </small>
                                        @else
                                            <small class="text-gray-500">Por ejemplo: Marketing, Soporte, Diseño etc.</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex items-center py-6">

                                    <x-button submit wire:loading.remove wire:target='save' size="large"
                                        class="w-full mr-4">Guardar</x-button>

                                    <x-spinner wire:loading wire:target='save' class="w-full" />

                                    <x-button wire:loading.remove wire:target='save' wire:click='cancelForm'
                                        size="large" class="w-full" type="secondary">
                                        Cancelar
                                    </x-button>
                                </div>

                            </form>
                        </div>
                    </x-drawer>
                </div>
            </div>
        </div>
    </div>
@endsection
