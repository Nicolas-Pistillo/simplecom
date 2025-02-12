<div class="ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

    <div class="flex items-center justify-between mb-2 sm:mb-0">

        <div class="flex items-center gap-1.5 flex-wrap">

            <h4 class="text-sm/6 font-semibold text-gray-900">Detalle de pago</h4>

            <x-badge :color="$order->payment?->status->color()">
                {{ $order->payment?->status->name() }}
            </x-badge>
        </div>

        <img src="{{ Storage::URL("providers/{$order->paymentMethod->code}.png") }}"
            class="h-12 w-12 object-cover rounded-md"
            alt="Logo {{ $order->paymentMethod->display_name }}">
    </div>

    <h5 class="mb-3 text-sm text-gray-700"> {{ $order->payment?->status->helper() }} </h5>

    @if (!$order->payment)
        <h5 class="mb-3 text-sm text-red-500"> 
            Ocurrio un error al recuperar la información del pago
        </h5>
    @endif

    {{-- Principal Info --}}
    <div class="flex flex-wrap gap-3">

        @if (!empty($order->payment?->external_id))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    ID externo
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->payment->external_id }}
                </span>
            </div>   
        @endif

        @if (!empty($order->payment->total_paid))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Pago total
                </small>
                <span class="text-sm/6 text-gray-500">
                    ${{ priceFormat($order->payment->total_paid) }}

                    @if (!empty($order->payment->installments))
                        @if ($order->payment->installments == 1)
                            en un pago
                        @else
                            en {{ $order->payment->installments }} cuotas
                        @endif
                    @endif
                </span>
            </div>   
        @endif

        @if (!empty($order->payment->checkout_url))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Link de pago
                </small>
                <div class="flex gap-2 mt-1.5">

                    <a href="{{ $order->payment->checkout_url }}" target="_blank"
                    x-tooltip.raw.placement.bottom="Abrir">
                        <x-icon code="open_in_new" style="font-size: 18px"
                        class="p-1 rounded-full text-gray-700 border bg-white
                        hover:bg-gray-50 hover:text-black transition duration-200"
                        />
                    </a>

                    <span class="cursor-pointer" x-tooltip.raw.placement.bottom="Copiar">
                        <x-icon code="content_copy" style="font-size: 18px"
                        class="p-1 rounded-full text-gray-700 border bg-white
                        hover:bg-gray-50 hover:text-black transition duration-200"
                        />
                    </span>
                </div>
            </div>    
        @endif

        @if (!empty($order->payment->instrument))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Forma de pago
                </small>
                <span class="text-sm text-gray-500">
                    {{ $order->payment->instrument }}
                </span>
            </div>
        @endif

    </div>

    {{-- Additional info --}}
    @if (!empty($order->payment->meta) && count($order->payment->meta))

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
                    @foreach ($order->payment->meta as $metaItem)

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
        @if ($order->payment?->status === PaymentStatus::TransferPending)
            <x-button>Ya recibí el pago</x-button>
        @endif
    </div>
</div>