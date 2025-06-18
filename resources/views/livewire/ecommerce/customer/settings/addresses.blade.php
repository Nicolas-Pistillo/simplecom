<div>
    <h2 class="text-base/7 font-semibold text-gray-900">
        Direcciones
    </h2>

    <p class="mt-1 text-sm/6 text-gray-500">
        Desde aca podrás crear y editar tus direcciones de entrega para recibir tus pedidos.
    </p>

    <dl x-data="{ openEditAddressDetails: false }" 
    x-on:open-edit-address-details.window="openEditAddressDetails = true"
    x-on:close-edit-address-details.window="openEditAddressDetails = false"
    class="mt-6 divide-y divide-gray-100 border-t border-gray-200 text-sm/6">

        @foreach (Auth::user()->addresses as $address)
            <div wire:key='{{ $address->id }}' class="py-6 sm:flex" x-data="{ confirmDeleteAddress: false }">
                <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                    {{ $address->label }}
                </dt>
                <dd class="mt-1 flex justify-between gap-3 flex-wrap sm:mt-0 sm:flex-auto">
                    <h6 class="text-gray-900">

                        @if (!empty($address->map_url))
                            <a href="{{ $address->map_url }}" target="_blank" x-tooltip.raw="Ver en el mapa"
                                class="text-blue-700 hover:underline">
                                {{ $address->summary }}
                            </a>
                        @else
                            {{ $address->summary }}
                        @endif

                        @if (!empty($address->references))
                            <small class="block">{{ $address->references }}</small>
                        @endif
                    </h6>

                    <div class="flex items-center gap-1.5">
                        <x-button wire:click='editAddressDetails({{ $address->id }})' type="secondary" class="h-max">
                            Editar detalles
                        </x-button>

                        <x-icon @click="confirmDeleteAddress = true" code="delete" x-tooltip.raw="Eliminar"
                            class="transition colors duration-300 ml-3
                        cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                        focus:outline-none focus:ring hover:text-red-500" />
                    </div>
                </dd>

                <x-modal ref="confirmDeleteAddress" type="danger" icon="warning" closeOnClickAway
                x-on:close-confirm-delete-address.window="confirmDeleteAddress = false">

                    <x-slot name="title">
                        Eliminar dirección
                    </x-slot>

                    <x-slot name="body">
                        ¿Estás seguro que deseas eliminar la dirección
                        <b class="text-gray-700">{{ $address->summary }}</b>?
                    </x-slot>

                    <x-slot name="actions">

                        <x-spinner wire:loading wire:target='deleteAddress' />

                        <x-button type="secondary" wire:loading.remove wire:target='deleteAddress'
                            @click="confirmDeleteAddress = false">Cancelar</x-button>

                        <x-button wire:click='deleteAddress({{ $address->id }})' wire:loading.remove
                            wire:target='deleteAddress' class="bg-red-600 hover:bg-red-500">Eliminar</x-button>

                    </x-slot>

                </x-modal>
            </div>
        @endforeach

        @include('ecommerce.customer.partials.settings.edit-address-details')
    </dl>

    <div class="mt-6">
        <x-button @click="$dispatch('open-new-address-panel')" size="large" class="py-3">
            Agregar dirección
        </x-button>
    </div>
</div>
