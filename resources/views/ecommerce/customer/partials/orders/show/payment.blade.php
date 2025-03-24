<div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5 p-4">
    <div class="pb-3 border-b">
        <dt class="flex justify-between items-center text-sm/6 
        font-semibold text-gray-900">

            <span>Detalle de pago</span>

            <x-badge :color="$order->payment->status->color()">
                {{ $order->payment->status->name() }}
            </x-badge>
        </dt>
        <span class="text-xs font-semibold">
            {{ $order->payment->status->customerHelper() }}
        </span>
    </div>

    <div class="w-full space-y-4 sm:space-y-6 pt-3">
        <div class="w-full flex-col justify-start items-start gap-4 flex">

            <div class="w-full border-gray-200 flex-col 
            justify-start items-start gap-3 flex text-sm">

                <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                    <h5 class="text-gray-600 leading-4 sm:leading-8">
                        Forma
                    </h5>
                    <h4 class="sm:text-right text-gray-900 font-semibold">
                        {{ $order->paymentMethod->display_name }}
                    </h4>
                </div>

                @if (!empty($order->payment->instrument))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">
                            Método
                        </h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->payment->instrument }}
                        </h4>
                    </div>
                @endif

                @if (!empty($order->payment->installments) 
                && is_numeric($order->payment->installments) 
                && $order->payment->installments > 1)
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">
                            Cuotas
                        </h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->payment->installments }}
                        </h4>
                    </div>
                    
                @endif

                @if (!empty($order->payment->external_id))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">
                            Referencia
                        </h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            {{ $order->payment->external_id }}
                        </h4>
                    </div>
                @endif

                @if (!empty($order->payment->total_paid))
                    <div class="w-full justify-between items-center gap-6 sm:inline-flex">
                        <h5 class="text-gray-600 leading-4 sm:leading-8">
                            Total pagado
                        </h5>
                        <h4 class="sm:text-right text-gray-900 font-semibold">
                            ${{ $order->payment->total_paid }}
                        </h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>