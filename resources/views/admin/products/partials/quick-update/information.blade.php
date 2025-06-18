<div class="grid gap-4 sm:grid-cols-3 sm:gap-6 py-6 px-8">
    <div class="space-y-4 sm:col-span-2 sm:space-y-6">

        <div class="grid md:grid-cols-2 gap-4">

            <x-form-input class="col-span-full" label="Nombre" model='form.name' id="product_name" />

            <div>
                <label for="product_category" class="inline-block text-sm 
                font-medium leading-6 text-gray-900 mb-2">
                    Categoría
                </label>
                <div>
                    <select wire:model.live="form.category_id" id="product_category" 
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                        shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                        focus:ring-inset focus:ring-blue-600 text-sm leading-6">
                        <option>Seleccionar</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>

                            @if ($category->hasChilds())
                                @foreach ($category->childs as $categoryChild)
                                    <option value="{{ $categoryChild->id }}">
                                        {{ $category->name }} > {{ $categoryChild->name }}
                                    </option>

                                    @if ($categoryChild->hasChilds())
                                        @foreach ($categoryChild->childs as $categoryGrandchild)
                                            <option value="{{ $categoryGrandchild->id }}">
                                                {{ $category->name }} > {{ $categoryChild->name }} >
                                                {{ $categoryGrandchild->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </select>
    
                    @error('form.category_id')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div>
                <label for="product_brand" class="inline-block text-sm 
                font-medium leading-6 text-gray-900 mb-2">
                    Marca
                </label>
                <div>
                    <select wire:model.live="form.brand_id" id="product_brand" 
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                        shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                        focus:ring-inset focus:ring-blue-600 text-sm leading-6">
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

                                        <img class="w-32 h-24 mt-3 rounded mx-auto shadow object-cover"
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

            @script
                <script>
                    Livewire.on('open-quick-update', () => {
                        setTimeout(() => {
                            new Sortable(document.getElementById('previewImages'), {
                                handle: '.sortable-item',
                                animation: 250,
                                ghostClass: 'bg-gray-100',
                                store: {
                                    set: (sortable) => Livewire.dispatch('change-images-order', {
                                        newOrder: sortable.toArray()
                                    })
                                }
                            });
                        }, 500);
                    })
                </script>
            @endscript
        </div>
    </div>

    <div class="space-y-4 sm:space-y-6">

        <x-form-input label="Stock" type="number" model='form.stock' id="product_stock" />

        <x-form-input type="number" model='form.weight' id="product_weight">
            <x-slot name="label">
                Peso <x-badge color="blue" class="ml-1" x-tooltip.raw="Gramos">GR</x-badge>
            </x-slot>
        </x-form-input>

        <x-form-input type="number" model='form.width' id="product_width">
            <x-slot name="label">
                Ancho <x-badge color="blue" class="ml-1" x-tooltip.raw="Centímetros">CM</x-badge>
            </x-slot>
        </x-form-input>

        <x-form-input type="number" model='form.height' id="product_height">
            <x-slot name="label">
                Alto <x-badge color="blue" class="ml-1" x-tooltip.raw="Centímetros">CM</x-badge>
            </x-slot>
        </x-form-input>

        <x-form-input type="number" model='form.length' id="product_length">
            <x-slot name="label">
                Largo <x-badge color="blue" class="ml-1" x-tooltip.raw="Centímetros">CM</x-badge>
            </x-slot>
        </x-form-input>
    </div>
</div>