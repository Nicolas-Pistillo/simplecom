<div x-data="{ confirmShippingCreate: false, showBranchDetails: false }"
x-on:close-confirm-shipping-create.window="confirmShippingCreate = false" 
class="ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

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
                    Estado
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->shipping->external_status }}
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

    {{-- Additional info --}}
    @if (!empty($order->shipping->meta) && count($order->shipping->meta))

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
                    @foreach ($order->shipping->meta as $metaItem)

                        @if (isset($metaItem['internal'])) @continue @endif

                        @if (!empty($metaItem['value']))

                            <div class="flex flex-col p-2">

                                <small class="text-xs text-gray-500 font-semibold">
                                    {{ $metaItem['name'] }}
                                </small>
                                
                                <span class="text-sm text-gray-500">

                                    @if (isset($metaItem['type']) && $metaItem['type'] === 'link')
                                        <x-button :href="$metaItem['value']" blank type="secondary"
                                        class="inline-block mt-1.5" size="tiny">
                                            Abrir enlace
                                        </x-button>
                                    @else
                                        {{ $metaItem['value'] }}
                                    @endif
                                </span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

    @endif

    <div class="mt-4 flex flex-wrap gap-3">

        @if ($order->shipping->status_code === ShippingStatusCode::CreationPending)
            <x-button @click="confirmShippingCreate = true">Crear orden de envío</x-button>

            <x-modal ref="confirmShippingCreate" closeOnClickAway type="info" icon="local_shipping">

                <x-slot name="title">Nueva orden de envío</x-slot>

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

                    <x-button wire:click='createShippingOrder' wire:loading.remove wire:target='createShippingOrder'
                        class="mx-3">Confirmar</x-button>

                </x-slot>

            </x-modal>
        @endif

        @if (!empty($order->shipping->label_url))
            <x-button :href="$order->shipping->label_url" blank>Imprimir etiqueta</x-button>
        @endif
    </div>

    @include('admin.orders.partials.show.destiny-branch-details')
</div>
