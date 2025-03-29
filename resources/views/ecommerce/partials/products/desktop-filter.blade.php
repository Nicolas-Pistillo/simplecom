<section class="hidden lg:flex flex-col gap-y-6">

    {{-- Context-Categories Filter --}}
    @if ((isset($form->category) && $form->category->childs->isNotEmpty()) || 
    (!isset($form->category) && $principal_categories->isNotEmpty()))
        <ul role="list" class="space-y-4 border-b border-gray-200 
        text-sm font-medium text-gray-900 pb-6">

            <li>
                <h6 class="text-base text-gray-700 font-semibold inline-flex 
                items-center gap-x-1 cursor-default">
                    Categorías
                </h6>
            </li>   

            @if (!$this->form->category)
                @foreach ($principal_categories->sortByDesc('featured') as $category)
                    <li wire:key='{{ $category->id }}'>
                        <h6 wire:click='setCategory({{ $category->id }})' 
                        class="hover:text-blue-600 inline-flex items-center gap-x-1 cursor-pointer"
                            @if ($category->featured) x-tooltip.raw.placement.right="Destacado" @endif>

                            {{ $category->name }}

                            @if ($category->featured)
                                <x-icon code="local_fire_department" class="text-red-500" />
                            @endif
                        </h6>
                    </li>
                @endforeach
            @else
                @foreach ($form->category->childs->sortByDesc('featured') as $category)
                    <li wire:key='{{ $category->id }}'>
                        <h6 wire:click='setCategory({{ $category->id }})' 
                        class="hover:text-blue-600 inline-flex items-center gap-x-1 cursor-pointer"
                            @if ($category->featured) x-tooltip.raw.placement.right="Destacado" @endif>

                            {{ $category->name }}

                            @if ($category->featured)
                                <x-icon code="local_fire_department" class="text-red-500" />
                            @endif
                        </h6>
                    </li>
                @endforeach
            @endif
        </ul>
    @endif
    
    {{-- Price filter --}}
    <div x-data="{ open: true }" class="border-b border-gray-200 pb-6">

        <h3 class="-my-3 flow-root">
            <button type="button" @click="open = !open"
                class="flex w-full items-center justify-between 
                    bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                aria-controls="filter-section-0" aria-expanded="false">
                <span class="font-medium text-gray-900">Precio</span>
                <span class="ml-6 flex items-center">

                    <x-icon x-show="!open" x-cloak code="expand_more" />

                    <x-icon x-show="open" x-cloak code="expand_less" />

                </span>
            </button>
        </h3>
        
        <div x-show="open" x-cloak x-collapse.duration.300 class="pt-4">
            
            <div class="flex gap-x-3 mb-2">

                <div>
                    <label for="filt_min_price" class="block text-xs font-medium 
                    text-gray-900">
                        Precio mínimo
                    </label>
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                            <span class="flex select-none items-center pl-3 text-gray-500 text-xs">$</span>
                            <input wire:model='form.min_price' autocomplete="off" type="number" id="filt_min_price" 
                            class="w-2/5 form-input flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 
                            placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                        </div>                        
                    </div>
                </div>
                
                <div>
                    <label for="filt_max_price" class="block text-xs font-medium 
                    text-gray-900">
                        Precio máximo
                    </label>
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                            <span class="flex select-none items-center pl-3 text-gray-500 text-xs">$</span>
                            <input wire:model='form.max_price' autocomplete="off" type="number" id="filt_max_price" 
                            class="w-2/5 block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 
                            placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <x-button @click="$wire.$refresh()" type="soft" size="tiny" class="flex items-center gap-x-0.5">
                    Aplicar
                    <x-icon code="arrow_forward" class="text-sm" />
                </x-button>
    
                @if (!empty($form->min_price) || !empty($form->max_price))
                    <x-button wire:click='resetPriceFilter' type="secondary" size="tiny">
                        Reiniciar
                    </x-button>
                @endif
            </div>

        </div>
    </div>

    {{-- Attribute filter --}}
    <div x-data="{ open: true }" class="border-b border-gray-200 pb-6">
        <h3 class="-my-3 flow-root">
            <!-- Expand/collapse section button -->
            <button type="button" @click="open = !open"
                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                aria-controls="filter-section-0" aria-expanded="false">
                <span class="font-medium text-gray-900">Color</span>
                <span class="ml-6 flex items-center">

                    <x-icon x-show="!open" x-cloak code="expand_more" />

                    <x-icon x-show="open" x-cloak code="expand_less" />

                </span>
            </button>
        </h3>
        <!-- Filter section, show/hide based on section state. -->
        <div x-show="open" x-cloak x-collapse.duration.300 class="pt-6">
            <div class="space-y-4">
                <div class="flex items-center">
                    <input id="filter-color-0" name="color[]" value="white" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-0"
                        class="ml-3 text-sm text-gray-600">White</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-1" name="color[]" value="beige" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-1"
                        class="ml-3 text-sm text-gray-600">Beige</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-2" name="color[]" value="blue" type="checkbox"
                        checked
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-2"
                        class="ml-3 text-sm text-gray-600">Blue</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-3" name="color[]" value="brown" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-3"
                        class="ml-3 text-sm text-gray-600">Brown</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-4" name="color[]" value="green" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-4"
                        class="ml-3 text-sm text-gray-600">Green</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-5" name="color[]" value="purple" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-5"
                        class="ml-3 text-sm text-gray-600">Purple</label>
                </div>
            </div>
        </div>
    </div>
</section>