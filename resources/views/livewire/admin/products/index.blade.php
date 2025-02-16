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
        <div x-data="{ showBulkDeleteConfirm: false }" x-on:close-bulk-delete-dialog.window="showBulkDeleteConfirm = false">
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
                                        class="border-b text-xs text-center transition-colors cursor-pointer 
                                        duration-300 hover:bg-gray-50"
                                            @click="alert('Le mando click')">

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

                        {{-- TODO: Product quick edit
                        <x-drawer ref="true" withoutClose panelClass="w-[50rem]">

                            <div class="mb-5">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-base font-semibold">
                                        Edición rápida
                                    </h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <x-icon code="close" class="cursor-pointer" x-tooltip.raw="Cerrar" />
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <p class="text-sm ">
                                        Se generará una nueva factura asociada al pedido
                                    </p>
                                </div>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 ">
                                <div class="space-y-4 sm:col-span-2 sm:space-y-6">
                                    <div>
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="Apple iMac 27“" placeholder="Type product name" required="">
                                    </div>
                                    <div>
                                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                        <div class="w-full border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                            <div class="flex items-center justify-between px-3 py-2 border-b dark:border-gray-600">
                                                <div class="flex flex-wrap items-center divide-gray-200 sm:divide-x dark:divide-gray-600">
                                                    <div class="flex items-center space-x-1 sm:pr-4">
                                                        <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="sr-only">Attach file</span>
                                                        </button>
                                                        <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="sr-only">Embed map</span>
                                                        </button>
                                                        <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="sr-only">Upload image</span>
                                                        </button>
                                                        <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="sr-only">Format code</span>
                                                        </button>
                                                        <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="sr-only">Add emoji</span>
                                                        </button>
                                                    </div>
                                                    <div class="flex-wrap items-center hidden space-x-1 sm:flex sm:pl-4">
                                                        <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="sr-only">Add list</span>
                                                        </button>
                                                        <button type="button" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="sr-only">Settings</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <button type="button" data-tooltip-target="tooltip-fullscreen" class="p-2 text-gray-500 rounded cursor-pointer sm:ml-auto hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h4a1 1 0 010 2H6.414l2.293 2.293a1 1 0 11-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 010-2h4a1 1 0 011 1v4a1 1 0 01-2 0V6.414l-2.293 2.293a1 1 0 11-1.414-1.414L13.586 5H12zm-9 7a1 1 0 012 0v1.586l2.293-2.293a1 1 0 111.414 1.414L6.414 15H8a1 1 0 010 2H4a1 1 0 01-1-1v-4zm13-1a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 010-2h1.586l-2.293-2.293a1 1 0 111.414-1.414L15 13.586V12a1 1 0 011-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Full screen</span>
                                                </button>
                                                <div id="tooltip-fullscreen" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(389px, 238px);" data-popper-reference-hidden="" data-popper-escaped="">
                                                    Show full screen
                                                    <div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(64px, 0px);"></div>
                                                </div>
                                            </div>
                                            <div class="px-4 py-3 bg-white rounded-b-lg dark:bg-gray-800"><textarea id="description" rows="8" class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write product description here" required="">Standard glass, 3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US</textarea></div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Images</span>
                                        <div class="grid grid-cols-3 gap-4 mb-4">
                                            <div class="relative p-2 bg-gray-100 rounded-lg sm:w-36 sm:h-36 dark:bg-gray-700">
                                                <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-side-image.png" alt="imac image">
                                                <button type="button" class="absolute text-red-600 dark:text-red-500 hover:text-red-500 dark:hover:text-red-400 bottom-1 left-1">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Remove image</span>
                                                </button>
                                            </div>
                                            <div class="relative p-2 bg-gray-100 rounded-lg sm:w-36 sm:h-36 dark:bg-gray-700">
                                                <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-front-image.png" alt="imac image">
                                                <button type="button" class="absolute text-red-600 dark:text-red-500 hover:text-red-500 dark:hover:text-red-400 bottom-1 left-1">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Remove image</span>
                                                </button>
                                            </div>
                                            <div class="relative p-2 bg-gray-100 rounded-lg sm:w-36 sm:h-36 dark:bg-gray-700">
                                                <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-back-image.png" alt="imac image">
                                                <button type="button" class="absolute text-red-600 dark:text-red-500 hover:text-red-500 dark:hover:text-red-400 bottom-1 left-1">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Remove image</span>
                                                </button>
                                            </div>
                                            <div class="relative p-2 bg-gray-100 rounded-lg sm:w-36 sm:h-36 dark:bg-gray-700">
                                                <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-side-image.png" alt="imac image">
                                                <button type="button" class="absolute text-red-600 dark:text-red-500 hover:text-red-500 dark:hover:text-red-400 bottom-1 left-1">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Remove image</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-center w-full">
                                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                    </svg>
                                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                                        <span class="font-semibold">Click to upload</span>
                                                        or drag and drop
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                                </div>
                                                <input id="dropzone-file" type="file" class="hidden">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input id="product-options" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="product-options" class="ml-2 text-sm text-gray-500 dark:text-gray-300">Product has multiple options, like different colors or sizes</label>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input datepicker="" id="datepicker" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 datepicker-input" value="15/08/2022" placeholder="Select date">
                                    </div>
                                </div>
                                <div class="space-y-4 sm:space-y-6">
                                    <div>
                                        <label for="product-brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                        <input type="text" id="product-brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="Apple" placeholder="Product Brand" required="">
                                    </div>
                                    <div><label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label><select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"><option selected="">Electronics</option><option value="TV">TV/Monitors</option><option value="PC">PC</option><option value="GA">Gaming/Console</option><option value="PH">Phones</option></select></div>
                                    <div>
                                        <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Weight (kg)</label>
                                        <input type="number" name="item-weight" id="item-weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="12" placeholder="Ex. 12" required="">
                                    </div>
                                    <div>
                                        <label for="length" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Length (cm)</label>
                                        <input type="number" name="length" id="lenght" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="105" placeholder="Ex. 105" required="">
                                    </div>
                                    <div>
                                        <label for="breadth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Breadth (cm)</label>
                                        <input type="number" name="breadth" id="breadth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="15" placeholder="Ex. 15" required="">
                                    </div>
                                    <div>
                                        <label for="width" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Width (cm)</label>
                                        <input type="number" name="width" id="width" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="23" placeholder="Ex. 23" required="">
                                    </div>
                                </div>
                            </div>
                        </x-drawer> --}}

                    </div>
                </div>
            </section>
        </div>
    @endif

</div>
