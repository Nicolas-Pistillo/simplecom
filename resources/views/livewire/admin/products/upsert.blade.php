<div>

    <form wire:submit='save' class="pb-6" x-data="{ showNotification: false }" x-on:open-notification.window="showNotification = true">

        {{-- Success notification toast --}}
        <x-toast ref="showNotification" type="success" title="{{ $notificationMessage }}" />

        <div class="space-y-12">

            {{-- Published & edit alert block --}}
            <div class="grid grid-cols-1 space-y-4 md:space-y-0 gap-x-8 border-gray-900/10 md:grid-cols-3">

                {{-- Published switch --}}
                <x-switch wireModel='form.published' :label="$product ? 'Publicar' : 'Publicar al finalizar'" />

                {{-- Edit alert --}}
                @if ($product)
                    <x-alert class="col-span-2">Estas editando el producto
                        <span class="font-semibold">{{ "#$product->id - $product->name" }}</span>
                    </x-alert>
                @endif
            </div>

            {{-- Identification info block --}}
            <section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">

                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Identificación</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Datos que representan las referencias y relaciones básicas de tu producto.
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    {{-- Name field --}}
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">
                            Nombre <sup class="text-red-500 -ml-1">*</sup>
                        </label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <input wire:model.blur='form.name' autocomplete="off" type="text" id="name"
                                    required
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                            @error('form.name')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Code field --}}
                    <div class="sm:col-span-3">
                        <label for="code" class="block text-sm font-medium leading-6 text-gray-900">
                            Código/SKU
                        </label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <input wire:model.blur='form.code' autocomplete="off" type="text" name="code"
                                    id="code"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                            @error('form.code')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Brand field --}}
                    <div x-data="{brandPanelOpen: false}" @click.away="brandPanelOpen = false" class="sm:col-span-3">
                        <label for="brands" class="flex items-center text-sm font-medium leading-6 text-gray-900">
                            Marca
                            <x-icon x-tooltip.raw.placement.top="Podes buscar y seleccionar tu marca dentro de los resultados sugeridos de esta búsqueda para poder registarla."
                            code="help" class="ml-1 text-blue-500" />
                        </label>

                        <div class="mt-2 flex items-center">
                            <div class="flex items-center w-full rounded-md shadow-sm sm:max-w-md ring-gray-300 ring-1 ring-inset
                            {{ !$selectedBrand ? 'focus-within:ring-blue-600 focus-within:ring-2 focus-within:ring-inset' : '' }}">

                                @if ($selectedBrand)
                                    <img class="ml-1 rounded-full w-6 h-6 object-contain" 
                                    src="{{ !empty($selectedBrand->image_url) ? $selectedBrand->image_url : URL::to('img/brand-placeholder.jpg') }}" />

                                    <input type="text" readonly value="{{ $selectedBrand->name }}"
                                    class="relative block w-full placeholder:text-sm flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 text-sm sm:leading-6"
                                    placeholder="Buscar marca por nombre...">

                                    <x-icon code="delete" x-tooltip.raw.placement.top="Desvincular marca"
                                    wire:click='removeBrand' 
                                    class="ml-auto mr-1 cursor-pointer text-red-500" />
                                @else
                                    <input type="search" wire:model.live.debounce.800ms='brandSearch' autocomplete="off" id="brands"
                                    @focus="brandPanelOpen = true" @keydown="brandPanelOpen = true"
                                    class="relative block w-full placeholder:text-sm flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 text-sm sm:leading-6"
                                    placeholder="Buscar marca por nombre...">

                                    <x-spinner wire:loading wire:target='selectBrand'
                                    class="ml-auto mr-1" />
                                @endif
                            </div>
                        </div>

                        <div x-show="brandPanelOpen" x-cloak x-transition
                            class="absolute z-10 mt-2 bg-white min-w-[14rem] rounded shadow-md overflow-y-auto max-h-44">
                            <ul>
                                <div class="flex items-center">
                                    <x-spinner wire:loading wire:target='brandSearch' class="mx-auto py-4" />
                                </div>
                                @forelse ($brands as $brand)
                                    @isset($brand['id'])
                                        <li wire:key='{{ $brand['id'] }}' @click="brandPanelOpen = false"
                                        wire:loading.remove wire:target='brandSearch'
                                        wire:click="selectBrand('{{ $brand['image_url'] }}', '{{ $brand['name'] }}')"
                                        class="text-sm my-2 p-2 flex items-center hover:bg-gray-100 cursor-pointer">
                                        <img src="{{ !empty($brand['image_url']) ? $brand['image_url'] : URL::to('img/brand-placeholder.jpg') }}" 
                                        class="h-6 w-6 mr-2 rounded-full object-contain" alt="brand-logo">
                                            {{ $brand['name'] }}
                                        </li>
                                    @else
                                        <li wire:key='{{ $brand['brandId'] }}' @click="brandPanelOpen = false"
                                        wire:loading.remove wire:target='brandSearch'
                                        wire:click="selectBrand('{{ $brand['icon'] }}', '{{ $brand['name'] }}')"
                                        class="text-sm my-2 p-2 flex items-center hover:bg-gray-100 cursor-pointer">
                                        <img src="{{ !empty($brand['icon']) ? $brand['icon'] : URL::to('img/brand-placeholder.jpg') }}" 
                                        class="h-6 w-6 mr-2 rounded-full object-contain" alt="brand-logo">
                                            {{ $brand['name'] }}
                                        </li>
                                    @endif
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    {{-- Category field --}}
                    <div class="sm:col-span-3">
                        <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">
                            Categoría <sup class="text-red-500 -ml-1">*</sup>
                        </label>
                        <div class="mt-2">
                            <select wire:model.live='form.category_id' id="category_id" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                                shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                                focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                                <option>Seleccionar una categoría...</option>

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
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Description field --}}
                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">
                            Descripción
                        </label>
                        <div class="mt-2">
                            <textarea wire:model.blur='form.description' id="description" rows="7"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                            focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"></textarea>

                            @error('form.description')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror

                            @if (!$errors->first('form.description'))
                                <span class="mt-1 text-xs leading-6 text-gray-500">
                                    Puede contener hasta 2400 caracteres como máximo
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            </section>

            {{-- Pricing block --}}
            <section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Venta</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        También podes cargar el descuento y configurar las unidades de compra.
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    {{-- Price field --}}
                    <div class="sm:col-span-3">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">
                            Precio <sup class="text-red-500 -ml-1">*</sup>
                        </label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <input wire:model.blur='form.price' autocomplete="off" step="0.01" type="number"
                                    id="price" required
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                            @error('form.price')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Discount % field --}}
                    <div class="sm:col-span-3">
                        <label for="discount_percent" class="block text-sm font-medium leading-6 text-gray-900">
                            Porcentaje de descuento
                        </label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">%</span>
                                <input wire:model.blur='form.discount_percent' type="number" max="100"
                                    id="discount_percent" autocomplete="off"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>

                            @error('form.discount_percent')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Min sale field --}}
                    <div class="sm:col-span-3 sm:col-start-1">
                        <label for="min_sale" class="block text-sm font-medium leading-6 text-gray-900">
                            Compra mínima
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.min_sale' type="number" id="min_sale" autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                            focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                            @error('form.min_sale')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror

                            @if (!$errors->first('form.min_sale') && !$form->min_sale)
                                <span class="mt-1 text-xs leading-6 text-gray-500">
                                    Por defecto el valor será de 1 unidad
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Max sale field --}}
                    <div class="sm:col-span-3">
                        <label for="max_sale" class="block text-sm font-medium leading-6 text-gray-900">
                            Compra máxima
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.max_sale' type="number" id="max_sale" autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                            @error('form.max_sale')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror

                            @if (!$errors->first('form.max_sale') && !$form->max_sale)
                                <span class="mt-1 text-xs leading-6 text-gray-500">
                                    Por defecto el límite será el stock
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            {{-- Images block --}}
            <section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Imágenes</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Podes cambiar el orden de visualización que se verá en la pantalla del producto moviendo las
                        images que subas.
                    </p>
                </div>

                <div class="max-w-2xl space-y-10 md:col-span-2">

                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                        <div class="sm:col-span-6">

                            <x-dropzone model="images" />

                            <div id="previewImages" class="flex items-center flex-wrap">
                                @if (!empty($images))
                                    @foreach ($images as $key => $image)
                                        @if (isset($image->id))
                                            <div wire:key='{{ $image->id }}' data-id="{{ $image->id }}"
                                                x-data="{ deleteDialogOpen: false }"
                                                class="sortable-item text-center rounded-md m-2"
                                                :class="deleteDialogOpen ? 'cursor-default' : 'cursor-move'">

                                                <div x-data="{ showDelete: false }" @mouseenter="showDelete = true"
                                                    @mouseleave="showDelete = false" class="relative mb-2">

                                                    <x-badge color="blue"
                                                        class="absolute -top-2 -left-2 !rounded-full">
                                                        {{ $loop->index + 1 }}
                                                    </x-badge>

                                                    <img src="{{ Storage::url($image->url) }}"
                                                        alt="preview-product-image"
                                                        class="w-24 h-20 border rounded-lg shadow object-cover">

                                                    <x-icon x-show="showDelete" code="delete"
                                                        @click="deleteDialogOpen = true"
                                                        x-tooltip.raw.placement.bottom="Eliminar"
                                                        style="font-size: 20px"
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
                                                            class="bg-red-600 hover:bg-red-500 mx-3">Eliminar</x-button>

                                                    </x-slot>

                                                </x-modal>
                                            </div>
                                        @else
                                            <div wire:key='{{ $image->path() }}' data-id="{{ $image->path() }}"
                                                class="sortable-item cursor-move text-center rounded-md m-2">

                                                <div x-data="{ showDelete: false }" @mouseenter="showDelete = true"
                                                    @mouseleave="showDelete = false" class="relative mb-2">

                                                    <x-badge color="blue"
                                                        class="absolute -top-2 -left-2 !rounded-full">
                                                        {{ $loop->index + 1 }}
                                                    </x-badge>

                                                    <img src="{{ $image->temporaryUrl() }}"
                                                        alt="preview-product-image"
                                                        class="w-24 h-20 border rounded-lg shadow object-cover">

                                                    <x-icon x-show="showDelete" code="delete"
                                                        wire:click='deleteImage({{ $key }})'
                                                        x-tooltip.raw.placement.bottom="Eliminar"
                                                        style="font-size: 20px"
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

                        </div>
                    </div>
                </div>
            </section>

            {{-- Tags block --}}
            <section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Etiquetas</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Las etiquetas ayudan a que tus clientes y el navegador encuentren productos de este tipo con
                        mayor facilidad.
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    {{-- Tags field --}}
                    <div x-data="{ tagsPanelOpen: false }" class="sm:col-span-4">
                        <label for="tags" class="flex items-center text-sm font-medium leading-6 text-gray-900">
                            Elegir etiqueta
                            <x-icon
                                x-tooltip.raw.placement.top="Podés crear nuevas etiquetas escribiendo 
                            su nombre en este campo y luego presionando ENTER para guardarlas y asociarlas al producto."
                                code="help" class="ml-1 text-blue-500" />
                        </label>

                        <div class="mt-2 flex items-center">
                            <div @click.away="tagsPanelOpen = false"
                                class="flex items-center w-full rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <input type="search" wire:model.live='tagSearch' autocomplete="off" id="tags"
                                    @focus="tagsPanelOpen = true" @keydown="tagsPanelOpen = true"
                                    @keydown.enter.prevent="$wire.createTag($el.value); $el.value = ''; tagsPanelOpen = false"
                                    class="relative block w-full placeholder:text-sm flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 text-sm sm:leading-6"
                                    placeholder="Buscar etiqueta por nombre...">
                            </div>
                        </div>

                        <div x-show="tagsPanelOpen" x-cloak x-transition
                            class="absolute z-10 mt-2 bg-white min-w-[14rem] rounded shadow-md overflow-y-auto max-h-44">
                            <ul>
                                @forelse ($tags as $tag)
                                    <li wire:key='{{ $tag->id }}' @click="tagsPanelOpen = false"
                                        wire:click='addTag({{ $tag->id }})'
                                        class="text-sm my-2 p-2 transition duration-300 flex items-center 
                                        hover:bg-gray-50 cursor-pointer">
                                        <x-icon code="loyalty" class="mr-1" />
                                        {{ $tag->name }}
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>

                        @if ($selectedTagsModels->isNotEmpty())
                            <div class="mt-3 flex items-center flex-wrap gap-2">
                                @foreach ($selectedTagsModels as $selectedTag)
                                    <x-badge color="blue" icon="sell">

                                        {{ $selectedTag->name }}

                                        <x-icon code="close" x-tooltip.raw.placement.bottom="Eliminar etiqueta"
                                            wire:click='removeTag({{ $selectedTag->id }})'
                                            class="text-sm ml-1 hover:text-red-500 cursor-pointer" />
                                    </x-badge>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            {{-- Measures & stock block --}}
            <section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Dimensiones y stock</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Las dimensiones físicas del producto son datos necesarios para gestionar el envío del pedido.
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    {{-- Stock field --}}
                    <div class="sm:col-span-2 sm:col-start-1">
                        <label for="stock" class="block text-sm font-medium leading-6 text-gray-900">Stock</label>
                        <div class="mt-2">
                            <input wire:model.blur='form.stock' type="number" id="stock" autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                            @error('form.stock')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Weight field --}}
                    <div class="sm:col-span-2">
                        <label for="weight" class="block text-sm font-medium leading-6 text-gray-900">
                            Peso <sup class="text-red-500 -ml-1">*</sup>
                            <x-badge x-tooltip.raw.placement.top="Gramos" color="blue">GR</x-badge>
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.weight' type="number" id="weight" required
                                autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                            @error('form.weight')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Width field --}}
                    <div class="sm:col-span-2 sm:col-start-1">
                        <label for="width" class="block text-sm font-medium leading-6 text-gray-900">
                            Ancho <sup class="text-red-500 -ml-1">*</sup>
                            <x-badge x-tooltip.raw.placement.top="Centímetros" color="blue">CM</x-badge>
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.width' type="number" required id="width"
                                autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                            @error('form.width')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Height field --}}
                    <div class="sm:col-span-2">
                        <label for="height" class="block text-sm font-medium leading-6 text-gray-900">
                            Alto <sup class="text-red-500 -ml-1">*</sup>
                            <x-badge x-tooltip.raw.placement.top="Centímetros" color="blue">CM</x-badge>
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.height' type="number" required id="height"
                                autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                            @error('form.height')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Length field --}}
                    <div class="sm:col-span-2">
                        <label for="length" class="block text-sm font-medium leading-6 text-gray-900">
                            Largo <sup class="text-red-500 -ml-1">*</sup>
                            <x-badge x-tooltip.raw.placement.top="Centímetros" color="blue">CM</x-badge>
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.length' type="number" required id="length"
                                autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                            @error('form.length')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="mt-6 flex items-center justify-between flex-wrap gap-x-6">

            <span class="text-red-500 text-xs flex items-center my-1">
                @if ($errors->any())
                    <x-icon code="error" class="mr-1" /> Hay errores o campos sin completar
                @endif
            </span>

            <x-button wire:loading.remove wire:target='save' submit size="large" class="flex items-center">
                @if ($product)
                    <x-icon code="sync" class="mr-1" />
                    Actualizar producto
                @else
                    <x-icon code="add_circle" class="mr-1" />
                    Crear producto
                @endif
            </x-button>

            <div wire:loading wire:target='save' class="my-1">
                <div class="flex items-center font-semibold">
                    <x-spinner class="mr-2" />
                    Guardando cambios...
                </div>
            </div>

        </div>

    </form>

    {{-- Sortable product images preview --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        new Sortable(previewImages, {
            handle: '.sortable-item',
            animation: 250,
            ghostClass: 'bg-gray-100',
            store: {
                set: (sortable) => Livewire.dispatch('change-images-order', {
                    newOrder: sortable.toArray()
                })
            }
        });
    </script>

</div>
