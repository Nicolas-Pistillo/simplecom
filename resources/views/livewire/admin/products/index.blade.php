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

                                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
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

                                <div wire:loading.remove wire:target='download' 
                                x-data="{ open: false }" class="relative">

                                    <x-icon code="download" x-tooltip.raw.placement.top="Descargar"
                                    @click="open = !open" wire:click='download'
                                    class="transition colors cursor-pointer bg-gray-100 
                                    text-gray-500 p-1.5 rounded-full hover:bg-gray-200 
                                    no-select focus:outline-none focus:ring duration-300" />

                                    {{-- <div x-show="open" x-cloak @click.away="open = false"
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

                                                <li wire:click='download' class="flex justify-between gap-x-2 items-center px-3 py-1 text-sm leading-6 text-gray-900 
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

                        @if (count($selectedProducts) || $hasFilters)

                            <div class="flex items-center justify-between flex-wrap 
                            gap-3 border-b border-gray-200 px-4 py-3">

                                @if (count($selectedProducts))
                                    <div class="flex items-center gap-3">

                                        <h5 class="font-semibold text-gray-800 text-sm">
                                            {{ count($selectedProducts) }}
                                            {{ count($selectedProducts) === 1 ? 'seleccionado' : 'seleccionados' }}
                                        </h5>

                                        <x-dropdown position="right-0 sm:left-0">
                                            <x-slot name="trigger">
                                                <x-button size="tiny" type="secondary" class="flex items-center">
                                                    Acciones
                                                    <x-icon code="arrow_drop_down" />
                                                </x-button>
                                            </x-slot>

                                            <x-dropdown-item wire:click='download(true)' icon="download" label="Descargar" />

                                            <x-dropdown-item icon="delete" label="Eliminar" />

                                        </x-dropdown>
                                    </div>
                                @endif

                                <div class="flex items-center flex-wrap gap-3">

                                    @if (!empty($filters->category_id))
                                        <x-badge color="blue" class="flex items-center gap-1"
                                        wire:click="removeFilter('category_id')">
                                            Categoría: {{ App\Models\Category::find($filters->category_id)->name }} 
                                            <x-icon code="close" x-tooltip.raw="Quitar filtro"
                                            class="text-[14px] cursor-pointer hover:text-red-500" />
                                        </x-badge>
                                    @endif

                                    @if (!empty($filters->brand_id))
                                        <x-badge color="orange" class="flex items-center gap-1"
                                        wire:click="removeFilter('brand_id')">
                                            Marca: {{ App\Models\Brand::find($filters->brand_id)->name }} 
                                            <x-icon code="close" x-tooltip.raw="Quitar filtro"
                                            class="text-[14px] cursor-pointer hover:text-red-500" />
                                        </x-badge>
                                    @endif

                                    @if (!empty($filters->only_published))
                                        <x-badge color="indigo" class="flex items-center gap-1"
                                        wire:click="removeFilter('only_published')">
                                            Solo publicados
                                            <x-icon code="close" x-tooltip.raw="Quitar filtro"
                                            class="text-[14px] cursor-pointer hover:text-red-500" />
                                        </x-badge>
                                    @endif

                                    @if (!empty($filters->only_featured))
                                        <x-badge color="yellow" class="flex items-center gap-1"
                                        wire:click="removeFilter('only_featured')">
                                            Solo destacados
                                            <x-icon code="close" x-tooltip.raw="Quitar filtro"
                                            class="text-[14px] cursor-pointer hover:text-red-500" />
                                        </x-badge>
                                    @endif

                                </div>
                            </div>
                        @endif

                        @if ($products->isEmpty())
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
                                    <tbody wire:poll.7s>
                                        @foreach ($products as $product)
                                            @include('admin.products.partials.index.product-list-item')
                                        @endforeach
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
                        @endif
                    </div>
                </div>
            </section>
        </div>
    @endif
</div>
