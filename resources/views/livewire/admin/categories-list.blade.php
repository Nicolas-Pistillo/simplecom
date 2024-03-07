<div>

    <div class="px-4 sm:px-6 lg:px-8">
    
        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Categorias</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Las categorías son subjetivas, sirven para organizar la clasificación
                    de tus productos. Puedes anidar subcategorías a un categoría principal.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button>Crear categoría</x-button>
            </div>
        </div>

        @if ($categories->isEmpty())

            <div class="text-center mt-28">
                <img src="{{ URL::to('img/illustrations/data_processing.svg') }}" 
                class="h-64 mx-auto mb-4" alt="no-data-img">

                <div class="mb-4">
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Sin categorías</h3>
                    <p class="mt-1 text-sm text-gray-500">Crea tu primer categoría para ver el listado</p>
                </div>
            </div>

        @else
            <ul x-data="{selected: null}" role="list" class="divide-y divide-gray-100 overflow-hidden shadow ring-1 ring-gray-900/5 sm:rounded-xl">

                @foreach ($categories as $category)
                @php
                    $categoryReference = $category->id;
                @endphp

                    <div wire:key='{{ $categoryReference }}'>

                        {{-- Pricipal Category --}}
                        <li @click="selected !== {{ $categoryReference }} ? selected = {{ $categoryReference }} : selected = null" class="relative flex
                        justify-between  gap-x-6 p-3 sm:px-6 cursor-pointer transition hover:bg-gray-50">

                            <div class="flex min-w-0 gap-x-4">

                                <x-icon code="sticky_note_2" class="text-2xl text-gray-600 w-10 h-10 p-1 
                                rounded-full bg-gray-50 text-center shadow" />

                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">
                                        {{ $category->name }}
                                    </p>
                                    <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                        {{ $category->description ?? 'Sin descripción' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex shrink-0 items-center gap-x-4">

                                <x-icon code="note_stack_add" data-tooltip-target="add_subcategory_{{ $categoryReference }}"
                                data-tooltip-placement="left"
                                class="text-xl text-gray-600 w-8 h-8 p-1 
                                rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                <x-tooltip id="add_subcategory_{{ $categoryReference }}">Añadir subcategoría</x-tooltip>

                                @if($category->childs->isNotEmpty())
                                    
                                    <i class="material-symbols-outlined 
                                    text-gray-600 shadow p-1 rounded-full bg-gray-50 transition hover:bg-white cursor-pointer"
                                    data-tooltip-target="expand_category_{{ $categoryReference }}" data-tooltip-placement="left" 
                                    x-text="selected == {{ $categoryReference }} ? 'expand_less' : 'expand_more'"></i>

                                    <x-tooltip id="expand_category_{{ $categoryReference }}" x-text="selected == {{ $categoryReference }} ? 'Contraer' : 'Ver subcategorías'"></x-tooltip>
                                @endif                                    
                            </div>  

                        </li>

                        {{-- Childs Categories --}}
                        @if ($category->childs->isNotEmpty())

                            <div x-show="selected == {{ $categoryReference }}" x-collapse.duration.500 
                            class="ml-24">

                                <h4 class="text-sm font-semibold text-gray-700 my-1.5">Subcategorías</h4>

                                @foreach ($category->childs as $childCategory)

                                    <li class="relative flex justify-between gap-x-6 p-3 
                                    transition duration-200 hover:bg-gray-50 hover:shadow-md sm:px-6 rounded-l-md">

                                        <div class="flex min-w-0 gap-x-4">

                                            <x-icon code="note_stack" class="text-2xl text-gray-600 w-10 h-10 p-1 
                                            rounded-full bg-gray-50 text-center shadow" />

                                            <div class="min-w-0 flex-auto">
                                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                                    {{ $childCategory->name }}
                                                </p>
                                                <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                                    {{ $childCategory->description ?? 'Sin descripción' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex shrink-0 items-center gap-x-4">

                                            <x-icon code="edit" data-tooltip-target="edit_subcategory_{{ $categoryReference }}"
                                            data-tooltip-placement="left" 
                                            class="text-xl text-gray-600 w-8 h-8 p-1 
                                            rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                            <x-tooltip id="edit_subcategory_{{ $categoryReference }}">Editar</x-tooltip>

                                            <x-icon code="delete" data-tooltip-target="delete_subcategory_{{ $categoryReference }}"
                                            data-tooltip-placement="left"
                                            class="text-xl text-red-400 w-8 h-8 p-1 rounded-full 
                                            bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                            <x-tooltip id="delete_subcategory_{{ $categoryReference }}">Elminar subcategoría</x-tooltip>

                                        </div>
                                    </li>
                                    
                                @endforeach

                            </div>      

                        @endif

                    </div>

                @endforeach
                  
            </ul>
        @endif

    </div>

</div>
