<div>
    @if (!$has_customers)
        <div class="text-center mt-10 sm:mt-24 flex flex-col justify-center">

            <img src="{{ URL::to('img/illustrations/select_box.svg') }}" class="h-64 mx-auto mb-4" alt="no-data-img">

            <div class="mb-4">
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Aún no recibiste clientes</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Veras la información de tus clientes una vez que se registren o realicen pedidos en tu comercio.
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
                            placeholder="Buscar cliente...">
                        </div>

                        <div class="flex items-center order-1 sm:order-2 gap-3">

                            <div x-data="{ open: false }" class="relative">

                                <x-icon code="tune" x-tooltip.raw.placement.top="Filtrar" @click="open = !open"
                                class="transition colors cursor-pointer bg-gray-100 text-gray-500 
                                p-1.5 rounded-full hover:bg-gray-200 no-select focus:outline-none 
                                focus:ring duration-300" />

                                <div x-show="open" x-cloak @click.away="open = false" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-90" 
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-100" 
                                x-transition:leave-start="transform opacity-100 scale-200"
                                x-transition:leave-end="transform opacity-0 scale-90"
                                class="absolute top-12 z-20 left-0 sm:right-0 sm:left-[unset] rounded-md 
                                bg-white p-4 ring-1 shadow-xl shadow-black/5 ring-slate-700/10
                                w-[280px] sm:w-[480px]">

                                <div class="flex items-center justify-between">
                                    <h6 class="font-semibold text-sm text-slate-900">Filtros</h6>
                                    <div wire:loading wire:target='filters'>
                                        <x-spinner spinnerclass="!w-5 !h-5" />
                                    </div>
                                </div>

                                <div class="mt-4 text-[0.8125rem]/6 text-slate-900">

                                    <div class="flex items-center border-t border-slate-400/20 py-3">
                                        <span>Solo invitados</span>
                                        <span class="ml-auto flex items-center">
                                            <x-switch wireModel="filters.only_guest" />
                                        </span>
                                    </div>

                                    <div class="flex items-center border-t border-slate-400/20 py-3">
                                        <span>Solo registrados</span>
                                        <span class="ml-auto flex items-center">
                                            <x-switch wireModel="filters.only_registered" />
                                        </span>
                                    </div>
                                </div>
                            </div>

                            </div>

                            <div wire:loading.remove wire:target='download' x-data="{ open: false }" class="relative">
                                <x-icon code="download" x-tooltip.raw.placement.top="Descargar" 
                                @click="open = !open" wire:click='download'
                                class="transition colors 
                                cursor-pointer bg-gray-100 text-gray-500 p-1.5 rounded-full 
                                hover:bg-gray-200 no-select focus:outline-none focus:ring duration-300" />
                            </div>

                            <div wire:loading wire:target='download'>
                                <x-spinner class="p-1.5" />
                            </div>
                        </div>
                    </div>

                    @if ($hasFilters)

                        <div class="flex items-center justify-between flex-wrap 
                        gap-3 border-b border-gray-200 px-4 py-3">

                            <div class="flex items-center flex-wrap gap-3">

                                @if (!empty($filters->only_guest))
                                    <x-badge color="blue" class="flex items-center gap-1"
                                    wire:click="removeFilter('only_guest')">
                                        Solo invitados
                                        <x-icon code="close" x-tooltip.raw="Quitar filtro"
                                        class="text-[14px] cursor-pointer hover:text-red-500" />
                                    </x-badge>
                                @endif

                                @if (!empty($filters->only_registered))
                                    <x-badge color="violet" class="flex items-center gap-1"
                                    wire:click="removeFilter('only_registered')">
                                        Solo registrados
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

                    @if ($customers->isEmpty())

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
                                @if ($hasFilters)
                                    <x-button wire:click='clearFilters' type="secondary">
                                        Limpiar filtros
                                    </x-button>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="overflow-x-auto no-select" scrollbar-thin>
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr class="text-center whitespace-nowrap">
                                        <th scope="col" class="px-4 py-3">ID</th>
                                        <th scope="col" class="px-4 py-3">Tipo</th>
                                        <th scope="col" class="px-4 py-3">Nombre</th>
                                        <th scope="col" class="px-4 py-3">Razón social</th>
                                        <th scope="col" class="px-4 py-3">Cond. Fiscal</th>
                                        <th scope="col" class="px-4 py-3">Email</th>
                                        <th scope="col" class="px-4 py-3">Teléfono</th>
                                    </tr>
                                </thead>
                                <tbody wire:poll.7s>
                                    @foreach ($customers as $customer)
                                        <tr wire:key='{{ $customer->id }}'
                                        class="border-b text-center transition cursor-pointer 
                                        duration-200 text-xs hover:bg-gray-50">

                                            <td class="font-semibold text-gray-900">
                                                {{ $customer->id }}
                                            </td>

                                            <td class="px-4 py-2 whitespace-nowrap">
                                                <x-badge :color="$customer->type->color()">
                                                    {{ $customer->type->name() }}
                                                </x-badge>
                                            </td>

                                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $customer->full_name }}
                                            </td>

                                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $customer->invoice_social_reason ?? '-' }}
                                            </td>

                                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $customer->tax_condition->name() }}
                                            </td>

                                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $customer->email }}
                                            </td>

                                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $customer->phone ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($customers->total() > 10)
                            <nav class="p-4 space-y-3 md:flex-row md:items-center md:space-y-0"
                                aria-label="Table navigation">
                                {{ $customers->onEachSide(0)->links() }}
                            </nav>
                        @endif
                    @endif
                </div>
            </div>
        </section>
    @endif
</div>
