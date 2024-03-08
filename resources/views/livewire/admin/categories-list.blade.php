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
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button>Crear categoría</x-button>
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
                                        data-tooltip-placement="left" @click="selected = {{ $categoryReference }}"
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

                                {{-- <div class="relative z-50" role="dialog" aria-modal="true">
                                    <!--
                                    Background backdrop, show/hide based on slide-over state.
                                
                                    Entering: "ease-in-out duration-500"
                                        From: "opacity-0"
                                        To: "opacity-100"
                                    Leaving: "ease-in-out duration-500"
                                        From: "opacity-100"
                                        To: "opacity-0"
                                    -->
                                    <div class="fixed inset-0 bg-gray-700 bg-opacity-60 transition-opacity"></div>

                                    <div class="fixed inset-0 cursor-default overflow-hidden">
                                        <div class="absolute inset-0 overflow-hidden">
                                            <div
                                                class="fixed inset-y-0 right-0 flex max-w-full pl-10">
                                                <!--
                                                    Slide-over panel, show/hide based on slide-over state.
                                        
                                                    Entering: "transform transition ease-in-out duration-500 sm:duration-700"
                                                    From: "translate-x-full"
                                                    To: "translate-x-0"
                                                    Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
                                                    From: "translate-x-0"
                                                    To: "translate-x-full"
                                                -->
                                                <div class="pointer-events-auto relative w-96">
                                                    <!--
                                                        Close button, show/hide based on slide-over state.
                                            
                                                        Entering: "ease-in-out duration-500"
                                                            From: "opacity-0"
                                                            To: "opacity-100"
                                                        Leaving: "ease-in-out duration-500"
                                                            From: "opacity-100"
                                                            To: "opacity-0"
                                                        -->
                                                    <div
                                                        class="absolute left-0 top-0 -ml-8 flex pr-2 pt-4 sm:-ml-10 sm:pr-4">
                                                        <button type="button"
                                                            class="relative rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                                                            <span class="absolute -inset-2.5"></span>
                                                            <span class="sr-only">Close panel</span>
                                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                                stroke-width="1.5" stroke="currentColor"
                                                                aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <!-- Slide-over panel, show/hide based on slide-over state. -->
                                                    <div class="h-full cursor-default overflow-y-auto bg-white p-8">
                                                        <div class="space-y-6 pb-16">
                                                            <div>
                                                                <div
                                                                    class="aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg">
                                                                    <img src="https://images.unsplash.com/photo-1582053433976-25c00369fc93?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=512&q=80"
                                                                        alt="" class="object-cover">
                                                                </div>
                                                                <div class="mt-4 flex items-start justify-between">
                                                                    <div>
                                                                        <h2
                                                                            class="text-base font-semibold leading-6 text-gray-900">
                                                                            <span class="sr-only">Details for
                                                                            </span>IMG_4985.HEIC</h2>
                                                                        <p class="text-sm font-medium text-gray-500">3.9
                                                                            MB</p>
                                                                    </div>
                                                                    <button type="button"
                                                                        class="relative ml-4 flex h-8 w-8 items-center justify-center rounded-full bg-white text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                                        <span class="absolute -inset-1.5"></span>
                                                                        <svg class="h-6 w-6" fill="none"
                                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                                            stroke="currentColor" aria-hidden="true">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                                        </svg>
                                                                        <span class="sr-only">Favorite</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h3 class="font-medium text-gray-900">Information</h3>
                                                                <dl
                                                                    class="mt-2 divide-y divide-gray-200 border-b border-t border-gray-200">
                                                                    <div
                                                                        class="flex justify-between py-3 text-sm font-medium">
                                                                        <dt class="text-gray-500">Uploaded by</dt>
                                                                        <dd class="text-gray-900">Marie Culver</dd>
                                                                    </div>
                                                                    <div
                                                                        class="flex justify-between py-3 text-sm font-medium">
                                                                        <dt class="text-gray-500">Created</dt>
                                                                        <dd class="text-gray-900">June 8, 2020</dd>
                                                                    </div>
                                                                    <div
                                                                        class="flex justify-between py-3 text-sm font-medium">
                                                                        <dt class="text-gray-500">Last modified</dt>
                                                                        <dd class="text-gray-900">June 8, 2020</dd>
                                                                    </div>
                                                                    <div
                                                                        class="flex justify-between py-3 text-sm font-medium">
                                                                        <dt class="text-gray-500">Dimensions</dt>
                                                                        <dd class="text-gray-900">4032 x 3024</dd>
                                                                    </div>
                                                                    <div
                                                                        class="flex justify-between py-3 text-sm font-medium">
                                                                        <dt class="text-gray-500">Resolution</dt>
                                                                        <dd class="text-gray-900">72 x 72</dd>
                                                                    </div>
                                                                </dl>
                                                            </div>
                                                            <div>
                                                                <h3 class="font-medium text-gray-900">Description</h3>
                                                                <div class="mt-2 flex items-center justify-between">
                                                                    <p class="text-sm italic text-gray-500">Add a
                                                                        description to this image.</p>
                                                                    <button type="button"
                                                                        class="relative -mr-2 flex h-8 w-8 items-center justify-center rounded-full bg-white text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                                        <span class="absolute -inset-1.5"></span>
                                                                        <svg class="h-5 w-5" viewBox="0 0 20 20"
                                                                            fill="currentColor" aria-hidden="true">
                                                                            <path
                                                                                d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                                                                        </svg>
                                                                        <span class="sr-only">Add description</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h3 class="font-medium text-gray-900">Shared with</h3>
                                                                <ul role="list"
                                                                    class="mt-2 divide-y divide-gray-200 border-b border-t border-gray-200">
                                                                    <li class="flex items-center justify-between py-3">
                                                                        <div class="flex items-center">
                                                                            <img src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=1024&h=1024&q=80"
                                                                                alt=""
                                                                                class="h-8 w-8 rounded-full">
                                                                            <p
                                                                                class="ml-4 text-sm font-medium text-gray-900">
                                                                                Aimee Douglas</p>
                                                                        </div>
                                                                        <button type="button"
                                                                            class="ml-6 rounded-md bg-white text-sm font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Remove<span
                                                                                class="sr-only"> Aimee
                                                                                Douglas</span></button>
                                                                    </li>
                                                                    <li class="flex items-center justify-between py-3">
                                                                        <div class="flex items-center">
                                                                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=oilqXxSqey&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                                                alt=""
                                                                                class="h-8 w-8 rounded-full">
                                                                            <p
                                                                                class="ml-4 text-sm font-medium text-gray-900">
                                                                                Andrea McMillan</p>
                                                                        </div>
                                                                        <button type="button"
                                                                            class="ml-6 rounded-md bg-white text-sm font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Remove<span
                                                                                class="sr-only"> Andrea
                                                                                McMillan</span></button>
                                                                    </li>
                                                                    <li class="flex items-center justify-between py-2">
                                                                        <button type="button"
                                                                            class="group -ml-1 flex items-center rounded-md bg-white p-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                                            <span
                                                                                class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-dashed border-gray-300 text-gray-400">
                                                                                <svg class="h-5 w-5"
                                                                                    viewBox="0 0 20 20"
                                                                                    fill="currentColor"
                                                                                    aria-hidden="true">
                                                                                    <path
                                                                                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                                                </svg>
                                                                            </span>
                                                                            <span
                                                                                class="ml-4 text-sm font-medium text-indigo-600 group-hover:text-indigo-500">Share</span>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="flex">
                                                                <button type="button"
                                                                    class="flex-1 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Download</button>
                                                                <button type="button"
                                                                    class="ml-3 flex-1 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
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
