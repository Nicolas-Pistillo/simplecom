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