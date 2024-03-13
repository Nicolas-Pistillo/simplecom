<div>

    <div class="px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Categorias</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Las categorías son subjetivas, sirven para organizar la clasificación
                    de tus productos. Puedes agregar subcategorías a un categoría principal.
                </p>
            </div>
            <div x-data="{addCategoryPanelOpen: false}" class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">

                <x-button @click="addCategoryPanelOpen = true">Crear categoría</x-button>

                <x-drawer ref="addCategoryPanelOpen">
                    @livewire('admin.categories.upsert', ['drawerRef' => 'addCategoryPanelOpen'])
                </x-drawer>
            </div>
        </div>

        @if ($categories->isEmpty())

            <div class="text-center mt-28">
                <img src="{{ URL::to('img/illustrations/data_processing.svg') }}" class="h-64 mx-auto mb-4"
                    alt="no-data-img">

                <div class="mb-4">
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Sin categorías</h3>
                    <p class="mt-1 text-sm text-gray-500">Crea tu primer categoría para ver el listado</p>
                </div>
            </div>
        @else
            <div class="divide-y bg-gr mb-5 divide-gray-100 overflow-hidden shadow ring-1 ring-gray-900/5 sm:rounded-xl">

                <div class="border-b border-gray-200 bg-gray-50 px-4 py-5 sm:px-6">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Búsqueda</h3>
                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 px-2 ring-inset transition duration-300 bg-white
                          ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <input type="search" id="search"
                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 
                                text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                placeholder="Buscar por nombre o descripción...">
                            </div>
                        </div>
                    </div>
                </div>

                <ul x-data="{ selected: null }" x-cloak role="list" class="">

                    @foreach ($categories as $category)
                        @php
                            $categoryReference = $category->id;
                        @endphp

                        <div wire:key='{{ $categoryReference }}' x-data="{ mouseOnCategory: false }" x-cloak
                            @mouseover="mouseOnCategory = true" @mouseover.away = "mouseOnCategory = false"
                            :class="selected == {{ $categoryReference }} ? 'border border-blue-200' : ''">

                            {{-- Pricipal Category --}}
                            <li class="relative flex justify-between  gap-x-6 p-3 sm:px-6 cursor-pointer 
                            transition hover:bg-gray-50">

                                <div @click="selected !== {{ $categoryReference }} ? selected = {{ $categoryReference }} : selected = null"
                                class="flex w-full gap-x-4">

                                    <x-icon code="sticky_note_2"
                                    class="text-2xl text-gray-600 w-10 h-10 p-1 
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

                                    {{-- Add subcategory --}}
                                    <x-icon x-show="mouseOnCategory" code="library_add"
                                    data-tooltip-target="add_subcategory_{{ $categoryReference }}"
                                    data-tooltip-placement="left" @click="selected = {{ $categoryReference }};"
                                    class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
                                    rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                    <x-tooltip id="add_subcategory_{{ $categoryReference }}">Agregar
                                        subcategoría</x-tooltip>

                                    {{-- Edit category --}}
                                    <x-icon x-show="mouseOnCategory" code="edit"
                                        data-tooltip-target="edit_category_{{ $categoryReference }}"
                                        data-tooltip-placement="left"
                                        class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
                                    rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                    <x-tooltip id="edit_category_{{ $categoryReference }}">Editar categoría</x-tooltip>

                                    {{-- Show subcategories --}}
                                    @if ($category->childs->isNotEmpty())
                                        <i @click="selected !== {{ $categoryReference }} ? selected = {{ $categoryReference }} : selected = null"
                                            class="material-symbols-outlined
                                        text-gray-600 shadow p-1 rounded-full bg-gray-50 transition hover:bg-white cursor-pointer"
                                            data-tooltip-target="expand_category_{{ $categoryReference }}"
                                            data-tooltip-placement="left"
                                            x-text="selected == {{ $categoryReference }} ? 'expand_less' : 'expand_more'"></i>

                                        <x-tooltip id="expand_category_{{ $categoryReference }}"
                                            x-text="selected == {{ $categoryReference }} ? 'Contraer' : 'Ver subcategorías'"></x-tooltip>
                                    @endif
                                </div>
                            </li>

                            {{-- Childs Categories --}}
                            @if ($category->childs->isNotEmpty())
                                <div x-show="selected == {{ $categoryReference }}" x-collapse.duration.500 class="ml-10"
                                :class="selected == {{ $categoryReference }} && 'border-l border-gray-200'">

                                    <div class="pl-3">
                                        <h4 class="text-sm ml-6 font-semibold text-gray-700 my-1.5">Subcategorías</h4>

                                        @foreach ($category->childs as $childCategory)
                                            <li x-data="{ mouseOnSubCategory: false }" @mouseover="mouseOnSubCategory = true"
                                                @mouseover.away = "mouseOnSubCategory = false"
                                                class="relative flex justify-between gap-x-6 p-3 
                                            transition duration-200 hover:bg-gray-50 hover:shadow sm:px-6 rounded-l-md">
    
                                                <div class="flex min-w-0 gap-x-4">
    
                                                    <x-icon code="library_books"
                                                        class="text-2xl text-gray-600 w-10 h-10 p-1 
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
    
                                                    {{-- Edit subcategory --}}
                                                    <x-icon x-show="mouseOnSubCategory" code="edit"
                                                        data-tooltip-target="edit_subcategory_{{ $categoryReference }}"
                                                        data-tooltip-placement="left"
                                                        class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
                                                    rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                                    <x-tooltip id="edit_subcategory_{{ $categoryReference }}">Editar
                                                        subcategoría</x-tooltip>
    
                                                    {{-- Delete subcategory --}}
                                                    <x-icon x-show="mouseOnSubCategory" code="delete"
                                                        data-tooltip-target="delete_subcategory_{{ $categoryReference }}"
                                                        data-tooltip-placement="left"
                                                        class="text-2xl text-red-400 w-8 h-8 p-1 rounded-full flex items-center
                                                    bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                                    <x-tooltip id="delete_subcategory_{{ $categoryReference }}">Elminar
                                                        subcategoría</x-tooltip>
    
                                                </div>
                                            </li>
                                        @endforeach
                                    </div>

                                </div>
                            @else
                                <div x-show="selected == {{ $categoryReference }}" x-collapse.duration.300 class="ml-10">
                                    <h4 class="text-sm ml-6 font-semibold text-gray-400 my-3">Sin subcategorías</h4>
                                </div>
                            @endif

                        </div>
                    @endforeach

                </ul>
            </div>

            {{ $categories->links() }}

        @endif

    </div>

</div>
