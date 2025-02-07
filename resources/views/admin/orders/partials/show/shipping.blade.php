<div x-data="{ confirmShippingCreate: false, showBranchDetails: false }" class="ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

    <div class="flex items-center justify-between">

        <div class="flex items-center gap-1 flex-wrap">

            <h4 class="text-sm/6 font-semibold text-gray-900">Detalle de envío</h4>

            <x-badge :color="$order->shipping->status->display_color">
                {{ $order->shipping->status->name }}
            </x-badge>
        </div>

        <img src="{{ Storage::URL("providers/{$order->shippingProvider->code}.png") }}"
            class="h-12 w-32 object-cover rounded-md" alt="Logo {{ $order->shippingProvider->display_name }}">
    </div>

    <h5 class="mb-3 text-sm text-gray-700">
        {{ $order->shipping->status->helper }}
    </h5>

    {{-- Principal Info --}}
    <div class="flex items-end flex-wrap gap-3">

        @if (!empty($order->shipping->provider_service))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Servicio
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->shipping->provider_service }}
                </span>
            </div>
        @endif

        @if (!empty($order->shipping->logistic_type))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Tipo de logística
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->shipping->logistic_type->name() }}
                </span>
            </div>
        @endif

        @if (!empty($order->shipping->selected_branch))
            <div class="flex flex-col p-2">
                <small class="text-xs flex items-center text-gray-500 font-semibold">
                    Sucursal destino
                    <span @click="showBranchDetails = true">
                        <x-icon code="visibility" x-tooltip.raw.placement.top="Ver detalles"
                            class="ml-1.5 p-1 border rounded-full cursor-pointer 
                        hover:bg-gray-50 hover:text-blue-600 hover:border-gray-300"
                            style="font-size: 16px" />
                    </span>
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ data_get($order->shipping, 'selected_branch.name') }}
                </span>
            </div>
        @endif

        @if ($order->shippingProvider->type === ShippingMethodType::MultiCarrier)
            @if (!empty($order->shipping->provider_carrier))
                <div class="flex flex-col p-2">
                    <small class="text-xs text-gray-500 font-semibold">
                        Correo encargado
                    </small>
                    <span class="text-sm text-gray-500">
                        {{ $order->shipping->provider_carrier }}
                    </span>
                </div>
            @endif
        @endif

        @if (!empty($order->shipping->price))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Precio tarifado
                </small>
                <span class="text-sm/6 text-gray-500">
                    ${{ $order->shipping->price }}
                </span>
            </div>
        @endif

        @if (!empty($order->shipping->delivery_estimate))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Tiempo estimado
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->shipping->delivery_estimate }}
                </span>
            </div>
        @endif

    </div>

    <div class="mt-4 flex flex-wrap gap-3">

        @if ($order->shipping->status_code === ShippingStatusCode::CreationPending)
            <x-button @click="confirmShippingCreate = true">Crear orden de envío</x-button>

            <x-modal ref="confirmShippingCreate" closeOnClickAway type="info" icon="local_shipping">

                <x-slot name="title">Nueva orden de envío</x-slot>

                <x-slot name="body">
                    Se creará una nueva orden de envío en {{ $order->shippingProvider->name }}
                    y se le notificará al comprador que el pedido está listo para despachar.
                    <div class="mt-3">
                        <x-switch label="No volver a preguntar" />
                    </div>
                </x-slot>

                <x-slot name="actions">

                    <x-spinner wire:loading wire:target='createShippingOrder' />

                    <x-button type="secondary" wire:loading.remove wire:target='createShippingOrder'
                        @click="confirmShippingCreate = false">Cancelar</x-button>

                    <x-button wire:click='createShippingOrder' wire:loading.remove wire:target='createShippingOrder'
                        class="mx-3">Confirmar</x-button>

                </x-slot>

            </x-modal>
        @endif
    </div>

    <x-drawer ref="showBranchDetails">
        <div class="space-y-6 pb-16">
            <div>
                @php
                    $branch = $order->shipping->selected_branch;
                @endphp

                <gmp-map wire:ignore 
                center="{{ data_get($branch, 'address.coordinates.lat') }},{{ data_get($branch, 'address.coordinates.lng') }}" 
                zoom="15" map-id="shipping_branch_map" 
                class="mt-4 h-[130px] md:h-[250px] rounded-lg shadow-md overflow-hidden">
                    <gmp-advanced-marker position="{{ data_get($branch, 'address.coordinates.lat') }},{{ data_get($branch, 'address.coordinates.lng') }}"></gmp-advanced-marker>
                </gmp-map>

                <div class="mt-4 flex flex-col">
                    <h2 class="text-base font-semibold text-gray-900">
                        {{ data_get($branch, 'name') }}
                    </h2>
                    {{-- <small class="text-gray-600">
                        ID {{ data_get($branch, 'external_id') }}
                    </small> --}}
                </div>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">Información</h3>
                <dl class="mt-2 divide-y divide-gray-200 border-t border-b border-gray-200">
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Calle</dt>
                        <dd class="text-gray-900 max-w-[210px]">
                            {{ data_get($branch, 'address.street') }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Altura</dt>
                        <dd class="text-gray-900 max-w-[210px]">
                            {{ data_get($branch, 'address.number') }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Código Postal</dt>
                        <dd class="text-gray-900 max-w-[210px]">
                            {{ data_get($branch, 'address.zipcode') }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Localidad</dt>
                        <dd class="text-gray-900 max-w-[210px]">
                            {{ data_get($branch, 'address.locality') }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Provincia</dt>
                        <dd class="text-gray-900 max-w-[210px]">
                            {{ data_get($branch, 'address.state') }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Región</dt>
                        <dd class="text-gray-900 max-w-[210px]">
                            {{ data_get($branch, 'address.region', '-') }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Teléfono</dt>
                        <dd class="text-gray-900 max-w-[210px]">
                            {{ data_get($branch, 'phone', '-') }}
                        </dd>
                    </div>
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Horarios</dt>
                        <dd class="text-gray-900 max-w-[210px]">
                            {{ data_get($branch, 'schedule', '-') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </x-drawer>
</div>
