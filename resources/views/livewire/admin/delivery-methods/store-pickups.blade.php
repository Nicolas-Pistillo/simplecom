<div x-data="{ confirmStorePickupDeletion: false }" class="w-full"
    x-on:open-confirm-storepickup-deletion.window="confirmStorePickupDeletion = true"
    x-on:close-confirm-storepickup-deletion.window="confirmStorePickupDeletion = false">

    @if ($store_pickups->isEmpty())
        <div class="text-center mx-auto">

            <img src="{{ URL::to('img/illustrations/quiet_street.svg') }}" class="h-48 mx-auto" alt="Sin puntos de retiro">

            <div class="my-4">
                <h3 class="text-sm font-semibold text-gray-900">
                    Todavía no añadiste retiros en tienda
                </h3>
                <p class="mt-1 mb-4 text-sm text-gray-500">
                    Agregá los retiros en tienda que necesites cuando quieras
                </p>
                <x-button @click="$dispatch('open-new-store-pickup-panel')" type="soft">
                    Agregar retiro en tienda
                </x-button>
            </div>
        </div>
    @else
        <x-button @click="$dispatch('open-new-store-pickup-panel')" 
        class="flex items-center gap-1 mb-8">
            <x-icon code="add_business" />
            Agregar retiro en tienda
        </x-button>

        <div class="w-full grid grid-cols-1 gap-4 md:grid-cols-2">

            @foreach ($store_pickups as $pickupPoint)
                <div wire:key='{{ $pickupPoint->id }}'
                    class="w-full p-4 transition duration-300 hover:shadow-md bg-white 
                                    border border-gray-300 rounded-xl shadow-sm h-max">

                    <h5
                        class="mb-2 text-sm sm:text-lg line-clamp-none md:line-clamp-1 font-semibold tracking-tight text-gray-900">
                        {{ $pickupPoint->name }}
                    </h5>

                    <x-switch :checked="$pickupPoint->active" class="mb-3"
                        wireChange="toggleStorePickupActive({{ $pickupPoint->id }})" :label="$pickupPoint->active ? 'Habilitado' : 'Deshabilitado'" />

                    <p class="mb-1 text-xs sm:text-sm font-normal text-gray-500 flex gap-x-1">
                        <x-icon code="location_on" class="text-gray-500" style="font-size: 20px" />
                        {{ $pickupPoint->address }}
                    </p>

                    <p class="mb-3 text-xs sm:text-sm font-normal text-gray-500 flex gap-x-1">
                        <x-icon code="schedule" class="text-gray-500" style="font-size: 20px" />
                        {{ $pickupPoint->schedule }}
                    </p>

                    <div class="flex items-center gap-3">

                        <a href="{{ $pickupPoint->mapUrl() }}" target="_blank">
                            <x-icon code="moved_location" style="font-size: 21px"
                                class="p-1.5 rounded-full border 
                                        text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                                        hover:border-gray-300 hover:text-blue-600"
                                x-tooltip.raw.placement.bottom="Ver en el mapa" />
                        </a>

                        <x-icon code="edit" style="font-size: 21px"
                            wire:click='editStorePickup({{ $pickupPoint->id }})'
                            class="p-1.5 rounded-full border 
                                        text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                                        hover:border-gray-300 hover:text-blue-600"
                            x-tooltip.raw.placement.bottom="Editar" />

                        <x-icon code="delete" style="font-size: 21px"
                            wire:click='confirmDeleteStorePickup({{ $pickupPoint->id }})'
                            class="p-1.5 rounded-full border 
                                        text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                                        hover:border-gray-300 hover:text-red-500"
                            x-tooltip.raw.placement.bottom="Eliminar" />
                    </div>
                </div>
            @endforeach

        </div>

        @include('admin.delivery-methods.partials.edit-store-pickup')

        <x-modal ref="confirmStorePickupDeletion" type="danger" icon="warning">

            <x-slot name="title">
                Eliminar {{ $store_pickup?->name }}
            </x-slot>

            <x-slot name="body">
                ¿Estás seguro que deseas eliminar este punto de retiro?
                tus clientes ya no podran elegir este lugar para retirar sus pedidos.
            </x-slot>

            <x-slot name="actions">

                <x-spinner wire:loading wire:target='deleteStorePickup' />

                <x-button type="secondary" wire:loading.remove wire:target='deleteStorePickup'
                    @click="confirmStorePickupDeletion = false">Cancelar</x-button>

                <x-button wire:click='deleteStorePickup' wire:loading.remove
                wire:target='deleteStorePickup' class="bg-red-600 hover:bg-red-500">
                    Eliminar
                </x-button>

            </x-slot>

        </x-modal>

    @endif

    @livewire('admin.new-store-pickup-point')
</div>
