<div>
    <section class="py-10 sm:px-16 relative bg-gray-100">

        <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">

            <div class="w-full flex-col justify-start items-start gap-8 inline-flex">

                <div class="w-full justify-between items-center flex sm:flex-row flex-col gap-3">

                    <div class="w-full flex-col justify-center sm:items-start items-center gap-1 inline-flex">
                        <h2 class="text-gray-900 text-center text-2xl font-semibold font-manrope leading-9">
                            <span class="mr-1.5">Pedido {{ $order->id }}</span>
                            <x-badge :color="$order->status->color()" class="whitespace-nowrap">
                                {{ $order->status->customerName() }}
                            </x-badge>
                        </h2>
                        <span class="text-gray-500 text-sm font-medium leading-relaxed">
                            {{ getElapsedTime($order->created_at, true) }}
                        </span>
                    </div>

                    @auth
                        <x-button :href="route('customer.orders.index')" type="secondary" 
                        class="whitespace-nowrap">Ir al listado</x-button>
                    @endauth
                </div>

                <h3 class="font-semibold">
                    {{ $order->status->customerHelper() }}
                </h3>

                <div class="w-full justify-end items-start gap-8 inline-flex">

                    <div class="w-full flex-col justify-start items-start gap-8 inline-flex">

                        @include('ecommerce.customer.partials.orders.show.status-bar')

                        <div class="w-full flex flex-wrap justify-between mx-auto max-w-2xl 
                        lg:mx-0 lg:max-w-none">

                            <div class="w-full lg:w-[65%] mb-6 lg:mb-0 flex flex-col gap-y-6">
                                <!-- Order Items -->
                                <div class="bg-white px-4 py-6 shadow-sm ring-1 ring-gray-900/5 rounded-lg">
                                    <h2 class="text-lg font-semibold">Productos</h2>
                                    @include('ecommerce.customer.partials.orders.show.items')
                                </div>
                                <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                                    <h6 class="text-right text-gray-900 text-base font-medium leading-relaxed">Order Note:</h6>
                                    <p class="text-gray-500 text-sm font-normal leading-normal">Make sure to ship all the
                                        ordered items together by Friday. I've emailed you the details, so please check it an
                                        review it. Thank You!</p>
                                </div>
                            </div>

                            <div class="w-full lg:w-[32%] flex flex-col gap-y-6">

                                @if ($order->storePickup)
                                    @include('ecommerce.customer.partials.orders.show.store_pickup')
                                @endif

                                @if ($order->payment)
                                    @include('ecommerce.customer.partials.orders.show.payment')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
