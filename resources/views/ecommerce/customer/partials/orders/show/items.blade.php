<div>
    <ul role="list" class="divide-y divide-gray-200 text-sm font-medium text-gray-500">
        @foreach ($order->items as $item)
            <li x-data="{detailItemOpen: false}" wire:key='{{ $item->id }}'
            class="flex space-x-6 py-6 items-center">

                <img src="{{ $item->product->first_image }}" alt="Imagen producto"
                class="h-10 w-10 flex-none rounded-md bg-gray-100 object-contain">

                <div class="flex-auto space-y-1">

                    <h3 class="text-gray-900 line-clamp-2">
                        {{ $item->name }} 
                    </h3>

                    <p class="text-xs text-gray-500">
                        Cantidad: {{ $item->quantity }}
                        @if ($item->variant && isset($item->variant->options))
                            @foreach ($item->variant->options as $variantOption)
                            -   {{ $variantOption->attribute->name }}:
                                {{ $variantOption->attributeValue->name }}
                            @endforeach
                        @endif
                    </p>
                </div>

                <p class="text-right font-medium text-gray-900">
                    ${{ priceFormat($item->total) }}
                </p>
            </li>
        @endforeach
    </ul>

    <dl class="space-y-4 border-t border-gray-200 pt-4 text-sm font-medium text-gray-600">
        <div class="flex justify-between">
            <dt>Subtotal</dt>
            <dd class="text-gray-900">
                ${{ priceFormat($order->subtotal) }}
            </dd>
        </div>

        @if ($order->shipping_cost > 0)
            <div class="flex justify-between">
                <dt class="flex flex-col">

                    Envío

                    @if ($order->shipping)
                        <small class="text-gray-500 font-semibold">
                            {{ $order->shipping->provider_label }}
                        </small>
                    @endif
                </dt>
                <dd class="text-gray-900">
                    ${{ priceFormat($order->shipping_cost) }}
                </dd>
            </div>
        @endif

        <div
            class="flex items-center justify-between border-t 
        border-gray-200 pt-6 text-gray-900 font-semibold">
            <dt class="text-base">Total</dt>
            <dd class="text-base">
                ${{ priceFormat($order->total) }}
            </dd>
        </div>
    </dl>
</div>
