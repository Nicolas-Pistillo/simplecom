<div x-data="{ confirmCollectionPointDeletion: false }" class="w-full"
x-on:open-confirm-collection-point-deletion.window="confirmCollectionPointDeletion = true"
x-on:close-confirm-collection-point-deletion.window="confirmCollectionPointDeletion = false">

    @if ($collection_points->isEmpty())
        <div x-data="{modalHelperOpen: false}" class="text-center">

            <img src="{{ URL::to('img/illustrations/deliveries.svg') }}" class="h-48 mx-auto" alt="Sin puntos de retiro">

            <div class="my-4 flex flex-col">
                <h3 class="text-sm font-semibold text-gray-900">
                    Todavía no añadiste puntos de colecta
                </h3>

                <p class="mt-1 mb-4 text-sm text-gray-500">
                    Agregá un punto de colecta para empezar a operar con proveedores de envíos
                </p>

                <x-button @click="$dispatch('open-new-collection-point')" type="soft" class="w-max mx-auto">
                    Agregar punto de colecta
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
                            Puntos de colecta
                        </h5>
                        <p class="text-xs sm:text-sm font-normal text-gray-600 text-center">
                            Los puntos de colecta son las direcciones donde irán los proveedores de envío 
                            que integres para recoger los paquetes de tus pedidos y entregarlos a tus clientes. 
                            <br> <br>
                            Además, la ubicación del punto de colecta que elijas se tomará como referencia 
                            para cotizar el valor de cada envío, y este valor se añadirá al checkout para ser
                            abonado por el comprador junto al pedido.
                        </p>
                    </div>
                </x-slot>
            </x-modal>
        </div>
    @else
        {{-- @dump($collection_points) --}}
        <x-button @click="$dispatch('open-new-collection-point')" class="flex items-center mb-8">
            <x-icon code="add" />
            Agregar punto de colecta
        </x-button>

        <div class="w-full grid grid-cols-1 gap-4 md:grid-cols-2">

            @foreach ($collection_points as $collectionPoint)
                <div wire:key='{{ $collectionPoint->id }}'
                    class="w-full p-4 transition duration-300 hover:shadow-md bg-white 
                    border border-gray-300 rounded-xl shadow-sm h-max">

                    <h5 class="mb-2 text-sm sm:text-lg line-clamp-none md:line-clamp-1 font-semibold tracking-tight text-gray-900">
                        {{ $collectionPoint->name }}
                    </h5>

                    <x-switch :checked="$collectionPoint->in_use" class="mb-3"
                    wireChange="toggleCollectionPointInUse({{ $collectionPoint->id }})"
                    tooltipPosition="bottom"
                    :checked="$collectionPoint->in_use"
                    :label="$collectionPoint->in_use ? 'En uso' : ''"
                    :tooltip="!$collectionPoint->in_use ? 'Activar' : ''"
                    />

                    <p class="mb-1 text-xs sm:text-sm font-normal text-gray-500 flex gap-x-1">
                        <x-icon code="location_on" class="text-gray-500" style="font-size: 20px" />
                        {{ $collectionPoint->address }}
                    </p>

                    <p class="mb-3 text-xs sm:text-sm font-normal text-gray-500 flex gap-x-1">
                        <x-icon code="person" class="text-gray-500" style="font-size: 20px" />
                        Encargado: {{ $collectionPoint->staff_name }}
                    </p>

                    <div class="flex items-center gap-3">

                        <a href="{{ $collectionPoint->mapUrl() }}" target="_blank">
                            <x-icon code="moved_location" style="font-size: 21px"
                            class="p-1.5 rounded-full border 
                            text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                            hover:border-gray-300 hover:text-blue-600"
                            x-tooltip.raw.placement.bottom="Ver en el mapa" />
                        </a>

                        <x-icon code="edit" style="font-size: 21px"
                        wire:click='editCollectionPoint({{ $collectionPoint->id }})'
                        class="p-1.5 rounded-full border 
                        text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                        hover:border-gray-300 hover:text-blue-600"
                        x-tooltip.raw.placement.bottom="Editar" />

                        <x-icon code="delete" style="font-size: 21px"
                        wire:click='confirmDeleteCollectionPoint({{ $collectionPoint->id }})'
                        class="p-1.5 rounded-full border 
                        text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                        hover:border-gray-300 hover:text-red-500"
                        x-tooltip.raw.placement.bottom="Eliminar" />
                    </div>
                </div>
            @endforeach

        </div>

        @include('admin.delivery-methods.partials.edit-collection-point')

        <x-modal ref="confirmCollectionPointDeletion" type="danger" icon="warning">

            <x-slot name="title">
                Eliminar {{ $collection_point?->name }}
            </x-slot>

            <x-slot name="body">
                ¿Estás seguro que deseas eliminar este punto de colecta?
                En el caso de que esté en uso, deberás seleccionar o agregar
                otro punto de colecta para continuar operando con tus envíos.
            </x-slot>

            <x-slot name="actions">

                <x-spinner wire:loading wire:target='deleteCollectionPoint' />

                <x-button type="secondary" wire:loading.remove wire:target='deleteCollectionPoint'
                @click="confirmCollectionPointDeletion = false">Cancelar</x-button>

                <x-button wire:click='deleteCollectionPoint' 
                wire:loading.remove class="bg-red-600 hover:bg-red-500 mx-3"
                wire:target='deleteCollectionPoint'>Eliminar</x-button>

            </x-slot>

        </x-modal>
    @endif

    @livewire('admin.new-collection-point')

</div>