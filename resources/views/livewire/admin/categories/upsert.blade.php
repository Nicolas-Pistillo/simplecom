<div>

    <div x-data="{ categoriesDrawerOpen: false, deleteDialogOpen: false, showNotification: false }" 
        x-on:close-drawer.window="categoriesDrawerOpen = false"
        x-on:open-drawer.window="categoriesDrawerOpen = true" x-on:close-cancel-dialog.window="deleteDialogOpen = false"
        x-on:open-cancel-dialog.window="deleteDialogOpen = true"
        x-on:open-notification.window="showNotification = true">

        <div class="px-4 sm:px-6 lg:px-8">

            <div class="sm:flex sm:items-center mb-8">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Categorias</h1>
                    <p class="mt-2 text-sm text-gray-700">
                        Las categorías son subjetivas, sirven para organizar la clasificación
                        de tus productos. Puedes agregar subcategorías a un categoría principal hasta un maximo de 3
                        niveles.
                    </p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <x-button wire:click='openNewCategory' class="flex items-center">
                        <x-icon code="add" class="mr-1" />
                        Nueva categoría
                    </x-button>
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
                <div
                    class="divide-y bg-gr mb-5 divide-gray-100 overflow-hidden shadow ring-1 ring-gray-900/5 sm:rounded-xl">

                    <div class="border-b border-gray-200 bg-gray-50 px-4 py-5 sm:px-6">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Búsqueda</h3>
                        <div class="sm:col-span-4">
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 px-2 ring-inset transition duration-300 bg-white
                              ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                    <input type="search" id="search"
                                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 
                                    text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Buscar por nombre o descripción...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul x-data="{ selected: null, subcategorySelected: null }" x-cloak role="list" class="">

                        @foreach ($categories as $category)

                            @include('admin.categories.category-principal-item')

                            {{-- Childs Categories --}}
                            @if ($category->hasChilds())
                                <div x-show="selected == {{ $category->id }}" x-collapse.duration.500
                                    class="ml-11 cursor-pointer"
                                    :class="selected == {{ $category->id }} && 'border-l border-gray-200'">

                                    <div class="pl-3">

                                        <h4 class="text-sm ml-6 font-semibold text-gray-700 my-1.5">Subcategorías de
                                            {{ $category->name }} </h4>

                                        @foreach ($category->childs as $childCategory)
                                            @include('admin.categories.category-child-item')

                                            @if ($childCategory->hasChilds())
                                                <div x-show="subcategorySelected == {{ $childCategory->id }}" x-cloak
                                                    x-collapse.duration.500>
                                                    <div class="ml-11 p-3"
                                                        :class="subcategorySelected == {{ $childCategory->id }} &&
                                                            'border-l border-gray-200'">

                                                        <h4 class="text-sm ml-6 font-semibold text-gray-700 my-1.5">
                                                            Subcategorías de {{ $category->name }} > {{ $childCategory->name }}
                                                        </h4>

                                                        @foreach ($childCategory->childs as $grandChild)
                                                            @include('admin.categories.category-grandchild-item')
                                                        @endforeach

                                                    </div>
                                                </div>
                                            @else
                                                <div x-show="subcategorySelected == {{ $childCategory->id }}"
                                                    x-collapse.duration.300 class="ml-10">
                                                    <h4 class="text-sm ml-6 font-semibold text-gray-400 my-3">Sin
                                                        subcategorías</h4>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            @else
                                <div x-show="selected == {{ $category->id }}" x-collapse.duration.300 class="ml-10">
                                    <h4 class="text-sm ml-6 font-semibold text-gray-400 my-3">Sin subcategorías</h4>
                                </div>
                            @endif
                        @endforeach

                    </ul>
                </div>

                {{ $categories->links() }}

            @endif

        </div>

        {{-- Delete category modal --}}
        @include('admin.categories.delete-dialog')

        {{-- Create/Edit category drawer --}}
        @include('admin.categories.upsert-form')

        {{-- Success notification toast --}}
        <x-toast ref="showNotification" type="success" title="{{ $notificationMessage }}" />

    </div>

</div>
