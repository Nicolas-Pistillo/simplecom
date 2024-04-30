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

                            {{-- Export all --}}
                            <x-button type="secondary" wire:click='download' 
                                x-tooltip.raw.placement.top="Descargar todos"
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

                        @include('admin.products.partials.product-list-item')
                    @endforeach
                </ul>

                {{-- Paginator --}}
                <div class="mb-16"> {{ $products->links() }} </div>
            @endif
        </div>
    @endif

</div>
