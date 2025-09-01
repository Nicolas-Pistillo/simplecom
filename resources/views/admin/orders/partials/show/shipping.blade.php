<div x-data="{ 
    confirmShippingCreate: false, 
    selectOriginBranch: false, 
    showBranchDetails: false,
    showDestinyAddressDetails: false
}"
x-on:open-confirm-shipping-create.window="confirmShippingCreate = true" 
x-on:close-confirm-shipping-create.window="confirmShippingCreate = false"
x-on:open-select-origin-branch.window="selectOriginBranch = true"
x-on:close-select-origin-branch.window="selectOriginBranch = false"
class="ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

    <div class="flex items-center justify-between flex-wrap">

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
    <div class="w-full space-y-4 sm:space-y-6">
        <div class="w-full flex-col justify-start items-start gap-4 flex">

            <div class="w-full border-gray-200 flex-col 
            justify-start items-start gap-3 flex text-sm">

                @if (!empty($order->shipping->external_id))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">ID externo</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->shipping->external_id }}
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->external_reference))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Referencia</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->shipping->external_reference }}
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->tracking_code))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Cod. Seguimiento</h5>
                        <h4
                            class="sm:text-right text-gray-900 font-semibold 
                        flex items-center gap-1.5">
                            {{ $order->shipping->tracking_code }}

                            @if (!empty($order->shipping->tracking_url))
                                <a href="{{ $order->shipping->tracking_url }}" target="_blank">
                                    <x-icon code="open_in_new" x-tooltip.raw="Ver seguimiento"
                                        class="transition colors duration-300 text-[16px]
                                    cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                    hover:bg-gray-200 focus:outline-none focus:ring" />
                                </a>
                            @endif
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->external_status))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Estado externo</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->shipping->external_status }}
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->external_status_description))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Descripción de estado</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->shipping->external_status_description }}
                        </h4>
                    </div>
                @endif

                @if ($order->shipping->logistic_type->isFromDoor())
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Origen</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->shipping->originPoint->name }}
                        </h4>
                    </div>
                @endif

                @if ($order->shipping->logistic_type->isToDoor())
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Destino</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold flex items-center gap-1.5">
                            {{ $order->shipping->userAddress->summary }}
                            <x-icon code="visibility" x-tooltip.raw="Ver detalles"
                            @click="showDestinyAddressDetails = true"
                            class="transition colors duration-300 text-[16px]
                            cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                            hover:bg-gray-200 focus:outline-none focus:ring" />
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->selected_branch))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Sucursal destino</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold flex items-center gap-1.5">
                            {{ data_get($order->shipping, 'selected_branch.name') }}
                            <x-icon code="visibility" x-tooltip.raw="Ver detalles"
                            @click="showBranchDetails = true"
                            class="transition colors duration-300 text-[16px]
                            cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                            hover:bg-gray-200 focus:outline-none focus:ring" />
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->provider_service))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Servicio</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->shipping->provider_service }}
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->provider_carrier))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Correo encargado</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->shipping->provider_carrier }}
                            @if (!empty($order->shipping->provider_carrier_logo))
                                <img src="{{ $order->shipping->provider_carrier_logo }}"
                                class="hidden sm:inline-flex w-16 h-8 object-contain rounded-lg ml-1"
                                alt="logo correo encargado">
                            @endif
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->logistic_type))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">
                            Tipo de logística
                        </h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->shipping->logistic_type->name() }}
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->delivery_estimate))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Tiempo estimado</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->shipping->delivery_estimate }}
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->quoted_price))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Precio tarifado</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            ${{ priceFormat($order->shipping->quoted_price) }}
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->final_price))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">Precio final</h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            ${{ priceFormat($order->shipping->final_price) }}
                        </h4>
                    </div>
                @endif

                {{-- Additional info --}}
                @if (!empty($order->shipping->meta))
                    <div x-data="{ open: false }" class="w-full">

                        <button @click="open = !open"
                            class="py-1 px-3 w-max border bg-white rounded-full 
                            text-xs text-gray-700 flex items-center cursor-pointer
                            transition duration-300 hover:shadow-md hover:text-gray-900">
                            <span class="flex items-center">
                                <span
                                    x-text="open ? 'Ocultar información adicional' : 'Mostrar información adicional'"></span>
                                <i x-text="open ? 'arrow_drop_down' : 'arrow_right'"
                                    class="material-symbols-outlined"></i>
                            </span>
                        </button>


                        <div x-cloak x-show="open" x-collapse>
                            <h4 class="my-3 text-sm/6 font-semibold text-gray-900">
                                Información adicional
                            </h4>

                            <div class="flex flex-wrap gap-3 items-end">

                                @foreach ($order->shipping->meta ?? [] as $metaItem)
                                    @if (isset($metaItem['internal']))
                                        @continue
                                    @endif

                                    @if (!empty($metaItem['value']))
                                        <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                                            <h5 class="text-gray-600 leading-4 sm:leading-8">
                                                {{ $metaItem['name'] }}
                                            </h5>
                                            <h4 class="sm:text-right text-gray-900 font-semibold">
                                                <span>

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
                                            </h4>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('admin.orders.partials.show.destiny-branch-details')

    @include('admin.orders.partials.show.destiny-address-details')

    <div class="mt-4 flex flex-wrap gap-3">

        @if ($order->shipping->status === ShippingStatus::NotCreated)

            @if (!$order->is_confirmed())
                <div x-tooltip.raw="Se requiere confirmación de pago del pedido para avanzar con su entrega.
                Si ya recibiste el pago y el pedido no se actualizó, podes aprobar el pago manualmente.">
                    <x-button disabled>Crear orden de envío</x-button>
                </div>
            @else
                <x-button @click="confirmShippingCreate = true">Crear orden de envío</x-button>

                {{-- Droor-Origin shipping creation --}}
                <x-modal ref="confirmShippingCreate" closeOnClickAway title="Nueva orden de envío" 
                type="info" icon="local_shipping">

                    <x-slot name="body">
                        Se creará una nueva orden de envío con {{ $order->shippingProvider->name }}
                        y se le notificará al comprador que el pedido está listo para despachar.
                    </x-slot>

                    <x-slot name="actions">

                        <x-spinner wire:loading wire:target='createShippingOrder' />

                        <x-button type="secondary" wire:loading.remove wire:target='createShippingOrder'
                            @click="confirmShippingCreate = false">Cancelar</x-button>

                        <x-button wire:click='createShippingOrder' 
                        wire:loading.remove wire:target='createShippingOrder'>
                            Confirmar
                        </x-button>

                    </x-slot>

                </x-modal>
            @endif
            
        @endif

        @if ($order->shipping->status === ShippingStatus::OrderPayPending && !empty($order->shipping->checkout_url))
            <x-button :href="$order->shipping->checkout_url" blank>Pagar orden de envío</x-button>
        @endif

        @if (!empty($order->shipping->label_url))
            <x-button :href="$order->shipping->label_url" blank>Imprimir etiqueta</x-button>
        @endif

        @if (!empty($order->shipping->tracking_url))
            <x-button :href="$order->shipping->tracking_url" blank>Ver seguimiento</x-button>
        @endif
    </div>
</div>
