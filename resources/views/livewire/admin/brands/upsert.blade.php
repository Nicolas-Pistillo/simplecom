<div>
    <div x-data="{ brandPanelOpen: false, confirmDeleteBrand: false }" class="px-4 sm:px-6 lg:px-8"
    x-on:open-brand-panel.window="brandPanelOpen = true; $nextTick(() => {document.getElementById('brand_name').focus()})"
    x-on:close-brand-panel.window="brandPanelOpen = false"
    x-on:open-confirm-delete-brand.window="confirmDeleteBrand = true"
    x-on:close-confirm-delete-brand.window="confirmDeleteBrand = false">

        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Marcas</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Podes buscar y agregar las marcas registradas oficiales con las que vas a comercializar, luego
                    podrás asignar
                    la correspondiente a cada producto que crees.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button class="flex items-center" wire:click='openNewBrand'
                @click="$nextTick(() => {document.getElementById('brand_name').focus()})">
                    <x-icon code="add" class="mr-1" />
                    Nueva marca
                </x-button>
            </div>
        </div>

        {{-- Upsert form --}}
        @include('admin.brands.partials.upsert-form')

        @if ($brands->isEmpty())
            <div class="text-center pt-24">

                <img src="{{ URL::to('img/illustrations/transfer_files.svg') }}" class="h-52 mx-auto mb-4"
                    alt="no-data-img">

                <div class="mb-4">
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Sin marcas</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        <span wire:click='openNewBrand'
                        class="text-blue-500 hover:underline hover:text-blue-600 cursor-pointer">
                            Registrá tu primer marca
                        </span> cuando quieras
                    </p>
                </div>
            </div>
        @else
            <div class="my-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8" scrollbar-thin>
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                        Nombre
                                    </th>
                                    <th scope="col"
                                        class="px-3 whitespace-nowrap py-3.5 text-center text-sm font-semibold text-gray-900">
                                        Productos asociados
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($brands as $brand)
                                    <tr wire:key='{{ $brand->id }}' class="hover:bg-gray-50">
                                        <td class="py-4 pl-2 text-sm font-medium text-gray-900">

                                            <div class="flex items-center whitespace-nowrap">

                                                <img src="{{ !empty($brand->image_url) ? Storage::url($brand->image_url) : URL::to('img/brand-placeholder.jpg') }}"
                                                class="w-9 h-9 rounded-full mr-2 shadow object-contain" alt="brand-logo">

                                                {{ $brand->name }}
                                            </div>
                                        </td>

                                        <td class="text-center px-3 py-4 text-sm text-gray-500">
                                            {{ $brand->products()->count() }}
                                        </td>

                                        <td class="text-center px-3 py-4 text-sm text-gray-500">
                                            <span class="inline-flex overflow-hidden shadow-sm">

                                                <span class="flex h-7 mx-auto rounded-md shadow-sm">
                                    
                                                    <x-button type="secondary" wire:click='togglePublished({{ $brand->id }})'
                                                        x-tooltip.raw.placement.top="{{ $brand->published ? 'Despublicar' : 'Publicar' }}"
                                                        class="text-xs rounded-r-none flex items-center
                                                            {{ $brand->published ? '!bg-blue-100 !text-blue-500' : '' }}">
                                    
                                                        <x-icon wire:loading.remove wire:target='togglePublished({{ $brand->id }})'
                                                            code="{{ $brand->published ? 'visibility' : 'visibility_off' }}" style="font-size: 16px" />
                                    
                                                        <x-spinner wire:loading wire:target='togglePublished({{ $brand->id }})'
                                                            spinnerclass="!h-4 !w-4" />
                                    
                                                    </x-button>
                                    
                                                    <x-button type="secondary" wire:click='toggleFeatured({{ $brand->id }})'
                                                        x-tooltip.raw.placement.top="{{ $brand->featured ? 'No destacar' : 'Destacar' }}"
                                                        class="rounded-none flex items-center
                                                            {{ $brand->featured ? '!bg-yellow-100 !text-yellow-500' : '' }}">
                                    
                                                        <x-icon wire:loading.remove wire:target='toggleFeatured({{ $brand->id }})' code="star"
                                                            style="font-size: 16px" />
                                    
                                                        <x-spinner wire:loading wire:target='toggleFeatured({{ $brand->id }})'
                                                            spinnerclass="!h-4 !w-4" />
                                    
                                                    </x-button>
                                    
                                                    <x-button type="secondary" wire:click='openEditBrand({{ $brand->id }})' 
                                                    class="flex items-center rounded-none"
                                                    x-tooltip.raw.placement.top="Editar">
                                                        <x-icon code="edit" style="font-size: 16px" />
                                                    </x-button>
                                    
                                                    <x-button type="secondary" wire:click='showDeleteDialog({{ $brand->id }})'
                                                    class="flex items-center rounded-l-none text-red-500"
                                                    x-tooltip.raw.placement.top="Eliminar">
                                                        <x-icon code="delete" style="font-size: 16px" />
                                                    </x-button>
                                    
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Confirm delete brand --}}
                <x-modal ref="confirmDeleteBrand" type="danger" icon="warning" closeOnClickAway>

                    <x-slot name="title">
                        Eliminar la marca <span class="text-blue-600">{{ $this->brand?->name }}</span>
                    </x-slot>

                    <x-slot name="body">
                        ¿Estás seguro de que deseas eliminar esta marca?, se removerá de todos
                        los productos asociados.
                    </x-slot>

                    <x-slot name="actions">

                        <x-spinner wire:loading wire:target='deleteBrand' />

                        <x-button type="secondary" wire:loading.remove wire:target='deleteBrand'
                        @click="confirmDeleteBrand = false">Cancelar</x-button>

                        <x-button wire:click='deleteBrand' wire:loading.remove
                        wire:target='deleteBrand' class="bg-red-600 hover:bg-red-500">Eliminar</x-button>

                    </x-slot>

                </x-modal>
            </div>
        @endif
    </div>
</div>
