<div x-data="{showDestinyAddressDetails: false, confirmShippingCreate: false}" 
x-on:open-confirm-shipping-create.window="confirmShippingCreate = true" 
x-on:close-confirm-shipping-create.window="confirmShippingCreate = false"
class="ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

    <div class="flex items-center justify-between flex-wrap">

        @php
            $shippingMethod = $order->shipping->customShippingMethod;
        @endphp

        <div class="flex items-center gap-1.5 flex-wrap">

            <h4 class="text-sm/6 font-semibold text-gray-900">Detalle de envío</h4>

            <x-badge :color="$order->shipping->status->color()">
                {{ $order->shipping->status->name() }}
            </x-badge>
        </div>

        @if ($shippingMethod->logo_url)
            <img src="{{ Storage::URL($shippingMethod->logo_url) }}" class="h-12 w-32 object-cover rounded-md"
            alt="Logo {{ $shippingMethod->name }}">
        @else
            <x-icon code="local_shipping" class="text-gray-400" style="font-size: 38px;" />
        @endif
    </div>

    <h5 class="mb-3 text-sm text-gray-700">
        {{ $order->shipping->status->helper() }}
    </h5>

    {{-- Principal Info --}}
    <div class="w-full space-y-4 sm:space-y-6">
        <div class="w-full flex-col justify-start items-start gap-4 flex">

            <div class="w-full border-gray-200 flex-col 
            justify-start items-start gap-3 flex text-sm">

                <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                    <h5 class="text-gray-600 leading-4 sm:leading-8">Opción elegida</h5>
                    <h4 class="sm:text-right text-gray-900 font-semibold">
                        {{ $shippingMethod->name }}
                    </h4>
                </div>

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
            </div>
        </div>
    </div>

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
                        Se creará una nueva orden de envío con <b>{{ $shippingMethod->name }}</b>
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
    </div>
</div>
