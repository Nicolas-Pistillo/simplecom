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
                                    {{ $order->created_at->format('d/m/Y H:i') }}
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
                    
                        @include('admin.orders.partials.show.items')
                    </div>

                    {{-- Payment Details --}}
                    @include('admin.orders.partials.show.payment')

                    {{-- Shipping Details --}}
                    @if ($order->shipping)
                        @include('admin.orders.partials.show.shipping')
                    @endif

                </div>

                <div class="w-full lg:w-[32%] flex flex-col gap-y-6">

                    <!-- Customer -->
                    @include('admin.orders.partials.show.customer')

                    <!-- Activity Feed -->
                    @include('admin.orders.partials.show.feed')

                </div>
            </div>
        </div>
    </article>
</div>
