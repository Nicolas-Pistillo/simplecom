<div>
    @if (!$has_orders)
        <div class="text-center mt-10 sm:mt-24 flex flex-col justify-center">

            <img src="{{ URL::to('img/illustrations/web_shopping.svg') }}" class="h-64 mx-auto mb-4" alt="no-data-img">

            <div class="mb-4">
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Aún no recibiste pedidos</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Verás todos tus pedidos en esta sección una vez que comiencen a llegar
                </p>
            </div>
        </div>
    @else
        <section class="pb-3">
            <div class="mx-auto max-w-screen-2xl">
                <div class="relative shadow-md rounded-lg">

                    <div class="flex items-end justify-between flex-wrap gap-4 px-4 py-3 
                    bg-white rounded-t-lg border border-gray-100">

                        <div class="relative w-full order-2 sm:order-1 sm:w-72">

                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <x-icon code="search" class="text-gray-500" />
                            </div>

                            <input type="search" wire:model.live='search'
                            class="block w-full pt-2 ps-10 text-sm text-gray-900 
                            border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 
                            focus:border-blue-500"
                            placeholder="Buscar pedido...">
                        </div>

                        <div class="flex items-center order-1 sm:order-2 gap-3">

                            <div x-data="{ open: false }" class="relative">

                                <x-icon code="tune" x-tooltip.raw.placement.top="Filtrar" @click="open = !open"
                                class="transition colors cursor-pointer bg-gray-100 text-gray-500 
                                p-1.5 rounded-full hover:bg-gray-200 no-select focus:outline-none 
                                focus:ring duration-300" />

                                @include('admin.orders.partials.index.filters')

                            </div>

                            <div wire:loading.remove wire:target='download' x-data="{ open: false }" class="relative">

                                <x-icon code="download" x-tooltip.raw.placement.top="Descargar" 
                                @click="open = !open" wire:click='download'
                                class="transition colors 
                                cursor-pointer bg-gray-100 text-gray-500 p-1.5 rounded-full 
                                hover:bg-gray-200 no-select focus:outline-none focus:ring duration-300" />

                                {{-- <div x-show="open" x-cloak
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-90"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="transform opacity-100 scale-200"
                                    x-transition:leave-end="transform opacity-0 scale-90"
                                    class="absolute top-12 left-0 sm:right-0 sm:left-[unset] w-max bg-white 
                                    ring-1 shadow-xl shadow-black/5 ring-slate-700/10 
                                    rounded-md overflow-hidden">

                                    <div class="text-[0.8125rem]/6 text-slate-900">

                                        <ul class="flex flex-col border-slate-400/20 rounded-md">

                                            <li class="flex justify-between items-center px-3 py-1 text-sm leading-6 text-gray-900 
                                            transition hover:bg-gray-50 cursor-pointer">
                                                Descargar en PDF
                                                <x-icon code="description" class="text-red-700" />
                                            </li>

                                            <li class="flex justify-between gap-x-2 items-center px-3 py-1 text-sm leading-6 text-gray-900 
                                            transition hover:bg-gray-50 cursor-pointer">
                                                Descargar en Excel
                                                <x-icon code="description" class="text-green-700" />
                                            </li>

                                            <li class="flex justify-between items-center px-3 py-1 text-sm leading-6 text-gray-900 
                                            transition hover:bg-gray-50 cursor-pointer">
                                                Descargar en CSV
                                                <x-icon code="description" class="text-blue-700" />
                                            </li>

                                        </ul>
                                    </div>
                                </div> --}}
                            </div>

                            <div wire:loading wire:target='download'>
                                <x-spinner class="p-1.5" />
                            </div>
                        </div>
                    </div>

                    @if (count($selected_orders) || $hasFilters)

                        <div class="flex items-center justify-between flex-wrap 
                        gap-3 border-b border-gray-200 px-4 py-3">

                            @if (count($selected_orders))
                                <div class="flex items-center gap-3">

                                    <h5 class="font-semibold text-gray-800 text-sm">
                                        {{ count($selected_orders) }}
                                        {{ count($selected_orders) === 1 ? 'seleccionado' : 'seleccionados' }}
                                    </h5>

                                    <x-dropdown position="right-0 sm:left-0">
                                        <x-slot name="trigger">
                                            <x-button size="tiny" type="secondary" class="flex items-center">
                                                Acciones
                                                <x-icon code="arrow_drop_down" />
                                            </x-button>
                                        </x-slot>

                                        <x-dropdown-item :href="route('admin.pdf.order-labels', ['orders' => $selected_orders])" 
                                        blank icon="print" label="Imprimir etiquetas internas" />

                                        <x-dropdown-item wire:click='download(true)' icon="download" label="Descargar" />

                                    </x-dropdown>
                                </div>
                            @endif

                            <div class="flex items-center flex-wrap gap-3">

                                @if (!empty($filters->status))
                                    <x-badge color="blue" class="flex items-center gap-1"
                                    wire:click="removeFilter('status')">
                                        Estado: {{ OrderStatus::tryFrom($filters->status)->name() }} 
                                        <x-icon code="close" x-tooltip.raw="Quitar filtro"
                                        class="text-[14px] cursor-pointer hover:text-red-500" />
                                    </x-badge>
                                @endif

                                @if (!empty($filters->delivery_type))
                                    <x-badge color="violet" class="flex items-center gap-1"
                                    wire:click="removeFilter('delivery_type')">
                                        Solo {{ DeliveryType::tryFrom($filters->delivery_type)->name() }} 
                                        <x-icon code="close" x-tooltip.raw="Quitar filtro"
                                        class="text-[14px] cursor-pointer hover:text-red-500" />
                                    </x-badge>
                                @endif

                                @if (!empty($filters->only_invoiced))
                                    <x-badge color="emerald" class="flex items-center gap-1"
                                    wire:click="removeFilter('only_invoiced')">
                                        Solo facturados
                                        <x-icon code="close" x-tooltip.raw="Quitar filtro"
                                        class="text-[14px] cursor-pointer hover:text-red-500" />
                                    </x-badge>
                                @endif

                            </div>
                        </div>
                    @endif

                    @if ($orders->isEmpty())

                        <div class="text-center py-8">

                            <img src="{{ URL::to('img/illustrations/cancel.svg') }}" 
                            class="h-52 mx-auto mb-4" alt="no-data-img">

                            <div class="mb-4">
                                <h3 class="mt-2 text-sm font-semibold text-gray-900">
                                    No se encontraron resultados
                                </h3>
                                <p class="mt-1 mb-4 text-sm text-gray-500">
                                    Revisa tu búsqueda o los filtros aplicados
                                </p>
                                
                                <x-button wire:click='clearFilters' type="secondary">
                                    Limpiar filtros
                                </x-button>
                            </div>
                        </div>
                    @else
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
                                        <th scope="col" class="px-4 py-3">Estado</th>
                                        <th scope="col" class="px-4 py-3">Cliente</th>
                                        <th scope="col" class="px-4 py-3">Entrega</th>
                                        <th scope="col" class="px-4 py-3">Total</th>
                                        <th scope="col" class="px-4 py-3">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody wire:poll.7s>
                                    @foreach ($orders as $order)
                                        <tr wire:key='{{ $order->id }}'
                                        class="border-b text-center transition cursor-pointer 
                                        duration-200 text-xs border-l-2
                                        {{ in_array($order->id, $selected_orders)
                                            ? 'border-l-blue-700 bg-blue-50'
                                            : 'hover:bg-gray-50 border-l-transparent' }}"
                                            @click="location.href='{{ $order->detailPage() }}'">

                                            <td class="w-4 px-4 py-3" onclick="event.stopPropagation()">
                                                <div class="flex items-center">
                                                    <input type="checkbox"
                                                        wire:change='toggleSelectedOrder({{ $order->id }})'
                                                        @if (in_array($order->id, $selected_orders)) checked @endif
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                                    <label for="checkbox-table-search-1"
                                                        class="sr-only">checkbox</label>
                                                </div>
                                            </td>

                                            <td class="font-semibold text-gray-900">
                                                {{ $order->id }}
                                            </td>

                                            <td class="px-4 py-2 whitespace-nowrap">
                                                <x-badge :color="$order->status->color()"
                                                    x-tooltip.raw.placement.top="{{ $order->status->helper() }}">
                                                    {{ $order->status->name() }}
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
                                                {{ getElapsedTime($order->created_at) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($orders->total() > 10)
                            <nav class="p-4 space-y-3 md:flex-row md:items-center md:space-y-0"
                                aria-label="Table navigation">
                                {{ $orders->onEachSide(0)->links() }}
                            </nav>
                        @endif
                    @endif
                </div>
            </div>
        </section>
    @endif
</div>
