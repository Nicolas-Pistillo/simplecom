<div x-data="{ confirmShippingCreate: false, showBranchDetails: false }"
x-on:close-confirm-shipping-create.window="confirmShippingCreate = false" 
class="ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

    <div class="flex items-center justify-between">

        <div class="flex items-center gap-1.5 flex-wrap">

            <h4 class="text-sm/6 font-semibold text-gray-900">Detalle de envío</h4>

            <x-badge :color="$order->shipping->status->color()">
                {{ $order->shipping->status->name() }}
            </x-badge>
        </div>

        <img src="{{ Storage::URL("providers/{$order->shippingProvider->code}.png") }}"
            class="h-12 w-32 object-cover rounded-md" alt="Logo {{ $order->shippingProvider->display_name }}">
    </div>

    <h5 class="mb-3 text-sm text-gray-700">
        {{ $order->shipping->status->helper() }}
    </h5>

    {{-- Principal Info --}}
    <div class="flex items-end flex-wrap gap-3">

        @if (!empty($order->shipping->external_id))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    ID envío
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->shipping->external_id }}
                </span>
            </div>
        @endif

        @if (!empty($order->shipping->external_status))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Estado externo
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->shipping->external_status }}
                </span>
            </div>
        @endif

        @if (!empty($order->shipping->external_status_description))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Detalle de estado
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->shipping->external_status_description }}
                </span>
            </div>
        @endif

        @if (in_array($order->shipping->logistic_type, [LogisticType::OriginToDoor, LogisticType::DropoffToDoor]))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Destino
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->shipping->userAddress->summary }}
                </span>
            </div>
        @endif

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
                        {{ ucfirst($order->shipping->provider_carrier) }}
                    </span>
                </div>
            @endif
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

        @if (!empty($order->shipping->quoted_price))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Precio tarifado
                </small>
                <span class="text-sm/6 text-gray-500">
                    ${{ $order->shipping->quoted_price }}
                </span>
            </div>
        @endif

        @if (!empty($order->shipping->final_price))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Precio final
                </small>
                <span class="text-sm/6 text-gray-500">
                    ${{ $order->shipping->final_price }}
                </span>
            </div>
        @endif

    </div>

    {{-- Additional info --}}
    <div x-data="{open: false}">

        <button @click="open = !open"
        class="mt-2 py-1 px-3 w-max border bg-white rounded-full 
            text-xs text-gray-700 flex items-center cursor-pointer
            transition duration-300 hover:shadow-md hover:text-gray-900">
            <span class="flex items-center">
                <span x-text="open ? 'Ocultar información adicional' : 'Mostrar información adicional'"></span>
                <i x-text="open ? 'arrow_drop_down' : 'arrow_right'" class="material-symbols-outlined"></i>
            </span>
        </button>

        <div x-cloak x-show="open" x-collapse>
            <h4 class="my-3 text-sm/6 font-semibold text-gray-900">
                Información adicional
            </h4>

            <div class="flex flex-wrap gap-3 items-end">

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

                @foreach ($order->shipping->meta ?? [] as $metaItem)

                    @if (isset($metaItem['internal'])) @continue @endif

                    @if (!empty($metaItem['value']))

                        <div class="flex flex-col p-2">

                            <small class="text-xs text-gray-500 font-semibold">
                                {{ $metaItem['name'] }}
                            </small>
                            
                            <span class="text-sm text-gray-500">

                                @switch($metaItem['type'] ?? null)
                                    @case('link')
                                        <x-button :href="$metaItem['value']" blank type="secondary"
                                        class="inline-block mt-1.5" size="tiny">
                                            Abrir enlace
                                        </x-button>    
                                    @break
                                    @case('image')
                                            <img src="{{ $metaItem['value'] }}" alt="{{ $metaItem['name'] }}"
                                            class="w-24 h-24">
                                    @break
                                    @default 
                                    {{ $metaItem['value'] }}
                                @endswitch
                            </span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-4 flex flex-wrap gap-3">

        @if ($order->shipping->status === ShippingStatus::CreationPending)
            <x-button @click="confirmShippingCreate = true">Crear orden de envío</x-button>

            <x-modal ref="confirmShippingCreate" closeOnClickAway 
            title="Nueva orden de envío" type="info" icon="local_shipping">

                <x-slot name="body">
                    Se creará una nueva orden de envío con {{ $order->shippingProvider->name }}
                    y se le notificará al comprador que el pedido está listo para despachar.
                    <div class="mt-3">
                        <x-switch label="No volver a preguntar" />
                    </div>
                </x-slot>

                <x-slot name="actions">

                    <x-spinner wire:loading wire:target='createShippingOrder' />

                    <x-button type="secondary" wire:loading.remove wire:target='createShippingOrder'
                    @click="confirmShippingCreate = false">Cancelar</x-button>

                    <x-button wire:click='createShippingOrder' wire:loading.remove 
                    wire:target='createShippingOrder'>
                        Confirmar
                    </x-button>

                </x-slot>

            </x-modal>
        @endif

        @if ($order->shipping->status === ShippingStatus::OrderPayPending 
        && !empty($order->shipping->checkout_url))
            <x-button :href="$order->shipping->checkout_url" blank>Pagar orden de envío</x-button>
        @endif

        @if (!empty($order->shipping->label_url))
            <x-button :href="$order->shipping->label_url" blank>Imprimir etiqueta</x-button>
        @endif
    </div>

    @include('admin.orders.partials.show.destiny-branch-details')
</div>
