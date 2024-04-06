<div>
    
    <form wire:submit='save' class="pb-6">

        <div class="space-y-12">

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
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <input wire:model.blur='form.name' 
                                autocomplete="off" type="text" id="name" required
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
                                <input wire:model.blur='form.code' 
                                autocomplete="off" type="text" name="code" id="code"
                                class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                            @error('form.code')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Category field --}}
                    <div class="sm:col-span-5">
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

                    {{-- Short description field --}}
                    <div class="col-span-full">
                        <label for="short_description" class="block text-sm font-medium leading-6 text-gray-900">
                            Descripción breve
                        </label>
                        <div class="mt-2">
                            <textarea wire:model.blur='form.short_description' id="short_description" rows="2"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"></textarea>
                        </div>

                        @error('form.short_description')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror

                        @if (!$errors->first('form.short_description'))
                            <span class="mt-1 text-xs leading-6 text-gray-500">
                                Puede contener hasta 100 caracteres como máximo
                            </span>
                        @endif
                    </div>

                    {{-- Description field --}}
                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descripción
                            detallada</label>
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
                                    Puede contener hasta 700 caracteres como máximo
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            </section>

            {{-- Pricing block --}}
            <section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Precio</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        También podes cargar el descuento y configurar las unidades de venta.
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    {{-- Price field --}}
                    <div class="sm:col-span-3">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">
                            Precio <sup class="text-red-500 -ml-1">*</sup>
                        </label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <input wire:model.blur='form.price'
                                autocomplete="off" type="number" id="price" required
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
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">%</span>
                                <input wire:model.blur='form.discount_percent'
                                type="number" max="100" id="discount_percent" autocomplete="off"
                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>

                            @error('form.discount_percent')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Min selling field --}}
                    <div class="sm:col-span-3 sm:col-start-1">
                        <label for="min_selling" class="block text-sm font-medium leading-6 text-gray-900">
                            Compra mínima
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.min_selling'
                            type="number" id="min_selling" autocomplete="off"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                            focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                            @error('form.min_selling')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror

                            @if (!$errors->first('form.min_selling') && !$form->min_selling)
                                <span class="mt-1 text-xs leading-6 text-gray-500">
                                    Por defecto el valor será de 1 unidad
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Max selling field --}}
                    <div class="sm:col-span-3">
                        <label for="max_selling" class="block text-sm font-medium leading-6 text-gray-900">
                            Compra máxima
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.max_selling'
                            type="number" id="max_selling" autocomplete="off"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                            @error('form.max_selling')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror

                            @if (!$errors->first('form.max_selling') && !$form->max_selling)
                                <span class="mt-1 text-xs leading-6 text-gray-500">
                                    Por defecto el límite será el stock
                                </span>
                            @endif
                        </div>
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
                            <input wire:model.blur='form.stock'
                            type="number" id="stock" autocomplete="off"
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
                            Peso <sup class="text-red-500 -ml-1">*</sup> <x-badge color="blue">KG</x-badge>
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.weight'
                            type="number" id="weight" required autocomplete="off"
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
                            Ancho <sup class="text-red-500 -ml-1">*</sup> <x-badge color="blue">CM</x-badge>
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.width'
                            type="number" required id="width" autocomplete="off"
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
                            Alto <sup class="text-red-500 -ml-1">*</sup> <x-badge color="blue">CM</x-badge>
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.height'
                            type="number" required id="height" autocomplete="off"
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
                            Largo <sup class="text-red-500 -ml-1">*</sup> <x-badge color="blue">CM</x-badge>
                        </label>
                        <div class="mt-2">
                            <input wire:model.blur='form.length'
                            type="number" required id="length" autocomplete="off"
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

            {{-- Images block --}}
            <section class="grid grid-cols-1 gap-x-8 gap-y-10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Imagenes</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">We'll always let you know about important changes, but
                        you pick what else you want to hear about.</p>
                </div>

                <div class="max-w-2xl space-y-10 md:col-span-2">

                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                        <div class="sm:col-span-6">

                            <div class="cursor-pointer flex justify-center rounded-lg 
                            border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center">
                                    <x-icon code="photo_library" class="text-gray-400 text-4xl" />
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                        <p class="pl-1">
                                            Arrastra y suelta tus imagenes aquí
                                        </p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>

                            <div class="product-images-preview flex items-center p-2"></div>

                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <x-button submit size="large" class="flex items-center">
                <x-icon code="add_circle" class="mr-1" />
                Crear producto
            </x-button>
        </div>

    </form>

</div>
