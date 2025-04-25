<div class="py-4">
    <h2 class="text-base font-semibold text-gray-900 flex items-center gap-1">
        <x-icon code="shopping_cart" />
        Pedidos realizados
    </h2>
    <div class="mt-4 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto" scrollbar-thin>
            <div class="inline-block min-w-full py-2 align-middle px-3">
                <div class="overflow-hidden shadow ring-1 ring-black/5 rounded-lg">
                    @if ($customer->orders->isEmpty())
                        <div class="p-4 text-center">
                            <p class="text-sm text-gray-500">No hay pedidos realizados por este cliente.</p>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr class="text-center">
                                    <th scope="col"
                                        class="py-3.5 px-3 text-sm 
                                    font-semibold text-gray-900">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 px-3 text-sm 
                                    font-semibold text-gray-900">
                                        Estado
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 px-3 text-sm 
                                    font-semibold text-gray-900">
                                        Entrega
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-sm 
                                    font-semibold text-gray-900 whitespace-nowrap">
                                        Total
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-sm 
                                    font-semibold text-gray-900">
                                        Fecha
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($customer->orders as $order)
                                    <tr wire:key='order-{{ $order->id }}'
                                        class="hover:bg-gray-50 cursor-pointer text-center"
                                        @click="location.href='{{ $order->detailPage() }}'">
                                        <td class="whitespace-nowrap py-2 px-3 text-sm font-semibold text-gray-900">
                                            {{ $order->id }}
                                        </td>
                                        <td class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900">
                                            <x-badge :color="$order->status->color()"
                                                x-tooltip.raw.placement.top="{{ $order->status->helper() }}">
                                                {{ $order->status->name() }}
                                            </x-badge>
                                        </td>
                                        <td class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900">
                                            @if ($order->delivery_type === DeliveryType::Shipping)
                                                @if (!$order->shipping)
                                                    <x-badge color="yellow">Envío sin calcular</x-badge>
                                                @else
                                                    @if (
                                                        $order->shipping->logistic_type === LogisticType::OriginToDoor ||
                                                            $order->shipping->logistic_type === LogisticType::DropoffToDoor)
                                                        Envío a domicilio
                                                    @else
                                                        Envío a sucursal
                                                    @endif
                                                @endif
                                            @endif

                                            @if ($order->delivery_type === DeliveryType::Picking)
                                                Retíro en local
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900">
                                            <div class="flex items-center justify-center gap-x-2">
                                                ${{ priceFormat($order->total) }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900">
                                            {{ getElapsedTime($order->created_at) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>