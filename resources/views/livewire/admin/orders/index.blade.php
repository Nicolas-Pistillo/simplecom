<div>
    @if ($orders->isEmpty())
        <div class="text-center mt-6">

            <img src="{{ URL::to('img/illustrations/logistics.svg') }}" class="h-64 mx-auto mb-4" alt="no-data-img">

            <div class="mb-4">
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Aún no recibiste pedidos</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Veras todos tus pedidos en esta sección una vez que ingresen
                </p>
            </div>
        </div>
    @else
        <section class="pb-3">
            <div class="mx-auto max-w-screen-2xl">
                <div class="relative shadow-md rounded-lg">
                    <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                        <div class="flex items-center flex-1 space-x-4 text-sm">
                            <h5>
                                <span class="text-gray-600">Pedidos hoy:</span>
                                <span class="font-semibold">9</span>
                            </h5>
                            <h5>
                                <span class="text-gray-600">Vendido hoy:</span>
                                <span class="font-semibold">${{ priceFormat(1387799.69) }}</span>
                            </h5>
                        </div>
                        <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">

                            <x-button class="flex items-center font-thin">
                                Cargar Pedido
                                <x-icon code="add" class="ml-1 text-gray-100" />
                            </x-button>

                            <x-button class="flex items-center font-thin" type="secondary">
                                Sincronizar
                                <x-icon code="sync" class="ml-1 text-gray-700" />
                            </x-button>

                            <x-button class="flex items-center font-thin" type="secondary">
                                Exportar
                                <x-icon code="file_upload" class="ml-1 text-gray-700" />
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

                                        <td class="w-4 px-4 py-3" onclick="event.stopPropagation()">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>

                                        <td class="font-semibold text-gray-900">
                                            <a onclick="event.stopPropagation()" target="_blank"
                                            x-tooltip.raw.placement.top="Ver detalle completo"
                                            class="transition duration-200 hover:text-blue-600" 
                                            href="{{ route('admin.orders.show', $order) }}">{{ $order->reference }}</a>
                                        </td>

                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <x-badge :color="$order->status->display_color"
                                            x-tooltip.raw.placement.top="{{ $order->status->helper }}" 
                                            onclick="event.stopPropagation()">
                                                {{ $order->status->name }}
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
                                                Retíro en local                                            
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

                    @if ($orders->count() >= 10)
                        <nav class="p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
                            {{ $orders->links() }}
                        </nav>
                    @endif
                </div>
            </div>
        </section>
    @endif
</div>
