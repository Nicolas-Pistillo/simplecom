<div x-data="{ confirmOriginPointDeletion: false }" class="w-full"
    x-on:open-confirm-origin-point-deletion.window="confirmOriginPointDeletion = true"
    x-on:close-confirm-origin-point-deletion.window="confirmOriginPointDeletion = false">

    <div class="px-4 sm:px-6 lg:px-8 mb-8">
        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Puntos de origen</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Los puntos de origen son tus puntos de despacho.
                    Son las direcciones desde donde tus transportistas iran a colectar los pedidos y desde
                    donde se van a calcular las cotizaciónes de los envíos.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button @click="$dispatch('open-new-origin-point')" class="flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Nuevo punto de orígen
                </x-button>
            </div>
        </div>

        @if ($origin_points->isEmpty())
            <div x-data="{ modalHelperOpen: false }" class="text-center">

                <img src="{{ URL::to('img/illustrations/deliveries.svg') }}" class="h-48 mx-auto"
                    alt="Sin puntos de retiro">

                <div class="my-4 flex flex-col">
                    <h3 class="text-sm font-semibold text-gray-900">
                        Todavía no añadiste puntos de origen
                    </h3>

                    <p class="mt-1 mb-4 text-sm text-gray-500">
                        Agregá un punto de origen para empezar a operar con proveedores de envíos
                    </p>
                </div>
            </div>
        @else
            <div class="w-full grid grid-cols-1 gap-4 md:grid-cols-2">

                @foreach ($origin_points as $originPoint)
                    <div wire:key='{{ $originPoint->id }}'
                    class="w-full p-4 transition duration-300 hover:shadow-md bg-white 
                    border border-gray-300 rounded-xl shadow-sm h-max">

                        <h5 class="mb-1.5 flex items-center gap-1.5 text-sm sm:text-lg 
                        font-semibold tracking-tight text-gray-900">
                            <x-icon code="warehouse" />
                            {{ $originPoint->name }}
                        </h5>

                        @if ($originPoint->in_use)
                            <x-badge x-tooltip.raw="Las tarifas de envío y los origenes de colecta
                            se están calculando desde esta ubicación" class="mb-2" color="blue">
                                En uso
                            </x-badge>
                        @else
                            <x-button wire:click='activateOriginPoint({{ $originPoint->id }})' size="small"
                                type="secondary" class="mb-2">
                                Usar este punto
                            </x-button>
                        @endif

                        <p class="mb-1 text-xs sm:text-sm font-normal text-gray-500 flex gap-x-1">
                            <x-icon code="location_on" class="text-gray-500" style="font-size: 20px" />
                            {{ $originPoint->address }}
                        </p>

                        <p class="mb-3 text-xs sm:text-sm font-normal text-gray-500 flex gap-x-1">
                            <x-icon code="person" class="text-gray-500" style="font-size: 20px" />
                            Encargado: {{ $originPoint->staff_name }}
                        </p>

                        <div class="flex items-center gap-3">

                            <a href="{{ $originPoint->mapUrl() }}" target="_blank">
                                <x-icon code="moved_location" style="font-size: 21px"
                                    class="p-1.5 rounded-full border 
                            text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                            hover:border-gray-300 hover:text-blue-600"
                                    x-tooltip.raw.placement.bottom="Ver en el mapa" />
                            </a>

                            <x-icon code="edit" style="font-size: 21px"
                                wire:click='editOriginPoint({{ $originPoint->id }})'
                                class="p-1.5 rounded-full border 
                        text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                        hover:border-gray-300 hover:text-blue-600"
                                x-tooltip.raw.placement.bottom="Editar" />

                            <x-icon code="delete" style="font-size: 21px"
                                wire:click='confirmDeleteOriginPoint({{ $originPoint->id }})'
                                class="p-1.5 rounded-full border 
                        text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                        hover:border-gray-300 hover:text-red-500"
                                x-tooltip.raw.placement.bottom="Eliminar" />
                        </div>
                    </div>
                @endforeach

            </div>

            @include('admin.delivery-methods.partials.edit-origin-point')

            <x-modal ref="confirmOriginPointDeletion" type="danger" icon="warning">

                <x-slot name="title">
                    Eliminar {{ $origin_point?->name }}
                </x-slot>

                <x-slot name="body">
                    ¿Estás seguro que deseas eliminar este punto de origen?
                    En el caso de que esté en uso, deberás seleccionar o agregar
                    otro punto de origen para continuar operando con tus envíos.
                </x-slot>

                <x-slot name="actions">

                    <x-spinner wire:loading wire:target='deleteOriginPoint' />

                    <x-button type="secondary" wire:loading.remove wire:target='deleteOriginPoint'
                        @click="confirmOriginPointDeletion = false">Cancelar</x-button>

                    <x-button wire:click='deleteOriginPoint' wire:loading.remove class="bg-red-600 hover:bg-red-500"
                        wire:target='deleteOriginPoint'>Eliminar</x-button>

                </x-slot>

            </x-modal>
        @endif

        @livewire('admin.new-origin-point')
    </div>

</div>
