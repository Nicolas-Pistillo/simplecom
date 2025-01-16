<div>
    <article class="mb-6">
        <div class="mx-auto max-w-7xl">

            <div class="mx-auto max-w-2xl lg:max-w-none">
                <x-button :href="route('admin.orders.index')" type="secondary" 
                class="mb-6 inline-flex items-center">
                    <x-icon code="arrow_back" class="mr-1" /> Volver al listado
                </x-button>
            </div>

            <div class="mx-auto grid align-top max-w-2xl grid-cols-1 grid-rows-1 items-start gap-x-4 gap-y-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                <!-- Invoice summary -->
                <div class="lg:col-start-3 row-start-2 lg:row-start-auto lg:row-end-1">
                    <div class="rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5">
                        <dl class="flex flex-wrap">
                            <div class="flex-auto pl-6 pt-6">
                                <dt class="text-sm/6 font-semibold text-gray-900">Total</dt>
                                <dd class="mt-1 text-base font-semibold text-gray-900">
                                    ${{ priceFormat($order->total) }}
                                </dd>
                            </div>
                            <div class="flex-none self-end px-6 pt-4">
                                <dt class="sr-only">Status</dt>
                                <dd class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-600 ring-1 ring-inset ring-green-600/20">
                                    Pagado
                                </dd>
                            </div>
                            <div class="mt-4 flex w-full flex-none gap-x-4 border-t border-gray-900/5 px-6 pt-6">
                                <dt class="flex-none">
                                    <span class="sr-only">Client</span>
                                    <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </dt>
                                <dd class="text-sm/6 font-medium text-gray-900">{{ $order->user->full_name }}</dd>
                            </div>
                            <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
                                <dt class="flex-none">
                                    <span class="sr-only">Due date</span>
                                    <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path
                                            d="M5.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V12ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM7.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H8a.75.75 0 0 1-.75-.75V12ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V10ZM10 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H10ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H12ZM11.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75V12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V10ZM14 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H14Z" />
                                        <path fill-rule="evenodd"
                                            d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </dt>
                                <dd class="text-sm/6 text-gray-500">
                                    <time datetime="2023-01-31">January 31, 2023</time>
                                </dd>
                            </div>
                            <div class="my-4 flex w-full flex-none gap-x-4 px-6">
                                <dt class="flex-none">
                                    <span class="sr-only">Status</span>
                                    <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M2.5 4A1.5 1.5 0 0 0 1 5.5V6h18v-.5A1.5 1.5 0 0 0 17.5 4h-15ZM19 8.5H1v6A1.5 1.5 0 0 0 2.5 16h15a1.5 1.5 0 0 0 1.5-1.5v-6ZM3 13.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75Zm4.75-.75a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </dt>
                                <dd class="text-sm/6 text-gray-500">Paid with MasterCard</dd>
                            </div>
                        </dl>
                        {{-- <div class="mt-6 border-t border-gray-900/5 px-6 py-6">
                            <a href="#" class="text-sm/6 font-semibold text-gray-900">Download receipt <span
                                    aria-hidden="true">&rarr;</span></a>
                        </div> --}}
                    </div>
                </div>

                <!-- Activity Feed -->
                <div class="lg:col-start-3 row-start-5 lg:row-start-auto">
                    <h2 class="text-sm/6 font-semibold text-gray-900">Historial de actividad</h2>
                    <ul role="list" class="mt-6 space-y-6">
                        @forelse ($order->feed as $feedItem)

                            <li wire:key='{{ $feedItem->id }}' class="relative flex gap-x-4">

                                @if(!$loop->last)
                                    <div class="absolute -bottom-6 left-0 top-0 flex w-6 justify-center">
                                        <div class="w-px bg-gray-200"></div>
                                    </div>
                                @endif

                                @if ($feedItem->presentation === OrderFeedPresentation::Icon)

                                    @php
                                        $iconColor = data_get($feedItem, 'meta.icon_color', 'blue')
                                    @endphp

                                    <div class="flex items-center justify-center rounded-full h-6 w-6 flex-none">
                                        <x-icon :code="data_get($feedItem, 'meta.icon_code', 'update')" 
                                        class="relative border rounded-full p-0.5
                                        bg-{{ $iconColor }}-100 text-{{ $iconColor }}-600 border-{{ $iconColor }}-600 " />
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
                                        'bold' => false
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
                                    <p class="py-0.5 text-xs/5 text-gray-500">
                                        <span class="font-medium text-gray-900">
                                            {{ $feedItem->initializator }}
                                        </span> 

                                        <span>
                                            {{ $feedItem->action }}
                                        </span>
                                    </p>
                                    <time class="flex-none py-0.5 text-xs text-gray-500 ml-auto">2d</time>
                                @endif
                            </li>
                        @empty
                            <li class="text-sm text-gray-500">No hay registros</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Invoice -->
                <div class="px-4 py-6 shadow-sm ring-1 ring-gray-900/5 sm:mx-0 rounded-lg lg:col-span-2 lg:row-span-2 lg:row-end-2">

                    <div class="text-gray-900 flex items-start justify-between mb-3 gap-3">

                        <div class="flex flex-col">

                            <h2 class="text-base font-semibold">

                                <span>Pedido {{ $order->reference }}</span>

                                <x-badge :color="$order->status->display_color" class="w-max"
                                x-tooltip.raw.placement.top="{{ $order->status->helper }}">
                                    {{ $order->status->name }}
                                </x-badge>
                            </h2>

                            <small class="text-xs text-gray-600 mt-1">{{ $order->created_at->format('d/m/Y H:i:s') }}</small>
                        </div>
                    
                        <i class="material-symbols-outlined transition colors cursor-pointer bg-gray-100
                        text-gray-500 p-1.5 rounded-full hover:bg-gray-200 
                        focus:outline-none focus:ring duration-300">more_horiz</i>
                          
                    </div>

                    <table class="w-full whitespace-nowrap text-left text-sm/6">
                        <thead class="border-b border-gray-200 text-gray-900">
                            <tr class="text-xs">
                                <th scope="col" class="px-0 py-3 font-semibold">Productos</th>
                                <th scope="col" class="hidden py-3 pl-8 pr-0 text-center font-semibold sm:table-cell">
                                    Cantidad
                                </th>
                                <th scope="col" class="hidden py-3 pl-8 pr-0 text-center font-semibold sm:table-cell">
                                    Precio unit.
                                </th>
                                <th scope="col" class="py-3 pl-8 pr-0 text-center font-semibold">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr wire:key='{{ $item->id }}' class="border-b border-gray-100 text-xs">
                                    <td class="px-0 py-5 whitespace-normal align-middle">
                                        <div class="flex items-center gap-3">

                                            <img src="{{ $item->product->first_image }}" 
                                            class="w-10 h-10 rounded-full object-cover" 
                                            alt="{{ $item->name }}">

                                            <div>
                                                <h4 class="font-medium text-gray-900 line-clamp-2">{{ $item->name }}</h4>
                                                <h4 class="text-gray-500 mt-1">#ID {{ $item->product->id }}</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden py-5 pl-8 pr-0 text-center align-center tabular-nums text-gray-700 sm:table-cell">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="hidden py-5 pl-8 pr-0 text-center align-center tabular-nums text-gray-700 sm:table-cell">
                                        ${{ priceFormat($item->unit_price) }}
                                    </td>
                                    <td class="py-5 pl-8 pr-0 text-center align-center tabular-nums text-gray-700">
                                        ${{ priceFormat($item->total) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="row" class="px-0 pb-0 pt-6 font-normal text-gray-700 sm:hidden">
                                    Subtotal
                                </th>
                                <th scope="row" colspan="3"
                                class="hidden px-0 pb-0 pt-6 text-right font-normal text-gray-700 sm:table-cell">
                                    Subtotal
                                </th>
                                <td class="pb-0 pl-8 pr-0 pt-6 text-right tabular-nums text-gray-900">
                                    ${{ priceFormat($order->subtotal) }}
                                </td>
                            </tr>

                            @if ($order->shipping_cost > 0)
                                <tr>
                                    <th scope="row" class="pt-4 font-normal text-gray-700 sm:hidden">Envío</th>
                                    <th scope="row" colspan="3"
                                        class="hidden pt-4 text-right font-normal text-gray-700 sm:table-cell">Envío</th>
                                    <td class="pb-0 pl-8 pr-0 pt-4 text-right tabular-nums text-gray-900">
                                        ${{ priceFormat($order->shipping_cost) }}
                                    </td>
                                </tr>
                            @endif
                            
                            <tr>
                                <th scope="row" class="pt-4 font-semibold text-gray-900 sm:hidden">Total</th>
                                <th scope="row" colspan="3"
                                    class="hidden pt-4 text-right font-semibold text-gray-900 sm:table-cell">Total</th>
                                <td class="pb-0 pl-8 pr-0 pt-4 text-right font-semibold tabular-nums text-gray-900">
                                    ${{ priceFormat($order->total) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    {{-- <dl class="grid grid-cols-1 text-sm/6 sm:grid-cols-2">
                        <div class="mt-6 border-t border-gray-900/5 pt-6 sm:pr-4">
                            <dt class="font-semibold text-gray-900">From</dt>
                            <dd class="mt-2 text-gray-500"><span class="font-medium text-gray-900">Acme,
                                    Inc.</span><br>7363 Cynthia Pass<br>Toronto, ON N3Y 4H8</dd>
                        </div>
                        <div class="mt-8 sm:mt-6 sm:border-t sm:border-gray-900/5 sm:pl-4 sm:pt-6">
                            <dt class="font-semibold text-gray-900">To</dt>
                            <dd class="mt-2 text-gray-500"><span class="font-medium text-gray-900">Tuple,
                                    Inc</span><br>886 Walter Street<br>New York, NY 12345</dd>
                        </div>
                    </dl> --}}
                </div>

                {{-- Shipping Details --}}
                @if ($order->shipping)
                    <div class="col-span-2 ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

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
                                    <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path d="M5.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V12ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM7.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H8a.75.75 0 0 1-.75-.75V12ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V10ZM10 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H10ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H12ZM11.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75V12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V10ZM14 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H14Z"></path>
                                        <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd"></path>
                                    </svg>
                                </dt>
                                <dd class="text-sm/6 text-gray-500">
                                    <time datetime="2023-01-31">January 31, 2023</time>
                                </dd>
                            </div>
        
                            <div class="flex w-full sm:w-1/2 gap-x-4 p-2">
                                <dt class="flex-none">
                                    <span class="sr-only">Status</span>
                                    <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 0 0 1 5.5V6h18v-.5A1.5 1.5 0 0 0 17.5 4h-15ZM19 8.5H1v6A1.5 1.5 0 0 0 2.5 16h15a1.5 1.5 0 0 0 1.5-1.5v-6ZM3 13.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75Zm4.75-.75a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5Z" clip-rule="evenodd"></path>
                                    </svg>
                                </dt>
                                <dd class="text-sm/6 text-gray-500">Paid with MasterCard</dd>
                            </div>
        
                            <div class="flex w-full sm:w-1/2 gap-x-4 p-2">
                                <dt class="flex-none">
                                    <span class="sr-only">Due date</span>
                                    <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path d="M5.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V12ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM7.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H8a.75.75 0 0 1-.75-.75V12ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V10ZM10 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H10ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H12ZM11.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75V12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V10ZM14 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H14Z"></path>
                                        <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd"></path>
                                    </svg>
                                </dt>
                                <dd class="text-sm/6 text-gray-500">
                                    <time datetime="2023-01-31">January 31, 2023</time>
                                </dd>
                            </div>
                            
                            <div class="flex w-full sm:w-1/2 gap-x-4 p-2">
                                <dt class="flex-none">
                                    <span class="sr-only">Status</span>
                                    <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 0 0 1 5.5V6h18v-.5A1.5 1.5 0 0 0 17.5 4h-15ZM19 8.5H1v6A1.5 1.5 0 0 0 2.5 16h15a1.5 1.5 0 0 0 1.5-1.5v-6ZM3 13.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75Zm4.75-.75a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5Z" clip-rule="evenodd"></path>
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

                {{-- Payment Details --}}
                <div class="col-span-2 ring-1 ring-gray-900/5 shadow-sm col-start-1 rounded-lg py-6 px-4">

                    <div class="flex items-center justify-between mb-1.5">
                        <h4 class="text-sm/6 font-semibold text-gray-900">Detalle de pago</h4>
                        <img src="{{ Storage::URL("providers/{$order->paymentMethod->code}.png") }}" 
                        class="h-12 w-12 object-cover rounded-md"
                        alt="Logo {{ $order->paymentMethod->display_name }}">
                    </div>

                    <div class="flex flex-wrap">
                        <div class="flex w-full sm:w-1/2 gap-x-4 p-2">
                            <dt class="flex-none">
                                <span class="sr-only">Due date</span>
                                <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path d="M5.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V12ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM7.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H8a.75.75 0 0 1-.75-.75V12ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V10ZM10 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H10ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H12ZM11.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75V12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V10ZM14 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H14Z"></path>
                                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd"></path>
                                </svg>
                            </dt>
                            <dd class="text-sm/6 text-gray-500">
                                <time datetime="2023-01-31">January 31, 2023</time>
                            </dd>
                        </div>
    
                        <div class="flex w-full sm:w-1/2 gap-x-4 p-2">
                            <dt class="flex-none">
                                <span class="sr-only">Status</span>
                                <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 0 0 1 5.5V6h18v-.5A1.5 1.5 0 0 0 17.5 4h-15ZM19 8.5H1v6A1.5 1.5 0 0 0 2.5 16h15a1.5 1.5 0 0 0 1.5-1.5v-6ZM3 13.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75Zm4.75-.75a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5Z" clip-rule="evenodd"></path>
                                </svg>
                            </dt>
                            <dd class="text-sm/6 text-gray-500">Paid with MasterCard</dd>
                        </div>
    
                        <div class="flex w-full sm:w-1/2 gap-x-4 p-2">
                            <dt class="flex-none">
                                <span class="sr-only">Due date</span>
                                <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path d="M5.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V12ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM7.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H8a.75.75 0 0 1-.75-.75V12ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V10ZM10 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H10ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H12ZM11.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75V12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V10ZM14 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H14Z"></path>
                                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd"></path>
                                </svg>
                            </dt>
                            <dd class="text-sm/6 text-gray-500">
                                <time datetime="2023-01-31">January 31, 2023</time>
                            </dd>
                        </div>
                        
                        <div class="flex w-full sm:w-1/2 gap-x-4 p-2">
                            <dt class="flex-none">
                                <span class="sr-only">Status</span>
                                <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 0 0 1 5.5V6h18v-.5A1.5 1.5 0 0 0 17.5 4h-15ZM19 8.5H1v6A1.5 1.5 0 0 0 2.5 16h15a1.5 1.5 0 0 0 1.5-1.5v-6ZM3 13.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75Zm4.75-.75a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5Z" clip-rule="evenodd"></path>
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
            </div>
        </div>
    </article>
</div>
