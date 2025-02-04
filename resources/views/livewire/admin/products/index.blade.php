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
        <div x-data="{ showBulkDeleteConfirm: false }" 
        x-on:close-bulk-delete-dialog.window="showBulkDeleteConfirm = false">

            {{-- <div class="flex justify-between items-end mt-8 mb-6">

                <div class="flex items-end w-full">

                    <x-input type="search" value="{{ $search }}" wire:model.live='search'
                        class="flex-shrink border-none w-56 p-0 mr-4">
                        <x-slot name="label">
                            <div class="flex items-center">
                                <x-icon code="search" class="mr-2 text-gray-400" /> Buscar productos...
                            </div>
                        </x-slot>
                    </x-input>

                    @if (!empty($selectedProducts))
                        <x-dropdown wire:loading.remove wire:target='bulkAction, downloadSelecteds'>

                            <x-slot name="title">
                                {{ count($selectedProducts) }}
                                {{ count($selectedProducts) == 1 ? 'seleccionado' : 'seleccionados' }}
                            </x-slot>

                            <x-dropdown-item wire:click="bulkAction('publish')" @click="open = false"
                                label="Publicar" icon="visibility" />

                            <x-dropdown-item wire:click="bulkAction('unpublish')" @click="open = false"
                                label="Despublicar" icon="visibility_off" />

                            <x-dropdown-item wire:click="bulkAction('highlight')" @click="open = false"
                                label="Destacar" icon="star" />

                            <x-dropdown-item wire:click="bulkAction('unhighlight')" @click="open = false"
                                label="Remover de destacados" icon="remove_circle_outline" />

                            <x-dropdown-item wire:click="download(true)" @click="open = false"
                                label="Descargar seleccionados" icon="file_download" />

                            <x-dropdown-item @click="showBulkDeleteConfirm = true; open = false"
                                label="Eliminar" icon="delete" iconClass="text-red-400" />

                        </x-dropdown>

                        <x-spinner wire:loading wire:target='bulkAction' />
                    @endif
                </div>

                @if ($products->isNotEmpty())
                    <div class="flex justify-center z-10">
                        <span class="isolate inline-flex -space-x-px rounded-md shadow-sm">

                            <x-dropdown position="right">

                                <x-slot name="trigger">
                                    <x-button x-tooltip.raw.placement.top="Filtros" type="secondary"
                                    class="!text-gray-400 rounded-r-none flex items-center">
                                        <x-icon code="tune" />
                                    </x-button>
                                </x-slot>

                                <x-dropdown-item label="Algo aca" class="z-10" />
                                <x-dropdown-item label="Algo aca" class="z-10" />
                                <x-dropdown-item label="Algo aca" class="z-10" />

                            </x-dropdown>

                            <x-button type="secondary" wire:click='download' 
                                x-tooltip.raw.placement.top="Descargar todos"
                                class="!text-gray-400 rounded-l-none flex items-center">
                                <x-icon code="file_download" />
                            </x-button>
                        </span>
                    </div>
                @endif
            </div> --}}

            @if ($products->isEmpty())
                <div class="text-center font-semibold text-gray-400 mt-16">
                    <img src="{{ URL::to('img/illustrations/no_data.svg') }}" class="h-32 mx-auto mb-4"
                        alt="no-data-img">
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">No se encontraron resultados</h3>
                </div>
            @else
                {{-- <x-modal ref="showBulkDeleteConfirm" type="danger" icon="warning">

                    <x-slot name="title">
                        Eliminar {{ count($selectedProducts) }} productos
                    </x-slot>

                    <x-slot name="body">
                        ¿Estás seguro de que deseas eliminar todos estos productos?,
                        se eliminara toda la información asociada incluidas sus imágenes.
                    </x-slot>

                    <x-slot name="actions">

                        <x-spinner wire:loading wire:target='bulkAction' />

                        <x-button type="secondary" wire:loading.remove wire:target='bulkAction'
                            @click="showBulkDeleteConfirm = false">Cancelar</x-button>

                        <x-button wire:click="bulkAction('delete')" wire:loading.remove wire:target='bulkAction'
                            class="bg-red-600 hover:bg-red-500 mx-3">Eliminar</x-button>

                    </x-slot>

                </x-modal>

                <ul role="list" class="mb-8">

                    @foreach ($products as $product)
                        @php
                            $isProductSelected = in_array($product->id, $selectedProducts);
                        @endphp

                        @include('admin.products.partials.product-list-item')
                    @endforeach
                </ul>

                <div class="mb-16"> {{ $products->links() }} </div> --}}


                {{--   NEW PRODUCTS TABLE BEGIN HERE   --}}
                <section class="py-3 sm:py-5">
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

                                        <x-icon code="tune" x-tooltip.raw.placement.top="Filtrar"
                                            @click="open = !open"
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
                                            <th scope="col" class="px-4 py-3">Stock</th>
                                            <th scope="col" class="px-4 py-3">Precio</th>
                                            <th scope="col" class="px-4 py-3">Estado</th>
                                            <th scope="col" class="px-4 py-3">Descuento</th>
                                            <th scope="col" class="px-4 py-3">Reseñas</th>
                                            <th scope="col" class="px-4 py-3">Sales</th>
                                            <th scope="col" class="px-4 py-3">Revenue</th>
                                            <th scope="col" class="px-4 py-3">Last Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr wire:key='{{ $product->id }}'
                                                class="border-b text-xs text-center transition-colors duration-300
                                                hover:bg-gray-50">

                                                <td class="w-4 px-4 py-3">
                                                    <div class="flex items-center">
                                                        <input id="checkbox-table-search-1" type="checkbox"
                                                            onclick="event.stopPropagation()"
                                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                                        <label for="checkbox-table-search-1"
                                                            class="sr-only">checkbox</label>
                                                    </div>
                                                </td>

                                                <th class="flex items-center px-4 py-2 font-medium text-gray-900">

                                                    <img src="{{ $product->first_image }}" alt="{{ $product->name }}"
                                                    class="w-8 h-8 mr-3 rounded-lg">

                                                    <div class="flex flex-col items-start">
                                                        <span class="max-w-[220px] truncate font-semibold"
                                                        x-tooltip.raw.placement.top="{{ $product->name }}">
                                                            {{ $product->name }}
                                                        </span>

                                                        <small style="font-size: 11px">{{ $product->category->name }}</small>
                                                    </div>
                                                </th>

                                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $product->stock }}
                                                </td>

                                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                    <div class="flex flex-col">

                                                        <span>${{ priceFormat($product->current_price) }}</span>

                                                        @if ($product->hasDiscount())
                                                            <small class="text-green-700 font-semibold" style="font-size: 11px">
                                                                %{{ $product->discount_percent }} OFF
                                                            </small>
                                                        @endif
                                                    </div>
                                                </td>

                                                <td class="px-4 py-2 whitespace-nowrap mx-auto">
                                                    <span class="inline-flex overflow-hidden shadow-sm">

                                                        <span class="flex h-7 mx-auto rounded-md shadow-sm">

                                                            <x-button type="secondary" wire:click='togglePublishedProduct({{ $product->id }})'
                                                            x-tooltip.raw.placement.top="{{ $product->published ? 'Despublicar' : 'Publicar' }}"
                                                            class="text-xs rounded-r-none flex items-center
                                                            {{ $product->published ? '!bg-blue-100 !text-blue-500' : '' }}">
                                                
                                                                <x-icon wire:loading.remove wire:target='togglePublishedProduct({{ $product->id }})' 
                                                                code="{{ $product->published ? 'visibility' : 'visibility_off' }}" 
                                                                style="font-size: 16px" />
                                                
                                                                <x-spinner wire:loading wire:target='togglePublishedProduct({{ $product->id }})' 
                                                                spinnerclass="!h-4 !w-4" />
                                                
                                                            </x-button>
                                                
                                                            <x-button type="secondary" wire:click='toggleFeaturedProduct({{ $product->id }})'
                                                            x-tooltip.raw.placement.top="{{ $product->featured ? 'No destacar' : 'Destacar' }}"
                                                            class="rounded-l-none flex items-center
                                                            {{ $product->featured ? '!bg-yellow-100 !text-yellow-500' : '' }}">
                                                
                                                                <x-icon wire:loading.remove wire:target='toggleFeaturedProduct({{ $product->id }})' 
                                                                code="star" style="font-size: 16px" />
                                                
                                                                <x-spinner wire:loading wire:target='toggleFeaturedProduct({{ $product->id }})' 
                                                                spinnerclass="!h-4 !w-4" />
                                                
                                                            </x-button>
                                                
                                                        </span>
                                                    </span>  
                                                </td>

                                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $product->discount_percent ? '%' . $product->discount_percent : '-' }}
                                                </td>

                                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <svg aria-hidden="true" class="w-5 h-5 text-yellow-400"
                                                            fill="currentColor" viewbox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        <svg aria-hidden="true" class="w-5 h-5 text-yellow-400"
                                                            fill="currentColor" viewbox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        <svg aria-hidden="true" class="w-5 h-5 text-yellow-400"
                                                            fill="currentColor" viewbox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        <svg aria-hidden="true" class="w-5 h-5 text-yellow-400"
                                                            fill="currentColor" viewbox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        <svg aria-hidden="true" class="w-5 h-5 text-yellow-400"
                                                            fill="currentColor" viewbox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        <span class="ml-1 text-gray-500">5.0</span>
                                                    </div>
                                                </td>

                                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"
                                                            fill="currentColor" class="w-5 h-5 mr-2 text-gray-400"
                                                            aria-hidden="true">
                                                            <path
                                                                d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                                                        </svg>
                                                        1.6M
                                                    </div>
                                                </td>

                                                <td class="px-4 py-2">$3.2M</td>

                                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Just
                                                    now
                                                </td>
                                            </tr>
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
                        </div>
                    </div>
                </section>
                                                                
            @endif
        </div>
    @endif

</div>
