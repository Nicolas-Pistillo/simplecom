<div>
    <section class="pb-3">
        <div class="mx-auto max-w-screen-2xl">
            <div class="relative shadow-md rounded-lg">
                <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                    <div class="flex items-center flex-1 space-x-4">
                        <h5>
                            <span class="text-gray-500">All Products:</span>
                            <span class="">123456</span>
                        </h5>
                        <h5>
                            <span class="text-gray-500">Total sales:</span>
                            <span class="">$88.4k</span>
                        </h5>
                    </div>
                    <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                        <button type="button"
                            class="flex items-center bg-black justify-center px-4 py-2 text-sm font-medium text-white rounded-lg focus:ring-4 focus:outline-none">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Add new product
                        </button>
                        <button type="button"
                            class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-200">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="none"
                                viewbox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            Update stocks 1/250
                        </button>
                        <x-button class="flex items-center font-thin" type="secondary" size="large">
                            Exportar
                            <x-icon code="file_upload" class="ml-1" />
                        </x-button>
                    </div>
                </div>
                <div class="overflow-x-auto no-select" scrollbar-thin>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr class="text-center whitespace-nowrap">
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all" type="checkbox"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3">Referencia</th>
                                <th scope="col" class="px-4 py-3">Estado</th>
                                <th scope="col" class="px-4 py-3">Comprador</th>
                                <th scope="col" class="px-4 py-3">Entrega</th>
                                <th scope="col" class="px-4 py-3">Total</th>
                                <th scope="col" class="px-4 py-3">Medio de Pago</th>
                                <th scope="col" class="px-4 py-3">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr wire:key='{{ $order->id }}' @click="alert('Tocaste aca!')"
                                class="border-b text-center transition cursor-pointer 
                                duration-200 hover:bg-gray-50 text-xs">

                                    <td class="w-4 px-4 py-3">
                                        <div class="flex items-center">
                                            <input id="checkbox-table-search-1" type="checkbox"
                                                onclick="event.stopPropagation()"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                        </div>
                                    </td>

                                    <td class="font-semibold text-gray-900">
                                        <a onclick="event.stopPropagation()" target="_blank" 
                                        href="https://google.com">{{ $order->reference }}</a>
                                    </td>

                                    <td class="px-4 py-2 whitespace-nowrap">
                                        <x-badge>
                                            {{ $order->status }}
                                        </x-badge>
                                    </td>

                                    <td class="px-4 py-2 font-medium text-xs text-gray-900 whitespace-nowrap">
                                        {{ $order->user->full_name }}
                                    </td>

                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        @if ($order->delivery_type === DeliveryType::Shipping)
                                            @if (!$order->shipping)
                                                <x-badge color="yellow">Envío sin calcular</x-badge>
                                            @else
                                                @if ($order->shipping->logistic_type === LogisticType::OriginToDoor || 
                                                    $order->shipping->logistic_type === LogisticType::DropoffToDoor)
                                                    Envío a domicilio
                                                @else
                                                    Envío a sucursal
                                                @endif
                                            @endif
                                        @endif

                                        @if ($order->delivery_type === DeliveryType::Picking)
                                            Retíro en sucursal                                            
                                        @endif
                                    </td>

                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        ${{ priceFormat($order->total) }}
                                    </td>

                                    <td class="px-4 py-2 font-medium text-gray-900 text-center whitespace-nowrap">
                                        <img src="{{ Storage::url("providers/{$order->paymentMethod->code}.png") }}" 
                                        x-tooltip.raw.placement.top="{{ $order->paymentMethod->display_name }}"
                                        class="h-8 w-8 object-cover rounded-md mx-auto"
                                        alt="{{ $order->paymentMethod->display_name }}">
                                    </td>

                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $order->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
                    {{ $orders->links() }}
                </nav>
            </div>
        </div>
    </section>
</div>
