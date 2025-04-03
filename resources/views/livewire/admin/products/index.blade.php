<div>

    @if (!$hasProducts)
        <div class="text-center pt-8">

            <img src="{{ URL::to('img/illustrations/data_processing.svg') }}" class="h-64 mx-auto mb-4" alt="no-data-img">

            <div class="mb-4">
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Aún no cargaste productos</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Recordá crear primero tus
                    <a href="{{ route('admin.categories.index') }}"
                        class="text-blue-500 hover:underline hover:text-blue-600">categorías</a>
                    antes de crear tu primer producto
                </p>
            </div>
        </div>
    @else
        <div x-data="{showBulkDeleteConfirm: false}" 
        x-on:close-bulk-delete-dialog.window="showBulkDeleteConfirm = false">
            <section>

                <div class="mx-auto max-w-screen-2xl">
                    <div class="relative shadow-md rounded-lg">

                        <div class="flex items-end justify-between flex-wrap gap-4 px-4 py-3 
                        bg-white rounded-t-lg border border-gray-100">

                            <div class="relative w-full order-2 sm:order-1 sm:w-72">

                                <div
                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <x-icon code="search" class="text-gray-500" />
                                </div>

                                <input type="search" wire:model.live='search'
                                    class="block w-full pt-2 ps-10 text-sm text-gray-900 
                                border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 
                              focus:border-blue-500"
                                    placeholder="Buscar productos...">
                            </div>

                            <div class="flex items-center order-1 sm:order-2 gap-3">

                                <div x-data="{ open: false }" class="relative">

                                    <x-icon code="tune" x-tooltip.raw.placement.top="Filtrar" @click="open = !open"
                                        class="transition colors cursor-pointer bg-gray-100 text-gray-500 
                                        p-1.5 rounded-full hover:bg-gray-200 no-select focus:outline-none 
                                        focus:ring duration-300" />

                                    @include('admin.products.partials.index.filters')

                                </div>

                                <div x-data="{ open: false }" class="relative">

                                    <x-icon code="download" x-tooltip.raw.placement.top="Descargar"
                                        @click="open = !open"
                                        class="transition colors 
                                        cursor-pointer bg-gray-100 text-gray-500 p-1.5 rounded-full 
                                        hover:bg-gray-200 no-select focus:outline-none focus:ring duration-300" />

                                    <div x-show="open" x-cloak @click.away="open = false"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="transform opacity-0 scale-90"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-100"
                                        x-transition:leave-start="transform opacity-100 scale-200"
                                        x-transition:leave-end="transform opacity-0 scale-90"
                                        class="absolute top-12 right-0 w-max bg-white 
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
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto" scrollbar-thin>
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-all" type="checkbox"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                                <label for="checkbox-all" class="sr-only">checkbox</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-4 py-3">Producto</th>
                                        <th scope="col" class="px-4 py-3">Categoría</th>
                                        <th scope="col" class="px-4 py-3">Stock</th>
                                        <th scope="col" class="px-4 py-3">Precio</th>
                                        <th scope="col" class="px-4 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody wire:poll>
                                    @forelse ($products as $product)
                                        @include('admin.products.partials.index.product-list-item')
                                    @empty
                                        <tr class="border-b text-xs text-center transition-colors duration-300
                                        hover:bg-gray-50">
                                            <td></td>
                                            <td
                                                class="px-4 py-2 font-semibold 
                                            text-gray-900 whitespace-nowrap">
                                                Sin resultados
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($products->total() > 10)
                            <nav class="p-4 space-y-3 md:flex-row md:items-center md:space-y-0"
                                aria-label="Table navigation">
                                {{ $products->onEachSide(0)->links() }}
                            </nav>
                        @endif

                        @livewire('admin.products.quick-update')

                    </div>
                </div>
            </section>
        </div>
    @endif

</div>
