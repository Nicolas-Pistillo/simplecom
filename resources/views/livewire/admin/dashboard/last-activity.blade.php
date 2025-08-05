<div>

    <div class="flex flex-wrap sm:flex-nowrap gap-4">

        <div class="w-full h-max bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
            <div class="flex items-center justify-between px-4 py-6 border-b">
                <h5 class="text-xl font-bold leading-none text-gray-900">Ultimos pedidos</h5>
                <a href="{{ route('admin.orders.index') }}"
                    class="text-sm font-medium text-blue-600 hover:underline">
                    Ver todos
                </a>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 flex flex-col">
                    @foreach ($lastOrders as $order)
                        <li wire:key='last-order-{{ $order->id }}'>
                            <a href="{{ $order->detailPage() }}"
                                class="flex items-center py-3.5 px-4 hover:bg-gray-50">
                                <div class="shrink-0">
                                    <x-icon code="shopping_bag" class="text-gray-700" />
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm text-gray-900 truncate">
                                        {{ $order->user->full_name }}
                                    </p>
                                    <p class="text-xs text-gray-500 truncate">
                                        Pedido #{{ $order->id }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    ${{ $order->total }}
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="w-full h-max bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
            <div class="flex items-center justify-between px-4 py-6 border-b">
                <h5 class="text-xl font-bold leading-none text-gray-900">Ultimos clientes</h5>
                <a href="{{ route('admin.customers.index') }}"
                    class="text-sm font-medium text-blue-600 hover:underline">
                    Ver todos
                </a>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 flex flex-col">
                    @foreach ($lastCustomers as $customer)
                        <li wire:key='last-customer-{{ $order->id }}'>
                            <a href="{{ $customer->pageUrl() }}"
                                class="flex items-center py-3.5 px-4 hover:bg-gray-50">
                                <div class="shrink-0">
                                    <img src="{{ initialsAvatar(['name' => $customer->full_name]) }}"
                                        alt="{{ $customer->full_name }}" class="w-8 h-8 rounded-full">
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm text-gray-900 truncate">
                                        {{ $customer->full_name }}
                                    </p>
                                    <p class="text-xs text-gray-500 truncate">
                                        {{ $customer->email }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    <x-badge :color="$customer->type->color()">
                                        {{ $customer->type->name() }}
                                    </x-badge>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
