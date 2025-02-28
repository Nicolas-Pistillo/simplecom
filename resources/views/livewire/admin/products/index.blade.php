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

                                    <div x-show="open" x-cloak @click.away="open = false"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="transform opacity-0 scale-90"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-100"
                                        x-transition:leave-start="transform opacity-100 scale-200"
                                        x-transition:leave-end="transform opacity-0 scale-90"
                                        class="absolute top-12 z-20 right-0 w-[30.25rem] rounded-md bg-white 
                                        p-4 ring-1 shadow-xl shadow-black/5 ring-slate-700/10">
                                        <h6 class="font-semibold text-sm text-slate-900">Filtros</h6>

                                        <div class="mt-4 text-[0.8125rem]/6 text-slate-900">
                                            <div class="flex items-center border-t border-slate-400/20 py-3">
                                                <span class="w-2/5 flex-none">Language</span><span
                                                    class="">English</span>
                                                <span
                                                    class="pointer-events-auto ml-auto font-medium text-indigo-600 
                                            hover:text-indigo-500">Update</span>
                                            </div>
                                            <div class="flex items-center border-t border-slate-400/20 py-3">
                                                <span class="w-2/5 flex-none">Date format</span>
                                                <span class="">DD-MM-YYYY</span>
                                                <span class="ml-auto flex items-center font-medium text-indigo-600">
                                                    <span
                                                        class="pointer-events-auto hover:text-indigo-500">Update</span>
                                                    <span class="mx-3 h-6 w-px bg-slate-400/20"></span>
                                                    <span
                                                        class="pointer-events-auto hover:text-indigo-500">Remove</span>
                                                </span>
                                            </div>
                                            <div class="flex items-center border-t border-slate-400/20 py-3">
                                                <span>Automatic timezone</span>
                                                <span class="ml-auto flex items-center">
                                                    <x-switch />
                                                </span>
                                            </div>
                                            <div class="flex items-center border-t border-slate-400/20 pt-3">
                                                <span>Auto-update applicant data</span>
                                                <span class="ml-auto flex items-center">
                                                    <x-switch />
                                                </span>
                                            </div>
                                        </div>
                                    </div>

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

                                                <li
                                                    class="flex justify-between items-center px-3 py-1 text-sm leading-6 text-gray-900 
                                        transition hover:bg-gray-50 cursor-pointer">
                                                    Descargar en PDF
                                                    <x-icon code="description" class="text-red-700" />
                                                </li>

                                                <li
                                                    class="flex justify-between gap-x-2 items-center px-3 py-1 text-sm leading-6 text-gray-900 
                                        transition hover:bg-gray-50 cursor-pointer">
                                                    Descargar en Excel
                                                    <x-icon code="description" class="text-green-700" />
                                                </li>

                                                <li
                                                    class="flex justify-between items-center px-3 py-1 text-sm leading-6 text-gray-900 
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
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr wire:key='{{ $product->id }}'
                                        wire:click='quickUpdate({{ $product->id }})'
                                        class="border-b text-xs text-center transition-colors 
                                        cursor-pointer duration-300 hover:bg-gray-50">

                                            <td class="w-4 px-4 py-3" onclick="event.stopPropagation()">
                                                <div class="flex items-center">
                                                    <input id="checkbox-table-search-1" type="checkbox"
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                                </div>
                                            </td>

                                            <th class="flex items-center pl-4 pr-8 py-2 font-medium text-gray-900">

                                                <img src="{{ $product->first_image }}" alt="{{ $product->name }}"
                                                    class="w-8 h-8 mr-3 rounded-lg">

                                                <div class="flex flex-col items-start">
                                                    <span class="max-w-[220px] truncate font-semibold"
                                                        x-tooltip.raw.placement.top="{{ $product->name }}">
                                                        {{ $product->name }}
                                                    </span>

                                                    <div class="text-gray-600 font-semibold">
                                                        <small style="font-size: 11px">ID {{ $product->id }}</small>

                                                        @if (!empty($product->code))
                                                            <small style="font-size: 11px">- Código
                                                                {{ $product->code }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </th>

                                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $product->category->name }}
                                            </td>

                                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $product->stock }}
                                            </td>

                                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                <div class="flex justify-center gap-x-1">

                                                    <span>${{ priceFormat($product->current_price) }}</span>

                                                    @if ($product->hasDiscount())
                                                        <small class="text-green-700 font-semibold"
                                                            style="font-size: 11px">
                                                            %{{ $product->discount_percent }} OFF
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="px-4 py-2 whitespace-nowrap mx-auto"
                                            onclick="event.stopPropagation()">
                                                <span class="inline-flex overflow-hidden shadow-sm">

                                                    <span class="flex h-7 mx-auto rounded-md shadow-sm">

                                                        <x-button type="secondary"
                                                            wire:click='togglePublishedProduct({{ $product->id }})'
                                                            x-tooltip.raw.placement.top="{{ $product->published ? 'Despublicar' : 'Publicar' }}"
                                                            class="text-xs rounded-r-none flex items-center
                                                            {{ $product->published ? '!bg-blue-100 !text-blue-500' : '' }}">

                                                            <x-icon wire:loading.remove
                                                                wire:target='togglePublishedProduct({{ $product->id }})'
                                                                code="{{ $product->published ? 'visibility' : 'visibility_off' }}"
                                                                style="font-size: 16px" />

                                                            <x-spinner wire:loading
                                                                wire:target='togglePublishedProduct({{ $product->id }})'
                                                                spinnerclass="!h-4 !w-4" />

                                                        </x-button>

                                                        <x-button type="secondary"
                                                            wire:click='toggleFeaturedProduct({{ $product->id }})'
                                                            x-tooltip.raw.placement.top="{{ $product->featured ? 'No destacar' : 'Destacar' }}"
                                                            class="rounded-none flex items-center
                                                            {{ $product->featured ? '!bg-yellow-100 !text-yellow-500' : '' }}">

                                                            <x-icon wire:loading.remove
                                                                wire:target='toggleFeaturedProduct({{ $product->id }})'
                                                                code="star" style="font-size: 16px" />

                                                            <x-spinner wire:loading
                                                                wire:target='toggleFeaturedProduct({{ $product->id }})'
                                                                spinnerclass="!h-4 !w-4" />

                                                        </x-button>

                                                        <x-button :href="route('admin.products.edit', $product->id)" type="secondary"
                                                            class="flex items-center rounded-none"
                                                            x-tooltip.raw.placement.top="Editar">
                                                            <x-icon code="edit" style="font-size: 16px" />
                                                        </x-button>

                                                        <x-button :href="$product->detailPageUrl()" blank type="secondary"
                                                            class="flex items-center rounded-l-none"
                                                            x-tooltip.raw.placement.top="Ver producto en la tienda">
                                                            <x-icon code="storefront" style="font-size: 16px" />
                                                        </x-button>

                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr
                                            class="border-b text-xs text-center transition-colors duration-300
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
