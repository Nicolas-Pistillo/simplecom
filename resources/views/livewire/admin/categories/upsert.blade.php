<div>

    <div x-data="{ categoriesDrawerOpen: false, deleteDialogOpen: false, showNotification: false }" 
        x-on:close-drawer.window="categoriesDrawerOpen = false"
        x-on:open-drawer.window="categoriesDrawerOpen = true" x-on:close-delete-dialog.window="deleteDialogOpen = false"
        x-on:open-delete-dialog.window="deleteDialogOpen = true" x-on:open-notification.window="showNotification = true">

        <div x-data="{ selected: null, subcategorySelected: null }" class="px-4 sm:px-6 lg:px-8">

            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Categorías</h1>
                    <p class="mt-2 text-sm text-gray-700">
                        Organizá tus categorías lo más ordenadamente posible. Podés crear hasta un máximo de 3 niveles
                        de categorización.
                    </p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <x-button wire:click='openNewCategory' @click="selected = null; subcategorySelected = null"
                        class="flex items-center">
                        <x-icon code="add" class="mr-1" />
                        Nueva categoría
                    </x-button>
                </div>
            </div>

            <div class="divide-y bg-gr mb-5 divide-gray-100 overflow-hidden 
            shadow ring-1 ring-gray-900/5 sm:rounded-xl">

                <div class="border-b border-gray-200 bg-gray-50 px-4 py-5 sm:px-6">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Búsqueda</h3>
                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 px-2 ring-inset transition duration-300 bg-white
                            ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <input type="search" id="search" wire:model.live='search' autocomplete="off"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-sm
                                text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="Buscar categoría principal por nombre o descripción...">
                            </div>
                        </div>
                    </div>
                </div>

                @if ($categories->isEmpty())

                    @if (!$hasCategories)
                        <div class="text-center pt-8">

                            <img src="{{ URL::to('img/illustrations/data_processing.svg') }}" class="h-64 mx-auto mb-4"
                                alt="no-data-img">

                            <div class="mb-4">
                                <h3 class="mt-2 text-sm font-semibold text-gray-900">Sin categorías</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    <span wire:click='openNewCategory' class="text-blue-500 hover:underline hover:text-blue-600 cursor-pointer">
                                        Crea tu primer categoría
                                    </span> para ver el listado
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="text-center pt-8">

                            <img src="{{ URL::to('img/illustrations/no_data.svg') }}" class="h-32 mx-auto mb-4"
                                alt="no-data-img">

                            <div class="mb-4">
                                <h3 class="mt-2 text-sm font-semibold text-gray-900">No se encontraron resultados</h3>
                                <p class="mt-1 text-sm text-gray-500">Comprueba haber escrito correctamente el nombre de la categoría principal</p>
                            </div>
                        </div>
                    @endif

                @else
                    <ul x-cloak role="list">

                        @foreach ($categories as $category)

                            <div wire:key='{{ $category->id }}'>

                                @include('admin.categories.partials.category-principal-item')

                                {{-- Childs Categories --}}
                                @if ($category->hasChilds())
                                    <div wire:ignore.self x-show="selected == {{ $category->id }}"
                                        x-collapse.duration.500 class="ml-11 cursor-pointer"
                                        :class="selected == {{ $category->id }} && 'border-l border-gray-200'">

                                        <div class="pl-3">

                                            <h4 class="text-sm ml-1 font-semibold text-gray-700 my-3">
                                                Subcategorías de {{ $category->name }}
                                            </h4>

                                            @foreach ($category->childs as $childCategory)
                                                <div wire:key='{{ $childCategory->id }}'>

                                                    @include('admin.categories.partials.category-child-item')

                                                    @if ($childCategory->hasChilds())
                                                        <div wire:ignore.self x-cloak x-collapse.duration.500
                                                            x-show="subcategorySelected == {{ $childCategory->id }}">
                                                            <div class="ml-11 p-3"
                                                                :class="subcategorySelected == {{ $childCategory->id }} &&
                                                                    'border-l border-gray-200'">

                                                                <h4
                                                                    class="text-sm ml-1 font-semibold text-gray-700 mb-2">
                                                                    Subcategorías de {{ $category->name }} >
                                                                    {{ $childCategory->name }}
                                                                </h4>

                                                                @foreach ($childCategory->childs as $grandChild)
                                                                    @include('admin.categories.partials.category-grandchild-item')
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    @else
                                                        <div x-show="subcategorySelected == {{ $childCategory->id }}"
                                                            x-collapse.duration.300 class="cursor-default">
                                                            <h4 class="text-sm border-l ml-12 pl-6 font-semibold text-gray-400 py-3.5">
                                                                Sin subcategorías
                                                            </h4>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                @else
                                    <div x-show="selected == {{ $category->id }}" x-collapse.duration.300>
                                        <h4 class="border-l text-sm font-semibold ml-12 pl-8 text-gray-400 py-3.5">
                                            Sin subcategorías
                                        </h4>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                    </ul>
                @endif
            </div>

            {{ $categories->links() }}

        </div>

        {{-- Delete category modal --}}
        @include('admin.categories.partials.delete-dialog')

        {{-- Create/Edit category drawer --}}
        @include('admin.categories.partials.upsert-form')

        {{-- Success notification toast --}}
        <x-toast ref="showNotification" type="success" title="{{ $notificationMessage }}" />

    </div>

</div>
