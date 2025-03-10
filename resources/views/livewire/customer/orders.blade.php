<div>
    <div class="py-10 bg-white">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
            <div class="mx-auto max-w-2xl px-4 lg:max-w-4xl lg:px-0">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                    Tus pedidos
                </h1>
                <p class="mt-2 text-sm text-gray-500">
                    Estos son todos tus pedidos realizados en {{ tenant('ecommerce_name') }}.
                </p>
            </div>
        </div>

        <div class="mt-8">
            <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">

                <ul role="list" class="divide-y divide-gray-100 mx-auto max-w-2xl 
                px-4 lg:max-w-4xl lg:px-0">
                    @foreach ($orders as $order)
                        <li wire:key='{{ $order->id }}'>
                            <span class="flex items-center 
                            justify-between gap-x-6 py-4">
                                <div class="min-w-0">
                                    <div class="flex items-start gap-x-3">
                                        <p class="text-sm/6 font-semibold text-gray-900">
                                            Pedido {{ $order->id }}
                                        </p>
                                        <x-badge :color="$order->status->color()">
                                            {{ $order->status->customerName() }}
                                        </x-badge>
                                    </div>
                                    <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
                                        <p class="whitespace-nowrap">
                                            {{ getDateName($order->created_at) }}
                                        </p>
                                        <svg viewBox="0 0 2 2" class="w-1 h-1 fill-current">
                                            <circle cx="1" cy="1" r="1" />
                                        </svg>
                                        <p class="truncate">{{ $order->status->customerHelper() }}</p>
                                    </div>
                                </div>
                                <div class="hidden sm:flex items-center gap-x-4">

                                    <span class="font-semibold text-green-700">
                                        ${{ priceFormat($order->total) }}
                                    </span>

                                    <x-button type="secondary" href="#">
                                        Ver detalle
                                    </x-button>
                                </div>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
