<div>
    <article class="mb-6">
        <div class="mx-auto max-w-7xl">

            <div class="mx-auto max-w-2xl lg:max-w-none">
                <x-button :href="route('admin.orders.index')" type="secondary" class="mb-6 inline-flex items-center">
                    <x-icon code="arrow_back" class="mr-1" /> Volver al listado
                </x-button>
            </div>

            <div class="flex flex-wrap justify-between mx-auto max-w-2xl lg:mx-0 lg:max-w-none">

                <div class="w-full lg:w-[65%] mb-6 lg:mb-0 flex flex-col gap-y-6">

                    <!-- Order Items -->
                    <div class="px-4 py-6 shadow-sm ring-1 ring-gray-900/5 rounded-lg">

                        <div class="text-gray-900 flex items-start justify-between mb-3 gap-3">

                            <div class="flex flex-col">

                                <h2 class="text-base font-semibold">

                                    <span>Pedido {{ $order->code }}</span>

                                    <x-badge :color="$order->status->display_color" class="w-max"
                                    x-tooltip.raw.placement.top="{{ $order->status->helper }}">
                                        {{ $order->status->name }}
                                    </x-badge>
                                </h2>

                                <small class="text-xs text-gray-600 mt-1">
                                    {{ $order->created_at->format('d/m/Y H:i:s') }}
                                </small>
                            </div>

                            <div x-data="{ openActions: false }" class="relative">

                                <i @click="openActions = !openActions" x-tooltip.raw.placement.top="Acciones"
                                class="material-symbols-outlined transition colors cursor-pointer bg-gray-100
                                text-gray-500 p-1.5 rounded-full hover:bg-gray-200 no-select
                                focus:outline-none focus:ring duration-300">more_horiz</i>

                                <div x-show="openActions" @click.away="openActions = false" x-cloak
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 top-12 z-10 w-max origin-top-right rounded-md 
                                bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                                    <a href="#"
                                        class="block px-3 py-1 text-sm leading-6 text-gray-700 
                                    transition hover:bg-gray-50">
                                        Accion para pedido 1
                                    </a>
                                    <a href="#"
                                        class="block px-3 py-1 text-sm leading-6 text-gray-700 
                                    transition hover:bg-gray-50">
                                        Accion para pedido 1
                                    </a>
                                    <a href="#"
                                        class="block px-3 py-1 text-sm leading-6 text-gray-700 
                                    transition hover:bg-gray-50">
                                        Accion para pedido 1
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div>
                            <ul role="list"
                            class="mt-6 divide-y divide-gray-200 border-t border-gray-200 text-sm font-medium text-gray-500">
                                @foreach ($order->items as $item)
                                    <li wire:key='{{ $item->id }}' class="flex space-x-6 py-6 items-center">
                                        <img src="{{ $item->product->first_image }}"
                                        alt="Imagen producto"
                                        class="h-10 w-10 flex-none rounded-md bg-gray-100 object-cover">
                                        <div class="flex-auto space-y-1">

                                            <h3 class="text-gray-900 line-clamp-2">
                                                <a href="{{ route('admin.products.edit', $item->product) }}"
                                                class="transition duration-200 hover:text-blue-600">
                                                    {{ $item->product->name }}
                                                </a>
                                            </h3>

                                            <p class="text-xs text-gray-500">
                                                Cantidad: {{ $item->quantity }}
                                            </p>

                                            @if ($item->variant && isset($item->variant->options))
                                                @foreach ($item->variant->options as $variantOption)
                                                    
                                                    <p class="text-xs text-gray-500">
                                                        {{ $variantOption->attribute->name }}:
                                                        {{ $variantOption->attributeValue->name }}
                                                    </p>
                                                @endforeach
                                            @endif
                                        </div>
                                        <p class="text-right font-medium text-gray-900">
                                            ${{ priceFormat($item->total) }} <br>
                                        </p>
                                    </li>
                                @endforeach
                            </ul>

                            <dl class="space-y-4 border-t border-gray-200 pt-4 text-sm font-medium text-gray-600">
                                <div class="flex justify-between">
                                    <dt>Subtotal</dt>
                                    <dd class="text-gray-900">
                                        ${{ priceFormat($order->subtotal) }}
                                    </dd>
                                </div>

                                @if ($order->shipping_cost > 0)
                                    <div class="flex justify-between">
                                        <dt class="flex flex-col">

                                            Envío

                                            @if ($order->shipping)
                                                <small class="text-gray-500 font-semibold">
                                                    {{ $order->shipping->provider_label }}
                                                </small>
                                            @endif
                                        </dt>
                                        <dd class="text-gray-900">
                                            ${{ priceFormat($order->shipping_cost) }}
                                        </dd>
                                    </div>
                                @endif

                                <div class="flex items-center justify-between border-t 
                                border-gray-200 pt-6 text-gray-900 font-semibold">
                                    <dt class="text-base">Total</dt>
                                    <dd class="text-base">
                                        ${{ priceFormat($order->total) }}
                                    </dd>
                                </div>
                            </dl>

                            {{-- <dl class="mt-16 grid grid-cols-2 gap-x-4 text-sm text-gray-600">
                              <div>
                                <dt class="font-medium text-gray-900">Shipping Address</dt>
                                <dd class="mt-2">
                                  <address class="not-italic">
                                    <span class="block">Kristin Watson</span>
                                    <span class="block">7363 Cynthia Pass</span>
                                    <span class="block">Toronto, ON N3Y 4H8</span>
                                  </address>
                                </dd>
                              </div>
                              <div>
                                <dt class="font-medium text-gray-900">Payment Information</dt>
                                <dd class="mt-2 space-y-2 sm:flex sm:space-y-0 sm:space-x-4">
                                  <div class="flex-none">
                                    <svg aria-hidden="true" width="36" height="24" viewBox="0 0 36 24" class="h-6 w-auto">
                                      <rect width="36" height="24" rx="4" fill="#224DBA"></rect>
                                      <path d="M10.925 15.673H8.874l-1.538-6c-.073-.276-.228-.52-.456-.635A6.575 6.575 0 005 8.403v-.231h3.304c.456 0 .798.347.855.75l.798 4.328 2.05-5.078h1.994l-3.076 7.5zm4.216 0h-1.937L14.8 8.172h1.937l-1.595 7.5zm4.101-5.422c.057-.404.399-.635.798-.635a3.54 3.54 0 011.88.346l.342-1.615A4.808 4.808 0 0020.496 8c-1.88 0-3.248 1.039-3.248 2.481 0 1.097.969 1.673 1.653 2.02.74.346 1.025.577.968.923 0 .519-.57.75-1.139.75a4.795 4.795 0 01-1.994-.462l-.342 1.616a5.48 5.48 0 002.108.404c2.108.057 3.418-.981 3.418-2.539 0-1.962-2.678-2.077-2.678-2.942zm9.457 5.422L27.16 8.172h-1.652a.858.858 0 00-.798.577l-2.848 6.924h1.994l.398-1.096h2.45l.228 1.096h1.766zm-2.905-5.482l.57 2.827h-1.596l1.026-2.827z" fill="#fff"></path>
                                    </svg>
                                    <p class="sr-only">Visa</p>
                                  </div>
                                  <div class="flex-auto">
                                    <p class="text-gray-900">Ending with 4242</p>
                                    <p>Expires 12 / 21</p>
                                  </div>
                                </dd>
                              </div>
                            </dl> --}}
                        </div>
                    </div>

                    {{-- Payment Details --}}
                    <div class="ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

                        <div class="flex items-center justify-between">
                            <h4 class="text-sm/6 font-semibold text-gray-900">Detalle de pago</h4>
                            <img src="{{ Storage::URL("providers/{$order->paymentMethod->code}.png") }}"
                                class="h-12 w-12 object-cover rounded-md"
                                alt="Logo {{ $order->paymentMethod->display_name }}">
                        </div>

                        <h5 class="mb-3 text-sm text-gray-700"> {{ $order->payment->status->helper }} </h5>

                        {{-- Principal Info --}}
                        <div class="flex flex-wrap gap-3">

                            <div class="flex flex-col gap-1 p-2">
                                <small class="text-xs text-gray-500 font-semibold">
                                    Estado
                                </small>
                                <span class="text-sm/6 text-gray-500">
                                    <x-badge :color="$order->payment->status->display_color">
                                        {{ $order->payment->status->name }}
                                    </x-badge>
                                </span>
                            </div>

                            @if (!empty($order->payment->external_id))
                                <div class="flex flex-col gap-1.5 p-2">
                                    <small class="text-xs text-gray-500 font-semibold">
                                        ID externo
                                    </small>
                                    <span class="text-sm/6 text-gray-500">
                                        {{ $order->payment->external_id }}
                                    </span>
                                </div>   
                            @endif

                            @if (!empty($order->payment->total_paid))
                                <div class="flex flex-col gap-1.5 p-2">
                                    <small class="text-xs text-gray-500 font-semibold">
                                        Total a pagar
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
                                <div class="flex flex-col gap-1.5 p-2">
                                    <small class="text-xs text-gray-500 font-semibold">
                                        Link de pago
                                    </small>
                                    <div class="flex gap-2">

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
        
                                    <div class="flex flex-wrap gap-3">
        
                                        @foreach ($order->payment->meta as $metaItem)
                                            @if (!empty($metaItem['value']))
                                                <div class="flex flex-col p-2">
                                                    <small class="text-xs text-gray-500 font-semibold">
                                                        {{ $metaItem['name'] }}
                                                    </small>
                                                    <span class="text-sm/6 text-gray-500">

                                                        @if (isset($metaItem['type']) && $metaItem['type'] === 'link')
                                                            <x-button :href="$metaItem['value']" blank type="secondary"
                                                            class="inline-block mt-1.5">
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
                            <x-button>Imprimir etiqueta</x-button>
                            <x-button type="secondary">Ver seguimiento</x-button>
                        </div>
                    </div>

                    {{-- Shipping Details --}}
                    @if ($order->shipping)
                        <div class="ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

                            <div class="flex items-center justify-between mb-1.5">
                                <h4 class="text-sm/6 font-semibold text-gray-900">Detalle de envío</h4>
                                <img src="{{ Storage::URL("providers/{$order->shippingProvider->code}.png") }}"
                                    class="h-12 w-32 object-cover rounded-md"
                                    alt="Logo {{ $order->shippingProvider->display_name }}">
                            </div>

                            <div class="flex flex-wrap">
                                <div class="flex w-full sm:w-1/2 gap-x-4 p-2">
                                    <dt class="flex-none">
                                        <span class="sr-only">Due date</span>
                                        <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true" data-slot="icon">
                                            <path
                                                d="M5.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V12ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM7.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H8a.75.75 0 0 1-.75-.75V12ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V10ZM10 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H10ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H12ZM11.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75V12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V10ZM14 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H14Z">
                                            </path>
                                            <path fill-rule="evenodd"
                                                d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </dt>
                                    <dd class="text-sm/6 text-gray-500">
                                        <time datetime="2023-01-31">January 31, 2023</time>
                                    </dd>
                                </div>

                                <div class="flex w-full sm:w-1/2 gap-x-4 p-2">
                                    <dt class="flex-none">
                                        <span class="sr-only">Status</span>
                                        <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true" data-slot="icon">
                                            <path fill-rule="evenodd"
                                                d="M2.5 4A1.5 1.5 0 0 0 1 5.5V6h18v-.5A1.5 1.5 0 0 0 17.5 4h-15ZM19 8.5H1v6A1.5 1.5 0 0 0 2.5 16h15a1.5 1.5 0 0 0 1.5-1.5v-6ZM3 13.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75Zm4.75-.75a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5Z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </dt>
                                    <dd class="text-sm/6 text-gray-500">Paid with MasterCard</dd>
                                </div>

                                <div class="flex w-full sm:w-1/2 gap-x-4 p-2">
                                    <dt class="flex-none">
                                        <span class="sr-only">Due date</span>
                                        <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true" data-slot="icon">
                                            <path
                                                d="M5.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V12ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM7.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H8a.75.75 0 0 1-.75-.75V12ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V10ZM10 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H10ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H12ZM11.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75V12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V10ZM14 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H14Z">
                                            </path>
                                            <path fill-rule="evenodd"
                                                d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </dt>
                                    <dd class="text-sm/6 text-gray-500">
                                        <time datetime="2023-01-31">January 31, 2023</time>
                                    </dd>
                                </div>

                                <div class="flex w-full sm:w-1/2 gap-x-4 p-2">
                                    <dt class="flex-none">
                                        <span class="sr-only">Status</span>
                                        <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true" data-slot="icon">
                                            <path fill-rule="evenodd"
                                                d="M2.5 4A1.5 1.5 0 0 0 1 5.5V6h18v-.5A1.5 1.5 0 0 0 17.5 4h-15ZM19 8.5H1v6A1.5 1.5 0 0 0 2.5 16h15a1.5 1.5 0 0 0 1.5-1.5v-6ZM3 13.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75Zm4.75-.75a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5Z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </dt>
                                    <dd class="text-sm/6 text-gray-500">Paid with MasterCard</dd>
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-3">
                                <x-button>Imprimir etiqueta</x-button>
                                <x-button type="secondary">Ver seguimiento</x-button>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="w-full lg:w-[32%] flex flex-col gap-y-6">

                    <!-- Customer -->
                    <div class="rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5 py-6 px-4">
                        <div class="pb-3 border-b">
                            <dt
                                class="flex justify-between items-center text-sm/6 
                            font-semibold text-gray-900 mb-1.5">

                                <span>Cliente</span>

                                @if ($order->user->type === CustomerType::Registered)
                                    <x-badge color="indigo">Registrado</x-badge>
                                @else
                                    <x-badge class="bg-white">Invitado</x-badge>
                                @endif
                            </dt>
                            <dd class="mt-1 text-base font-semibold text-gray-900">
                                {{ $order->user->full_name }}
                            </dd>
                        </div>

                        <div class="w-full pt-3">
                            <div class="mb-3">
                                <dt class="text-xs text-gray-500">
                                    Email
                                </dt>
                                <dd class="text-sm/6 font-medium text-gray-700">
                                    {{ $order->user->email }}
                                </dd>
                            </div>

                            <div class="flex flex-wrap gap-6">
                                <div class="flex flex-col">
                                    <dt class="text-xs text-gray-500">
                                        Teléfono
                                    </dt>
                                    <dd class="text-sm font-medium text-gray-700">
                                        {{ $order->user->phone }}
                                    </dd>
                                </div>

                                <div class="flex flex-col">
                                    <dt class="text-xs text-gray-500">
                                        DNI
                                    </dt>
                                    <dd class="text-sm font-medium text-gray-700">
                                        {{ $order->user->document }}
                                    </dd>
                                </div>
                            </div>

                        </div>
                        <div class="mt-3 pt-3 border-t border-gray-900/5">
                            <a href="#" class="text-sm/6 font-semibold text-gray-900">
                                Download receipt <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>

                    <!-- Activity Feed -->
                    <div>
                        <h2 class="text-sm/6 font-semibold text-gray-900">Historial de pedido</h2>
                        <ul role="list" class="mt-6 space-y-6">
                            @forelse ($order->feed as $feedItem)
                                <li wire:key='{{ $feedItem->id }}'>
                                    <div class="relative flex gap-x-4">
                                        @if (!$loop->last)
                                            <div class="absolute -bottom-6 left-0 top-0 flex w-6 justify-center">
                                                <div class="w-px bg-gray-200"></div>
                                            </div>
                                        @endif

                                        @if ($feedItem->presentation === OrderFeedPresentation::Icon)
                                            @php
                                                $iconColor = data_get($feedItem, 'meta.icon_color', 'blue');
                                            @endphp

                                            <div class="flex items-center justify-center rounded-full h-6 w-6 flex-none">
                                                <x-icon :code="data_get($feedItem, 'meta.icon_code', 'update')"
                                                    class="relative border rounded-full p-0.5
                                                bg-{{ $iconColor }}-100 text-{{ $iconColor }}-600 border-{{ $iconColor }}-600" />
                                            </div>
                                        @endif

                                        @if ($feedItem->presentation === OrderFeedPresentation::Image)
                                            <img src="{{ data_get($feedItem, 'meta.img_src') }}"
                                                class="relative h-7 w-7 flex-none rounded-full bg-gray-50 -left-[1.5px]">
                                        @endif

                                        @if ($feedItem->presentation === OrderFeedPResentation::InitialsImage)
                                            <img src="{{ initialsAvatar([
                                                'name' => $feedItem->initializator,
                                                'background' => '#2563eb',
                                                'color' => '#fff',
                                                'bold' => false,
                                            ]) }}"
                                                class="relative h-7 w-7 flex-none rounded-full bg-gray-50 -left-[1.5px]">
                                        @endif

                                        @if (!empty($feedItem->comments))
                                            <div class="flex-auto rounded-md p-3 ring-1 ring-inset ring-gray-200">
                                                <div class="flex justify-between gap-x-4">
                                                    <div class="py-0.5 text-xs/5 text-gray-500">

                                                        <span class="font-medium text-gray-900">
                                                            {{ $feedItem->initializator }}
                                                        </span>

                                                        <span>
                                                            {{ $feedItem->action }}
                                                        </span>
                                                    </div>
                                                    <time class="flex-none py-0.5 text-xs text-gray-500 ml-auto">
                                                        3d ago
                                                    </time>
                                                </div>
                                                <p class="text-xs pt-1 text-gray-500">
                                                    {{ $feedItem->comments }}
                                                </p>
                                            </div>
                                        @else
                                            <p class="py-0.5 text-xs/4 text-gray-500">
                                                <span class="font-medium text-gray-900">
                                                    {{ $feedItem->initializator }}
                                                </span>

                                                <span>
                                                    {{ $feedItem->action }}
                                                </span>
                                            </p>
                                            <time class="flex-none py-0.5 text-xs text-gray-500 ml-auto">2d</time>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <li class="text-sm text-gray-500">No hay registros</li>
                            @endforelse
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </article>
</div>
