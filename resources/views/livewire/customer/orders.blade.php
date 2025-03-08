<div>
    <div class="py-16 bg-white">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
            <div class="mx-auto max-w-2xl px-4 lg:max-w-4xl lg:px-0">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                    Tus pedidos
                </h1>
                <p class="mt-2 text-sm text-gray-500">
                    A continuación se listan todos tus pedidos realizados en {{ tenant('ecommerce_name') }}.
                </p>
            </div>
        </div>

        <div class="mt-8">
            <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
                <ul class="mx-auto max-w-2xl space-y-8 sm:px-4 lg:max-w-4xl lg:px-0">

                    @foreach ($orders as $order)
                        <li wire:key='{{ $order->id }}' 
                        class="border-t border-b border-gray-200 bg-white 
                        shadow-sm sm:rounded-lg sm:border">
                            <div class="flex items-center border-b border-gray-200 p-4 sm:grid sm:grid-cols-4 sm:gap-x-6 sm:p-6">
                                <dl class="grid flex-1 grid-cols-3 gap-x-6 text-sm sm:col-span-3 lg:col-span-2">
                                    <div>
                                        <dt class="font-medium text-gray-900">Pedido</dt>
                                        <dd class="mt-1 text-gray-500">{{ $order->id }}</dd>
                                    </div>
                                    <div>
                                        <dt class="font-medium text-gray-900">Fecha</dt>
                                        <dd class="mt-1 text-gray-500">
                                            <time>
                                                {{ getDateName($order->created_at) }}
                                            </time>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="font-medium text-gray-900">Total</dt>
                                        <dd class="mt-1 font-medium text-gray-900">${{ priceFormat($order->total) }}</dd>
                                    </div>
                                </dl>

                                <div class="hidden lg:col-span-2 lg:flex lg:items-center lg:justify-end lg:space-x-4">
                                    <x-button type="secondary" size="large">Ver detalle</x-button>
                                    <x-button type="secondary" size="large">Descargar factura</x-button>
                                </div>
                            </div>

                            <div class="p-4 flex flex-wrap gap-2 justify-between border-b">

                                <x-badge :color="$order->status->color()">
                                    {{ $order->status->customerName() }}
                                </x-badge>

                                <p class="text-sm text-gray-500"> {{ $order->status->customerHelper() }} </p>
                            </div>

                            <!-- Products -->
                            <ul role="list" class="divide-y text-sm font-medium text-gray-500">
                                @foreach ($order->items as $item)
                                <li x-data="{ detailItemOpen: false }" wire:key="23"
                                class="flex space-x-6 py-6 px-4 items-center
                                transition duration-200"
                                @click="detailItemOpen = !detailItemOpen">

                                    <img src="{{ $item->product->first_image }}" alt="Imagen producto"
                                    class="h-10 w-10 flex-none rounded-md bg-gray-100 object-contain">
                    
                                    <div class="flex-auto space-y-1">
                    
                                        <h3 class="text-gray-900 line-clamp-2">
                                            {{ $item->name }} 
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
                                        ${{ priceFormat($item->total) }}
                                    </p>
                                </li>
                                @endforeach
                            </ul>

                            <div class="p-4 sm:flex sm:justify-between">
                                <div class="flex items-center">
                                    <svg class="w-10 h-10 text-green-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd"></path>
                                    </svg>

                                    <p class="ml-2 text-sm font-medium text-gray-500">Delivered on <time datetime="2021-01-05">January 5, 2021</time></p>
                                </div>

                                <div class="mt-6 flex items-center divide-x divide-gray-200 border-t border-gray-200 pt-4 text-sm font-medium sm:mt-0 sm:ml-4 sm:border-none sm:pt-0">
                                    <div class="flex flex-1 justify-center pr-4">
                                        <a href="#" class="whitespace-nowrap text-indigo-600 hover:text-indigo-500">View
                                            product</a>
                                    </div>
                                    <div class="flex flex-1 justify-center pl-4">
                                        <a href="#" class="whitespace-nowrap text-indigo-600 hover:text-indigo-500">Buy
                                            again</a>
                                    </div>
                                </div>
                            </div>

                        </li>                        
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
