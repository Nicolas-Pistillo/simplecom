<div>

    <div x-data="{ selected: null, selectedAttribute: null }" class="px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Atributos</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Organizá tus categorías lo más ordenadamente posible. Podés crear hasta un máximo de 3 niveles
                    de categorización.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button wire:click='' @click="selected = null; selectedAttribute = null" 
                class="flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Nuevo atributo
                </x-button>
            </div>
        </div>

        <div class="divide-y bg-gr mb-5 divide-gray-100 overflow-hidden 
        shadow ring-1 ring-gray-900/5 rounded-xl">
            <ul x-cloak role="list">

                @foreach ($attributes as $attribute)
                    <div wire:key='{{ $attribute->id }}'>

                        <li x-data="{ mouseOnAttribute: false }" @click="selectedAttribute = null"
                            @mouseover="mouseOnAttribute = true" @mouseover.away="mouseOnAttribute = false"
                            class="relative flex justify-between  gap-x-6 p-3 sm:px-6 cursor-pointer transition duration-200"
                            :class="selected == {{ $attribute->id }} ? 'bg-gray-50 shadow-md' : 'hover:bg-gray-50'">

                            <div @click="selected !== {{ $attribute->id }} 
                            ? selected = {{ $attribute->id }} 
                            : selected = null"
                            class="flex w-full gap-x-4">

                                <x-icon code="category"
                                class="text-2xl text-gray-600 w-10 h-10 p-1 
                                rounded-full bg-gray-50 text-center shadow" />

                                <p class="text-sm flex items-center font-semibold leading-6 text-gray-900">
                                    {{ $attribute->name }}
                                </p>
                            </div>

                            <div class="flex shrink-0 items-center gap-x-4">

                                {{-- Add value --}}
                                <div x-tooltip.raw.placement.left="Agregar subcategoría">
                                    <x-icon wire:click='openAddSubcategory({{ $attribute->id }})'
                                    x-show="mouseOnAttribute" code="library_add"
                                    @click="selected = {{ $attribute->id }};"
                                    class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
                                    rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                </div>

                                {{-- Edit attribute --}}
                                <div x-tooltip.raw.placement.left="Editar categoría">
                                    <x-icon wire:click='openEditCategory({{ $attribute->id }})' x-show="mouseOnAttribute"
                                        code="edit"
                                        class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
                                        rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                </div>

                                {{-- Delete attribute --}}
                                <div x-tooltip.raw.placement.left="Elminar categoría">
                                    <x-icon x-show="mouseOnAttribute" code="delete" @click="selected = null"
                                        wire:click='openDeleteCategory({{ $attribute->id }})'
                                        class="text-2xl text-red-400 w-8 h-8 p-1 rounded-full flex items-center
                                    bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                </div>

                                {{-- Show values --}}
                                @if ($attribute->hasValues())
                                    <div
                                        x-tooltip.placement.left="selected == {{ $attribute->id }} ? 'Contraer' : 'Ver subcategorías'">
                                        <i @click="selected !== {{ $attribute->id }} ? selected = {{ $attribute->id }} : selected = null"
                                            class="material-symbols-outlined text-gray-600 shadow p-1 rounded-full 
                                            bg-gray-50 transition hover:bg-white cursor-pointer"
                                            x-text="selected == {{ $attribute->id }} ? 'expand_less' : 'expand_more'"></i>
                                    </div>
                                @endif
                            </div>
                        </li>

                        {{-- Attribute values --}}
                        @if ($attribute->hasValues())
                            <div x-show="selected == {{ $attribute->id }}" 
                                x-collapse.duration.500 class="ml-11"
                                :class="selected == {{ $attribute->id }} && 'border-l border-gray-200'">

                                <div class="pl-5">

                                    <h4 class="text-sm font-semibold text-gray-700 my-3">
                                        Valores de {{ $attribute->name }}
                                    </h4>

                                    <div class="flex items-center flex-wrap gap-3 mb-2">

                                        @foreach ($attribute->values as $value)

                                            <x-badge wire:key='{{ $value->id }}' 
                                            class="cursor-default flex items-center"
                                            x-tooltip.raw.placement.top="{{ $value->name }}">
                                                
                                                @if ($attribute->name === 'Color')
                                                    <div class="w-3 h-3 rounded-full mr-1 shadow"
                                                    style="background-color: {{ $value->meta['hexa_value'] }}">
                                                    </div>
                                                @endif
                                                
                                                {{ $value->name }} 
                                            </x-badge>     

                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        @else
                            <div x-show="selected == {{ $value->id }}" x-collapse.duration.300>
                                <h4 class="border-l text-sm font-semibold ml-11 pl-10 text-gray-400 py-3.5">
                                    Sin valores
                                </h4>
                            </div>
                        @endif
                    </div>
                @endforeach

            </ul>
        </div>
    </div>

</div>
