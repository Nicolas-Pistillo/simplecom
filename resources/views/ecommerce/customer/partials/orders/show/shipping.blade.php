<div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5 p-4">
    <div class="pb-3 border-b">
        <dt class="flex justify-between items-center text-sm/6 
        font-semibold text-gray-900 mb-1">

            <span>Detalle de envío</span>

            <x-badge :color="$order->shipping->status->color()">
                {{ $order->shipping->status->customerName() }}
            </x-badge>
        </dt>
        <span class="text-xs font-semibold">
            {{ $order->shipping->status->customerHelper() }}
        </span>
    </div>

    <div class="w-full space-y-4 sm:space-y-6 pt-3">
        <div class="w-full flex-col justify-start items-start gap-4 flex">

            <div class="w-full border-gray-200 flex-col 
            justify-start items-start gap-3 flex text-sm">

                <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                    <h5 class="text-gray-600 leading-4 sm:leading-8">
                        Servicio
                    </h5>
                    <h4 class="sm:text-right text-gray-900 font-semibold">
                        {{ $order->shipping->provider_label }}
                    </h4>
                </div>

                @if (!empty($order->shipping->delivery_estimate))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">
                            Estimado
                        </h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->shipping->delivery_estimate }}
                        </h4>
                    </div>
                @endif

                @if (!empty($order->shipping->quoted_price))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">
                            Precio
                        </h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            ${{ $order->shipping->quoted_price }}
                        </h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>