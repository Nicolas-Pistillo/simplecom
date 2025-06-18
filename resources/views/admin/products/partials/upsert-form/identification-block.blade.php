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
                @else
                    <small class="mt-1 text-xs text-gray-500">¿No creaste la categoría? podes 
                        <a href="{{ route('admin.categories.index') }}"
                        class="text-blue-500 hover:underline">crearla acá</a>
                    </small>
                @enderror
            </div>
        </div>

        {{-- Brand field --}}
        <div x-data="{brandPanelOpen: false}" @click.away="brandPanelOpen = false" class="sm:col-span-3">
            <label for="brands" class="flex items-center text-sm font-medium leading-6 text-gray-900">
                Marca
            </label>

            <div class="mt-2 flex items-center">
                <div class="flex items-center w-full rounded-md shadow-sm sm:max-w-md ring-gray-300 ring-1 ring-inset
                {{ !$selectedBrand ? 'focus-within:ring-blue-600 focus-within:ring-2 focus-within:ring-inset' : '' }}">

                    @if ($selectedBrand)
                        <img class="ml-2 rounded-full w-6 h-6 object-contain" 
                        src="{{ !empty($selectedBrand->image_url) ? Storage::url($selectedBrand->image_url) : URL::to('img/brand-placeholder.jpg') }}" />

                        <input type="text" readonly value="{{ $selectedBrand->name }}"
                        class="relative block w-full placeholder:text-sm flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 focus:ring-0 text-sm sm:leading-6">

                        <x-icon code="delete" x-tooltip.raw.placement.top="Desvincular marca"
                        wire:click='removeBrand' 
                        class="ml-auto mr-1 cursor-pointer text-red-500" />
                    @else

                        <input type="text" readonly autocomplete="off" id="brands"
                        @click="brandPanelOpen = !brandPanelOpen"
                        class="relative no-select block w-full placeholder:text-gray-900 cursor-default placeholder:text-sm flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 focus:ring-0 text-sm sm:leading-6"
                        placeholder="Seleccionar una marca...">

                        <x-icon code="expand_more" class="mr-1 text-gray-500" />

                        <x-spinner wire:loading wire:target='selectBrand'
                        class="ml-auto mr-1" />
                    @endif
                </div>
            </div>

            <div x-show="brandPanelOpen" x-cloak x-transition
            class="absolute z-10 mt-2 bg-white min-w-[14rem] rounded 
            shadow-md overflow-y-auto max-h-52">
                <ul>
                    @forelse ($brands as $brand)
                        <li wire:key='{{ $brand->id }}' @click="brandPanelOpen = false"
                        wire:click="selectBrand('{{ $brand->id }}')"
                        class="text-sm my-2 p-2 flex items-center hover:bg-gray-100 cursor-pointer">

                            <img src="{{ !empty($brand->image_url) ? Storage::url($brand->image_url) : URL::to('img/brand-placeholder.jpg') }}" 
                            class="h-6 w-6 mr-2 rounded-full object-contain" alt="brand-logo">

                            {{ $brand->name }}
                        </li>
                    @empty
                        <li @click="brandPanelOpen = false"
                        class="text-sm my-2 p-2 text-center cursor-pointer">
                            Aún no registraste marcas
                        </li>
                    @endforelse
                </ul>
            </div>

            <span class="mt-1 text-xs text-gray-500">
                ¿No se encuentra tu marca? 
                <a class="text-blue-500 hover:underline" href="{{ route('admin.brands.index') }}">
                    registrala acá.
                </a>
            </span>                        
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