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
                    @include('admin.orders.partials.show.items')

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
