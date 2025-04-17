<div>
    <div class="grid grid-cols-1 gap-x-8 gap-y-10 pb-8 md:grid-cols-3">

        <div>
            <x-button href="{{ route('admin.collections.index') }}" type="secondary" class="inline-flex items-center">
                <x-icon code="arrow_back" class="mr-1" />
                Volver al listado
            </x-button>
        </div>

        <h2 class="text-2xl col-span-2 font-bold leading-7 text-gray-900 sm:text-3xl sm:tracking-tight">
            {{ $collection ? $collection->name : 'Nueva coleccion' }}
        </h2>

    </div>

    <form wire:submit='save' class="pb-6">
        <div class="space-y-12">

            <div class="grid grid-cols-1 space-y-4 md:space-y-0 gap-x-8 border-gray-900/10 md:grid-cols-3">
                <x-switch wireModel='active' :label="$collection ? 'Publicar' : 'Publicar al finalizar'" />
            </div>

            <section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">

                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Presentación</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Información breve que describa la coleccion
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">


                    <div class="sm:col-span-6">
                        <label class="block text-sm font-medium leading-6 text-gray-900">
                            Imágen
                        </label>
                        <div class="flex items-center gap-6 mt-2">

                            <img src="{{ $image_preview ?? 'http://placehold.co/400x400' }}"
                                alt="imágen de la colección" class="h-36 w-48 object-cover rounded-lg">

                            <div wire:loading.remove wire:target='image'>
                                <x-button type="secondary" wireModel="image" name="collecion_image"
                                    file>Seleccionar</x-button>
                                <span class="block text-xs text-gray-500 mt-2">
                                    Medidas óptimas: 400x400 <br>
                                    No uses imágenes con textos incluidos
                                </span>
                            </div>

                            <div>
                                <x-spinner wire:loading wire:target='image' />
                            </div>
                        </div>

                        @error('image')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <x-form-input model="name" label="Nombre" placeholder="Ej: Especial primavera" />

                        @if (!$errors->first('name'))
                            <span class="mt-1 text-xs leading-6 text-gray-500">
                                Hasta 35 caracteres como máximo
                            </span>
                        @endif
                    </div>

                    <div class="sm:col-span-5">

                        <x-form-input model="description" label="Descripción breve"
                        placeholder="Ej: Encontrá tu conjunto ideal para esta época" />

                        @if (!$errors->first('description'))
                            <span class="mt-1 text-xs leading-6 text-gray-500">
                                Hasta 75 caracteres como máximo
                            </span>
                        @endif
                    </div>

                </div>
            </section>

            <section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">

                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Productos</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Buscá y seleccioná los productos que formarán parte de la coleccion
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    <div x-data="{searchPanelOpen: true}" @click.away="searchPanelOpen = false" class="sm:col-span-4">
                        <div>
                            <label for="product_search" class="inline-block text-sm font-medium leading-6 text-gray-900 mb-2">
                                Buscar producto
                            </label>
                            <div class="relative">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 
                                focus-within:ring-inset focus-within:ring-blue-600">
                        
                                    <input id="product_search" type="search"
                                    @focus="searchPanelOpen = true" autocomplete="off"
                                    wire:model.live.debounce.250ms='search'
                                    placeholder="{{ $placeholder ?? '' }}"
                                    class="block w-full flex-1 border-0 bg-transparent py-1.5 px-2.5 text-gray-900 
                                    placeholder:text-gray-400 focus:ring-0 text-sm leading-6">

                                </div>

                                @error('selected_products')
                                    <small class="text-red-500 mt-1">{{ $message }}</small>
                                @enderror

                                @if (!empty($search))
                                <div x-show="searchPanelOpen" class="absolute top-10 left-0 w-full 
                                rounded-md shadow-lg">
                                    <ul role="list" class="divide-y divide-gray-100 rounded-lg overflow-hidden">
                                        @forelse ($product_results as $product)
                                            <li wire:key="{{ $product->id }}" @click="searchPanelOpen = false"
                                            wire:click='addProduct({{ $product->id }})' 
                                            class="flex justify-between items-center gap-x-6 p-2 cursor-pointer 
                                            bg-white hover:bg-gray-50">
                                                <div class="flex min-w-0 gap-x-4">
                                                    <img class="w-10 h-10 flex-none rounded-lg bg-gray-50"
                                                        src="{{ $product->first_image }}"
                                                        alt="{{ $product->name }}">
                                                    <div class="min-w-0 flex-auto line-clamp-2">
                                                        <p class="text-sm/6 font-semibold text-gray-900">
                                                            {{ $product->name }}
                                                        </p>
                                                        <p class="mt-1 truncate text-xs/5 text-gray-500">
                                                            {{ $product->category->name }} - Stock: {{ $product->stock }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="shrink-0 flex flex-col items-end">
                                                    <small class="text-xs text-gray-500 cursor-pointer">
                                                        #{{ $product->id }}
                                                    </small>
                                                </div>
                                            </li>
                                        @empty
                                            <div class="text-center p-4 text-sm bg-white text-gray-500 font-semibold">
                                                Sin resultados
                                            </div>
                                        @endforelse
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">

                        <div wire:loading wire:target='addProduct, selected_products'>
                            <div class="flex items-center gap-1.5 text-sm mb-2">
                                Agregando producto <x-spinner spinnerclass="!w-4 !h-4"/>
                            </div>
                        </div>

                        <ul role="list" class="divide-y divide-gray-100">
                            @forelse ($this->selectedProductModels as $product)
                                <li wire:key="{{ $product->id }}"
                                class="flex justify-between items-center gap-x-6 p-2">
                                    <div class="flex min-w-0 gap-x-4">
                                        <img class="w-10 h-10 flex-none rounded-lg bg-gray-50"
                                            src="{{ $product->first_image }}"
                                            alt="{{ $product->name }}">
                                        <div class="min-w-0 flex-auto line-clamp-2">
                                            <p class="text-sm/6 font-semibold text-gray-900">
                                                {{ $product->name }}
                                            </p>
                                            <p class="mt-1 truncate text-xs/5 text-gray-500">
                                                #{{ $product->id }} - 
                                                {{ $product->category->name }} - 
                                                Stock: {{ $product->stock }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="shrink-0 flex flex-col items-end">
                                        <small wire:click='removeProduct({{ $product->id }})' 
                                        class="text-xs text-red-500 cursor-pointer">
                                            Quitar
                                        </small>
                                    </div>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
            </section>
        </div>

        <div class="mt-6 text-right flex items-center justify-end">

            <x-button wire:loading.remove wire:target='save' submit size="large">
                Guardar coleccion
            </x-button>

            <div wire:loading wire:target='save'>
                <div class="flex items-center gap-2 text-sm font-semibold">
                    Guardando...
                    <x-spinner />
                </div>
            </div>
        </div>
    </form>
</div>
