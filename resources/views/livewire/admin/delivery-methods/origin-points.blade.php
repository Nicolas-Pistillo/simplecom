<div x-data="{ confirmOriginPointDeletion: false }" class="w-full"
x-on:open-confirm-origin-point-deletion.window="confirmOriginPointDeletion = true"
x-on:close-confirm-origin-point-deletion.window="confirmOriginPointDeletion = false">

    @if ($origin_points->isEmpty())
        <div x-data="{modalHelperOpen: false}" class="text-center">

            <img src="{{ URL::to('img/illustrations/deliveries.svg') }}" class="h-48 mx-auto" alt="Sin puntos de retiro">

            <div class="my-4 flex flex-col">
                <h3 class="text-sm font-semibold text-gray-900">
                    Todavía no añadiste puntos de orígen
                </h3>

                <p class="mt-1 mb-4 text-sm text-gray-500">
                    Agregá un punto de orígen para empezar a operar con proveedores de envíos
                </p>

                <x-button @click="$dispatch('open-new-origin-point')" type="soft" class="w-max mx-auto">
                    Agregar punto de orígen
                </x-button>

                <small @click="modalHelperOpen = true" 
                class="w-max no-select mx-auto mt-3 text-blue-700 cursor-pointer hover:underline">
                    ¿Que es esto?
                </small>
            </div>

            <x-modal ref="modalHelperOpen" closeOnClickAway withCloseBtn>
                <x-slot name="body">
                    <div class="flex items-center justify-center mb-3.5">
                        <img src="{{ URL::to('img/illustrations/delivery_address.svg') }}"
                        class="w-48 h-48 sm:w-56 sm:h-56">
                    </div>
    
                    <div class="flex items-center justify-center flex-col gap-2 mb-5">
                        <h5 class="text-xl font-bold leading-8 text-gray-900 text-center">
                            Puntos de orígen
                        </h5>
                        <p class="text-xs sm:text-sm font-normal text-gray-600 text-center">
                            Los puntos de orígen son las direcciones donde irán los proveedores de envío 
                            que integres para recoger los paquetes de tus pedidos y entregarlos a tus clientes. 
                            <br> <br>
                            Además, la ubicación del punto de orígen que elijas se tomará como referencia 
                            para cotizar el valor de cada envío, y este valor se añadirá al checkout para ser
                            abonado por el comprador junto al pedido.
                        </p>
                    </div>
                </x-slot>
            </x-modal>
        </div>
    @else
        {{-- @dump($origin_points) --}}
        <x-button @click="$dispatch('open-new-origin-point')" class="flex items-center mb-8">
            <x-icon code="add" />
            Agregar punto de orígen
        </x-button>

        <div class="w-full grid grid-cols-1 gap-4 md:grid-cols-2">

            @foreach ($origin_points as $originPoint)
                <div wire:key='{{ $originPoint->id }}'
                    class="w-full p-4 transition duration-300 hover:shadow-md bg-white 
                    border border-gray-300 rounded-xl shadow-sm h-max">

                    <h5 class="mb-1.5 text-sm sm:text-lg line-clamp-none md:line-clamp-1 font-semibold tracking-tight text-gray-900">
                        {{ $originPoint->name }}
                    </h5>

                    @if ($originPoint->in_use)
                        <x-badge x-tooltip.raw="Las tarifas de envío y las orígens de paquetes 
                        se están calculando desde esta ubicación" class="mb-2"
                        color="blue">
                            En uso
                        </x-badge>
                    @else
                        <x-button wire:click='activateOriginPoint({{ $originPoint->id }})' 
                        size="small" type="secondary" class="mb-2">
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
                ¿Estás seguro que deseas eliminar este punto de orígen?
                En el caso de que esté en uso, deberás seleccionar o agregar
                otro punto de orígen para continuar operando con tus envíos.
            </x-slot>

            <x-slot name="actions">

                <x-spinner wire:loading wire:target='deleteOriginPoint' />

                <x-button type="secondary" wire:loading.remove wire:target='deleteOriginPoint'
                @click="confirmOriginPointDeletion = false">Cancelar</x-button>

                <x-button wire:click='deleteOriginPoint' 
                wire:loading.remove class="bg-red-600 hover:bg-red-500"
                wire:target='deleteOriginPoint'>Eliminar</x-button>

            </x-slot>

        </x-modal>
    @endif

    @livewire('admin.new-origin-point')

</div>