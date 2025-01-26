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

                    <div class="flex items-end justify-between flex-wrap gap-x-4 space-y-4 md:space-y-0 px-4 py-3 bg-white">
                        <div class="relative w-full sm:w-96">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                                </svg>
                            </div>
                            <input type="text" class="block w-full pt-2 ps-10 text-sm text-gray-900 
                            border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 
                            focus:border-blue-500" placeholder="Buscar pedido...">
                        </div>
                        <div class="flex items-center gap-3">

                            <x-icon code="sell" 
                            x-tooltip.raw.placement.top="Imprimir etiquetas" class="transition colors 
                            cursor-pointer bg-gray-100 text-gray-500 p-1.5 rounded-full 
                            hover:bg-gray-200 no-select focus:outline-none focus:ring duration-300" />

                            <x-icon code="barcode" 
                            x-tooltip.raw.placement.top="Código de barras" class="transition colors 
                            cursor-pointer bg-gray-100 text-gray-500 p-1.5 rounded-full 
                            hover:bg-gray-200 no-select focus:outline-none focus:ring duration-300" />

                            <x-icon code="sync" 
                            x-tooltip.raw.placement.top="Actualizar" class="transition colors 
                            cursor-pointer bg-gray-100 text-gray-500 p-1.5 rounded-full 
                            hover:bg-gray-200 no-select focus:outline-none focus:ring duration-300" />

                            <x-icon code="upload" 
                            x-tooltip.raw.placement.top="Exportar" class="transition colors 
                            cursor-pointer bg-gray-100 text-gray-500 p-1.5 rounded-full 
                            hover:bg-gray-200 no-select focus:outline-none focus:ring duration-300" />
                        </div>
                    </div>
                    
                    
                    {{-- <div class="flex flex-wrap gap-3 px-4 py-3">

                        <h5 class="mr-4 font-semibold text-gray-800 text-sm">Entrega</h5>

                        <div class="flex items-center me-4">
                            <input id="inline-radio" type="radio" value="" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-radio" class="ms-2 text-sm font-medium text-gray-900">Retíro en local</label>
                        </div>

                        <div class="flex items-center me-4">
                            <input id="inline-2-radio" type="radio" value="" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-2-radio" class="ms-2 text-sm font-medium text-gray-900">Envío</label>
                        </div>

                        <div class="flex items-center me-4">
                            <input checked id="inline-checked-radio" type="radio" value="" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-checked-radio" class="ms-2 text-sm font-medium text-gray-900">Ambas</label>
                        </div>
                    </div> --}}

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
                                    <th scope="col" class="px-4 py-3">ID</th>
                                    <th scope="col" class="px-4 py-3">Código</th>
                                    <th scope="col" class="px-4 py-3">Estado</th>
                                    <th scope="col" class="px-4 py-3">Cliente</th>
                                    <th scope="col" class="px-4 py-3">Entrega</th>
                                    <th scope="col" class="px-4 py-3">Total</th>
                                    <th scope="col" class="px-4 py-3">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr wire:key='{{ $order->id }}' 
                                    class="border-b text-center transition cursor-pointer 
                                    duration-200 hover:bg-gray-50 text-xs"
                                    @click="location.href='{{ $order->detailPage() }}'">

                                        <td class="w-4 px-4 py-3" onclick="event.stopPropagation()">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>

                                        <td class="font-semibold text-gray-900">
                                            {{ $order->id }}
                                        </td>

                                        <td class="font-semibold text-gray-900">
                                            {{ $order->code }}
                                        </td>

                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <x-badge :color="$order->status->display_color"
                                            x-tooltip.raw.placement.top="{{ $order->status->helper }}">
                                                {{ $order->status->name }}
                                            </x-badge>
                                        </td>

                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
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
                                            <div class="flex items-center justify-center gap-x-2">

                                                ${{ priceFormat($order->total) }}

                                                <img src="{{ Storage::url("providers/{$order->paymentMethod->code}.png") }}" 
                                                x-tooltip.raw.placement.top="{{ $order->paymentMethod->display_name }}"
                                                class="h-8 w-8 object-cover rounded-full"
                                                alt="{{ $order->paymentMethod->display_name }}">
                                            </div>
                                        </td>

                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $order->created_at->format('d/m/Y H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($orders->total() > 10)
                        <nav class="p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
                            {{ $orders->onEachSide(0)->links() }}
                        </nav>
                    @endif
                </div>
            </div>
        </section>
    @endif
</div>
