<div x-cloak x-show="mobileFiltersOpen" 
class="relative z-40 lg:hidden" role="dialog" aria-modal="true">

    <div x-cloak x-show="mobileFiltersOpen" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-25"></div>

    <div x-cloak x-show="mobileFiltersOpen" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="fixed inset-0 z-40 flex">
        
        <div @click.away="mobileFiltersOpen = false" class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">

            <div class="flex items-center justify-between px-4">
                <div class="flex items-center gap-3">
                    <h2 class="text-lg font-semibold text-gray-900">Filtros</h2>
                    <div wire:loading wire:target='form'>
                        <x-spinner />
                    </div>
                </div>
                <x-icon code="close" @click="mobileFiltersOpen = false" class="text-gray-500" />
            </div>

            <div class="mt-4 border-t border-gray-200">
                <div class="flex flex-col gap-y-6 p-4">

                    {{-- Category Filter --}}
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
                                        <div wire:click='setCategory({{ $category->id }})' 
                                        class="hover:text-blue-600 inline-flex items-center gap-x-1 cursor-pointer"
                                            @if ($category->featured) x-tooltip.raw.placement.right="Destacado" @endif>

                                            {{ $category->name }}

                                            @if ($category->featured)
                                                <x-icon code="local_fire_department" class="text-red-500" />
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    @endif

                    {{-- Collections Filter --}}
                    @if ($available_collections->isNotEmpty())
                        <ul role="list" class="space-y-4 border-b border-gray-200 
                        text-sm font-medium text-gray-900 pb-6">

                            <li>
                                <h6 class="text-base text-gray-700 font-semibold inline-flex 
                                items-center gap-x-1 cursor-default">
                                    Colecciones
                                </h6>
                            </li>
                            
                            @if (!empty($form->collection))
                                <li wire:key='{{ $form->collection->id }}'>
                                    <div wire:click='setCollection({{ $form->collection->id }})'
                                    class="hover:text-blue-600 inline-flex items-center gap-x-2 cursor-pointer">

                                        <span>{{ $form->collection->name }} </span>
                                    </div>
                                </li>

                                <li>
                                    <x-button wire:click='resetCollectionFilter' type="secondary" size="tiny">
                                        Ver todas
                                    </x-button>
                                </li>
                                
                            @else
                                @foreach ($available_collections as $collection)

                                    <li wire:key='{{ $collection->id }}'>
                                        <div wire:click='setCollection({{ $collection->id }})'
                                        class="hover:text-blue-600 inline-flex items-center gap-x-2 cursor-pointer">
                                            <span>{{ $collection->name }} </span>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    @endif

                    {{-- Brand filter --}}
                    @if (!empty($available_brands) && $available_brands->first())
                        <ul role="list" class="space-y-4 border-b border-gray-200 
                        text-sm font-medium text-gray-900 pb-6">

                            <li>
                                <h6 class="text-base text-gray-700 font-semibold inline-flex 
                                items-center gap-x-1 cursor-default">
                                    Marcas
                                </h6>
                            </li>   

                            @foreach ($available_brands->sortByDesc('featured') as $brand)

                                @if (!isset($brand->id)) @continue @endif

                                <li wire:key='{{ $brand->id }}'>
                                    <div wire:click='setBrand({{ $brand->id }})'
                                    class="hover:text-blue-600 inline-flex items-center gap-x-2 cursor-pointer">

                                        @if (!empty($brand->image_url))
                                            <img src="{{ Storage::url($brand->image_url) }}" alt="{{ $brand->name }}"
                                            class="w-6 h-6 rounded-full object-contain">
                                        @endif

                                        <span>{{ $brand->name }} </span>
                                    </div>
                                </li>
                            @endforeach

                            @if (!empty($form->brand))
                                <li>
                                    <x-button wire:click='resetBrandFilter' type="secondary" size="tiny">
                                        Ver todas
                                    </x-button>
                                </li>
                                
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
                </div>
            </div>

            <div class="mt-auto flex items-center justify-end px-6">
                <x-button size="large" @click="mobileFiltersOpen = false">
                    Aceptar
                </x-button>
            </div>
        </div>
    </div>
</div>
