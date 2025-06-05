<div>
    <div class="relative isolate overflow-hidden">

        <!-- Secondary navigation -->
        <header class="pb-4 pt-6 sm:pb-6">
                <div class="mx-auto flex max-w-7xl flex-wrap items-center gap-6 sm:flex-nowrap">
                    <h1 class="text-base font-semibold leading-7 text-gray-900">Cashflow</h1>
                    <div
                        class="order-last flex w-full gap-x-8 text-sm font-semibold leading-6 sm:order-none sm:w-auto sm:border-l sm:border-gray-200 sm:pl-6 sm:leading-7">
                        <a href="#" class="text-indigo-600">Last 7 days</a>
                        <a href="#" class="text-gray-700">Last 30 days</a>
                        <a href="#" class="text-gray-700">All-time</a>
                    </div>
                    <x-button type="secondary" class="ml-auto flex items-center">
                        <x-icon code="add" class="mr-1" /> New invoince
                    </x-button>
                </div>
            </header>

        <div class="grid gap-8 sm:grid-cols-2 xl:grid-cols-4">
            <div>
                <div class="mt-6 text-lg/6 font-medium sm:text-sm/6">Cant. pedidos</div>
                <div class="mt-3 text-3xl/8 font-semibold sm:text-2xl/8">
                    {{ App\Models\Order::count() }}
                </div>
                {{-- <div class="mt-3 text-sm/6 sm:text-xs/6">
                        <x-badge color="emerald">+7.02%</x-badge>
                        <span class="text-zinc-500">from last week</span>
                    </div> --}}
            </div>
            <div>
                <div class="mt-6 text-lg/6 font-medium sm:text-sm/6">Ticket Medio</div>
                <div class="mt-3 text-3xl/8 font-semibold sm:text-2xl/8">
                    ${{ priceFormat($averageTicket) }}
                </div>
                <div class="mt-3 text-sm/6 sm:text-xs/6">
                    <x-badge color="red">-0.5%</x-badge>
                    <span class="text-zinc-500">from last week</span>
                </div>
            </div>
            <div>
                <div class="mt-6 text-lg/6 font-medium sm:text-sm/6">Tickets sold</div>
                <div class="mt-3 text-3xl/8 font-semibold sm:text-2xl/8">5,888</div>
                <div class="mt-3 text-sm/6 sm:text-xs/6">
                    <x-badge color="emerald">+21.2%</x-badge>
                    <span class="text-zinc-500">from last week</span>
                </div>
            </div>
            <div>
                <div class="mt-6 text-lg/6 font-medium sm:text-sm/6">Pageviews</div>
                <div class="mt-3 text-3xl/8 font-semibold sm:text-2xl/8">823,067</div>
                <div class="mt-3 text-sm/6 sm:text-xs/6">
                    <x-badge color="emerald">+21.2%</x-badge>
                    <span class="text-zinc-500">desde la semana pasada</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 flex flex-wrap sm:flex-nowrap gap-4">

        <div class="w-full pt-6 h-max bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
            <div class="flex items-center justify-between px-4 pb-4 border-b">
                <h5 class="text-xl font-bold leading-none text-gray-900">Pedidos Recientes</h5>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-blue-600 hover:underline">
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
                                    <p class="text-sm text-gray-500 truncate">
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

        <div class="w-full pt-6 h-max bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
            <div class="flex items-center justify-between px-4 pb-4 border-b">
                <h5 class="text-xl font-bold leading-none text-gray-900">Clientes Recientes</h5>
                <a href="{{ route('admin.customers.index') }}" class="text-sm font-medium text-blue-600 hover:underline">
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
                                    <p class="text-sm text-gray-500 truncate">
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
