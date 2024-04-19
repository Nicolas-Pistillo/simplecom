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
        <div x-data="{ showNotification: false, showBulkDeleteConfirm: false }" x-on:open-notification.window="showNotification = true"
            x-on:close-bulk-delete-dialog.window="showBulkDeleteConfirm = false">

            {{-- Product list header --}}
            <div class="flex justify-between items-end mt-8 mb-6">

                {{-- Search & bulk actions --}}
                <div class="flex items-end w-full">

                    {{-- Product search --}}
                    <x-input type="search" value="{{ $search }}" wire:model.live='search'
                        class="flex-shrink border-none w-56 p-0 mr-4">
                        <x-slot name="label">
                            <div class="flex items-center">
                                <x-icon code="search" class="mr-2 text-gray-400" /> Buscar productos...
                            </div>
                        </x-slot>
                    </x-input>

                    {{-- Bulk actions --}}
                    @if (!empty($selectedProducts))
                        <x-dropdown wire:loading.remove wire:target='bulkAction'>

                            <x-slot name="title">
                                {{ count($selectedProducts) }}
                                {{ count($selectedProducts) == 1 ? 'seleccionado' : 'seleccionados' }}
                            </x-slot>

                            <x-dropdown-item wire:click="bulkAction('publish')" @click="open = false"
                                label="Publicar" icon="public" />

                            <x-dropdown-item wire:click="bulkAction('unpublish')" @click="open = false"
                                label="Despublicar" icon="visibility_off" />

                            <x-dropdown-item wire:click="bulkAction('highlight')" @click="open = false"
                                label="Destacar" icon="star" />

                            <x-dropdown-item wire:click="bulkAction('unhighlight')" @click="open = false"
                                label="Remover de destacados" icon="remove_circle_outline" />

                            <x-dropdown-item wire:click="downloadSelecteds" @click="open = false"
                                label="Descargar excel" icon="file_download" />

                            <x-dropdown-item @click="showBulkDeleteConfirm = true; open = false"
                                label="Eliminar" icon="delete" iconClass="text-red-400" />

                        </x-dropdown>

                        <x-spinner wire:loading wire:target='bulkAction' />
                    @endif
                </div>

                {{-- Filters & Export buttons --}}
                @if ($products->isNotEmpty())
                    <div class="flex justify-center z-10">
                        <span class="isolate inline-flex -space-x-px rounded-md shadow-sm">

                            {{-- Filters --}}
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

                            {{-- Export --}}
                            <x-button type="secondary" x-tooltip.raw.placement.top="Exportar"
                                class="!text-gray-400 rounded-l-none flex items-center">
                                <x-icon code="file_download" />
                            </x-button>
                        </span>
                    </div>
                @endif
            </div>

            @if ($products->isEmpty())
                <div class="text-center font-semibold text-gray-400 mt-16">
                    <img src="{{ URL::to('img/illustrations/no_data.svg') }}" class="h-32 mx-auto mb-4"
                        alt="no-data-img">
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">No se encontraron resultados</h3>
                </div>
            @else
                {{-- Notifications --}}
                <x-toast ref="showNotification" type="success" title="{{ $notificationMessage }}" />

                {{-- Confirm bulk delete products --}}
                <x-modal ref="showBulkDeleteConfirm" type="danger" icon="warning">

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

                {{-- Product list --}}
                <ul role="list" class="mb-8">

                    @foreach ($products as $product)
                        @php
                            $isProductSelected = in_array($product->id, $selectedProducts);
                        @endphp

                        <li wire:key='{{ $product->id }}' x-data="{ showDeleteProductConfirm: false }"
                            class="flex justify-between gap-x-6 py-5 px-3 border-b
                            {{ $isProductSelected ? 'shadow border-l-2 border-l-blue-700 bg-blue-50' : 'hover:bg-gray-50' }}">

                            {{-- Product thumbnail, name, stock, code & states --}}
                            <div class="flex items-center">
                                <div class="flex min-w-0 gap-x-5 items-center">

                                    <input type="checkbox" wire:model.live='selectedProducts'
                                        value="{{ $product->id }}"
                                        :checked="{{ $isProductSelected ? 'true' : 'false' }}"
                                        id="select-product-{{ $product->id }}"
                                        class="h-4 w-4 rounded cursor-pointer border-gray-300 text-blue-600">

                                    <label for="select-product-{{ $product->id }}" class="cursor-pointer">
                                        <img class="w-14 object-contain rounded flex-none shadow-md" alt="product-img"
                                        src="{{ $product->getPresentationImage() ?: URL::to('img/no-image.png') }}">
                                    </label>

                                    <div class="min-w-0 flex-auto">

                                        <p class="text-sm font-semibold leading-6 text-gray-900 flex items-center">

                                            {{ $product->name }}

                                            <span class="isolate inline-flex rounded-md shadow-sm ml-2">

                                                <x-button type="secondary" wire:click='togglePublishedProduct({{ $product }})'
                                                x-tooltip.raw.placement.top="{{ $product->published ? 'Publicado' : 'No publicado' }}"
                                                class="text-xs rounded-r-none flex items-center
                                                {{ $product->published ? '!bg-blue-100 !text-blue-500' : '' }}">
                                                    <x-icon code="{{ $product->published ? 'visibility' : 'visibility_off' }}" 
                                                    style="font-size: 16px" />
                                                </x-button>

                                                <x-button type="secondary" wire:click='toggleFeaturedProduct({{ $product }})'
                                                x-tooltip.raw.placement.top="{{ $product->featured ? 'Destacado' : 'No destacado' }}"
                                                class="rounded-l-none flex items-center
                                                {{ $product->featured ? '!bg-yellow-100 !text-yellow-500' : '' }}">
                                                    <x-icon code="star" style="font-size: 16px" />
                                                </x-button>

                                            </span>
                                        </p>

                                        <p class="mt-1 font-semibold flex text-xs leading-5 text-gray-500">

                                            @if ($product->stock === 0)
                                                <span class="text-red-500">Sin stock</span>
                                            @else
                                                <span class="font-semibold">Stock: {{ $product->stock }}</span>
                                            @endif

                                            @if ($product->code)
                                                <span class="ml-1">- Código: {{ $product->code }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Product price, category & actions --}}
                            <div class="flex shrink-0 items-center gap-x-6">

                                <div class="flex flex-col items-end">
                                    <p class="text-sm leading-6 text-green-600">
                                        ${{ priceFormat($product->price) }}
                                    </p>
                                    <p class="mt-1 text-xs leading-5 text-gray-500">
                                        {{ $product->category->name }}
                                    </p>
                                </div>

                                {{-- Product actions --}}
                                <div class="relative flex-none">

                                    <x-dropdown position="right">

                                        <x-slot name="trigger">
                                            <x-icon code="more_vert" class="text-2xl text-gray-500 
                                                w-8 h-8 p-1 flex items-center rounded-full bg-gray-100 
                                                transition hover:bg-gray-200 text-center no-select shadow cursor-pointer" />
                                        </x-slot>

                                        <x-dropdown-item label="Ver en la tienda" icon="store" />

                                        <x-dropdown-item label="Editar" icon="edit" />

                                        <x-dropdown-item @click="showDeleteProductConfirm = true" label="Eliminar"
                                            icon="delete" iconClass="text-red-400" />

                                    </x-dropdown>

                                    {{-- Confirm delete product --}}
                                    <x-modal ref="showDeleteProductConfirm" type="danger" icon="warning">

                                        <x-slot name="title">
                                            Eliminar <span class="text-blue-600">{{ $product->name }}</span>
                                        </x-slot>

                                        <x-slot name="body">
                                            ¿Estás seguro de que deseas eliminar este producto?, se eliminara toda la
                                            información asociada incluidas sus imágenes.
                                        </x-slot>

                                        <x-slot name="actions">

                                            <x-spinner wire:loading wire:target='deleteProduct' />

                                            <x-button type="secondary" wire:loading.remove wire:target='deleteProduct'
                                                @click="showDeleteProductConfirm = false">Cancelar</x-button>

                                            <x-button wire:click='deleteProduct({{ $product }})'
                                                wire:loading.remove wire:target='deleteProduct'
                                                class="bg-red-600 hover:bg-red-500 mx-3">Eliminar</x-button>

                                        </x-slot>

                                    </x-modal>
                                </div>
                            </div>

                        </li>
                    @endforeach
                </ul>

                {{-- Paginator --}}
                <div class="mb-16"> {{ $products->links() }} </div>
            @endif
        </div>
    @endif

</div>
