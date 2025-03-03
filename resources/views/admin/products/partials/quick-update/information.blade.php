<div class="grid gap-4 sm:grid-cols-3 sm:gap-6 py-6 px-8">
    <div class="space-y-4 sm:col-span-2 sm:space-y-6">
        <div>
            <label for="product_name"
                class="block mb-2 text-sm 
            font-medium text-gray-900">
                Nombre
            </label>
            <input type="text" id="product_name"
                class="bg-gray-50 border 
            border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
            focus:border-primary-600 block w-full p-2.5"
                wire:model.blur='form.name' placeholder="Nombre del producto" autocomplete="off">

            @error('form.name')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label for="product_category" class="block mb-2 text-sm font-medium text-gray-900">
                    Categoría
                </label>
                <select id="product_category" wire:model.blur='form.category_id'
                    class="bg-gray-50 border border-gray-300 text-gray-900 
                text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option>Seleccionar</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('form.category_id')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="product_brand" class="block mb-2 text-sm font-medium text-gray-900">
                    Marca
                </label>
                <select id="product_brand" wire:model.blur='form.brand_id'
                class="bg-gray-50 border border-gray-300 text-gray-900 
                text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option>Seleccionar</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>

                @error('form.brand_id')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div>
            <label for="product_description" class="block mb-2 text-sm 
            font-medium text-gray-900">
                Descripción
            </label>
            <div class="w-full border border-gray-200 rounded-lg bg-gray-50">
                <div class="p-3 bg-white rounded-lg">
                    <textarea id="product_description" rows="7" scrollbar-thin
                        class="block w-full p-0 text-sm text-gray-800
                    bg-white border-0 focus:ring-0"
                        wire:model.blur='form.description' placeholder="Usa una descripción llamativa de tu producto"></textarea>
                </div>
            </div>

            @error('form.description')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- Images --}}
        <div class="mb-4 no-select">
            <span class="block mb-2 text-sm font-medium text-gray-900">Imágenes</span>

            <div id="previewImages" class="flex gap-1 flex-wrap">

                @if (!empty($images))
                    @foreach ($images as $key => $image)
                        @if (isset($image->id))
                            <div wire:key='{{ $image->id }}' data-id="{{ $image->id }}"
                                x-data="{ deleteDialogOpen: false }" class="sortable-item text-center rounded-md m-2"
                                :class="deleteDialogOpen ? 'cursor-default' : 'cursor-move'">

                                <div x-data="{ showDelete: false }" @mouseenter="showDelete = true"
                                    @mouseleave="showDelete = false" class="relative mb-2">

                                    <x-badge color="blue" class="absolute -top-2 -left-2 
                                    !rounded-full !w-5 !h-5 flex items-center justify-center">
                                        {{ $loop->index + 1 }}
                                    </x-badge>

                                    <img src="{{ Storage::url($image->url) }}" alt="preview-product-image"
                                        class="w-24 h-20 border rounded-lg shadow object-cover">

                                    <x-icon x-show="showDelete" code="delete"
                                        @click="deleteDialogOpen = true"
                                        x-tooltip.raw.placement.bottom="Eliminar" style="font-size: 20px"
                                        class="cursor-pointer 
                                            absolute -bottom-2 -right-2 p-1 bg-gray-50 
                                            hover:bg-white text-red-500 shadow rounded-full" />
                                </div>

                                <p class="text-xs text-gray-700">
                                    Subida el {{ $image->created_at->format('d/m') }}
                                </p>

                                <x-modal ref="deleteDialogOpen" type="danger" icon="warning"
                                    title="Eliminar imagen">

                                    <x-slot name="body">
                                        ¿Estás seguro que deseas eliminar esta imagen?

                                        <img class="w-32 h-24 mt-3 rounded mx-auto shadow object-contain"
                                            src="{{ $image->url() }}" alt="product-image">
                                    </x-slot>

                                    <x-slot name="actions">

                                        <x-spinner wire:loading wire:target='deleteImage' />

                                        <x-button type="secondary" wire:loading.remove
                                            wire:target='deleteImage'
                                            @click="deleteDialogOpen = false">Cancelar</x-button>

                                        <x-button wire:click='deleteImage({{ $key }})'
                                            wire:loading.remove wire:target='deleteImage'
                                            class="bg-red-600 hover:bg-red-500">Eliminar</x-button>

                                    </x-slot>

                                </x-modal>
                            </div>
                        @else
                            <div wire:key='{{ $image->path() }}' data-id="{{ $image->path() }}"
                                class="sortable-item cursor-move text-center rounded-md m-2">

                                <div x-data="{ showDelete: false }" @mouseenter="showDelete = true"
                                    @mouseleave="showDelete = false" class="relative mb-2">

                                    <x-badge color="blue" class="absolute -top-2 -left-2
                                    !rounded-full !w-5 !h-5 flex items-center justify-center">
                                        {{ $loop->index + 1 }}
                                    </x-badge>

                                    <img src="{{ $image->temporaryUrl() }}" alt="preview-product-image"
                                        class="w-24 h-20 border rounded-lg shadow object-cover">

                                    <x-icon x-show="showDelete" code="delete"
                                        wire:click='deleteImage({{ $key }})'
                                        x-tooltip.raw.placement.bottom="Eliminar" style="font-size: 20px"
                                        class="cursor-pointer 
                                            absolute -bottom-2 -right-2 p-1 bg-gray-50 
                                            hover:bg-white text-red-500 shadow rounded-full" />
                                </div>

                                <p class="text-xs text-gray-700">
                                    {{ formatBytes($image->getSize()) }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            <div @click="document.getElementById('add-image-input').click()" 
            class="text-center rounded-full py-1.5 px-3 border inline-flex 
            items-center justify-center cursor-pointer transition duration-300 
            hover:shadow mt-2" wire:loading.remove wire:target='images'>
                <div class="text-blue-500 flex items-center gap-1">
                    <x-icon code="add_circle" />
                    <p class="text-xs">Agregar imagen</p>
                    <input id="add-image-input" type="file" accept="image/*"
                    class="sr-only" wire:model='images'>
                </div>
            </div>

            <div wire:loading wire:target='images'>
                <div class="flex items-center gap-1 mt-2 py-1.5 px-3">
                    <x-spinner wire:loading wire:target='images' class="mr-1.5" />
                    <span class="text-sm text-gray-700 font-semibold">Subiendo</span>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-4 sm:space-y-6">
        <div>
            <label for="product_stock" class="block mb-2 text-sm font-medium text-gray-900">
                Stock
            </label>
            <input type="number" id="product_stock" wire:model.blur='form.stock'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
            rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                placeholder="Stock actual">

            @error('form.stock')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div>
            <label for="product_weight" class="block mb-2 text-sm font-medium text-gray-900">
                Peso <x-badge color="blue" class="ml-1" x-tooltip.raw="Gramos">GR</x-badge>
            </label>
            <input type="number" id="product_weight" wire:model.blur='form.weight'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
            rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                placeholder="Peso en gramos">

            @error('form.weight')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div>
            <label for="product_width" class="block mb-2 text-sm font-medium text-gray-900">
                Ancho <x-badge color="blue" class="ml-1" x-tooltip.raw="Centímetros">CM</x-badge>
            </label>
            <input type="number" id="product_width" wire:model.blur='form.width'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
            rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                placeholder="Ancho en centímtros">

            @error('form.width')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div>
            <label for="product_height" class="block mb-2 text-sm font-medium text-gray-900">
                Alto <x-badge color="blue" class="ml-1" x-tooltip.raw="Centímetros">CM</x-badge>
            </label>
            <input type="number" id="product_height" wire:model.blur='form.height'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
            rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                placeholder="Alto en centímtros">

            @error('form.height')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div>
            <label for="product_length" class="block mb-2 text-sm font-medium text-gray-900">
                Largo <x-badge color="blue" class="ml-1" x-tooltip.raw="Centímetros">CM</x-badge>
            </label>
            <input type="number" id="product_length" wire:model.blur='form.length'
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
            rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                placeholder="Largo en centímtros">

            @error('form.length')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>