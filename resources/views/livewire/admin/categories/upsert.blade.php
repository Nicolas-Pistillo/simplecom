<div>

    <div x-data="{ categoriesDrawerOpen: false, deleteDialogOpen: false }" 
        x-on:close-drawer.window="categoriesDrawerOpen = false"
        x-on:open-drawer.window="categoriesDrawerOpen = true; $nextTick(() => {document.getElementById('category_name_input').focus()})"
        x-on:open-delete-dialog.window="deleteDialogOpen = true"
        x-on:close-delete-dialog.window="deleteDialogOpen = false">

        <div class="px-4 sm:px-6 lg:px-8 mb-8">
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

            {{-- Category tree --}}
            <div id="nested-sortable" class="w-full">
                <div class="nested-sortable-item space-y-1.5">
                    @foreach ($categories as $category)
                        @include('admin.categories.partials.category-principal-item')
                    @endforeach
                </div>
            </div>

            <script>
                window.addEventListener('load', () => 
                {
                    function buildTree(container, parentId = null) 
                    {
                        let data = [];
                        container.querySelectorAll(':scope > div[data-id]').forEach((el, index) => 
                        {
                            let id = el.dataset.id;
                            let childContainer = el.querySelector(':scope > .nested-sortable-item');

                            data.push({
                                id: id,
                                parent_id: parentId,
                                order: index,
                                children: childContainer ? buildTree(childContainer, id) : []
                            });
                        });
                        return data;
                    }

                    function initSortable() {

                        const nestedSortables = document.querySelectorAll('#nested-sortable .nested-sortable-item')

                        for (var i = 0; i < nestedSortables.length; i++) {
                            Sortable.create(nestedSortables[i], {
                                group: 'nested',
                                animation: 150,
                                fallbackOnBody: true,
                                swapThreshold: 0.65,
                                onEnd: function(evt) 
                                {
                                    let depth = 0;
                                    let node = evt.item.parentNode;

                                    while (node && !node.id?.includes("nested-sortable")) 
                                    {
                                        if (node.classList.contains("nested-sortable-item")) depth++;
                                        node = node.parentNode;
                                    }

                                    let itemChilds = evt.item.querySelector('.nested-sortable-item');
                                    let itemGrandChilds = itemChilds ? itemChilds.querySelector('.nested-sortable-item') : null;

                                    if (itemChilds && itemChilds.childElementCount > 0) depth++;
                                    if (itemGrandChilds && itemGrandChilds.childElementCount > 0) depth++;

                                    if (depth > 3) 
                                    {
                                        evt.from.insertBefore(evt.item, evt.from.children[evt.oldIndex]); // lo devolvemos
                                        alert("⚠️ Solo se permiten hasta 3 niveles de categorización");
                                        return;
                                    }

                                    let root = document.querySelector('#nested-sortable > .nested-sortable-item');
                                    let tree = buildTree(root);

                                    Livewire.dispatch('categoriesReordered', {tree: tree});
                                }
                            })
                        }
                    }

                    initSortable();

                    Livewire.on('reorder', (evt) => initSortable());
                })
            </script>
        </div>

        {{-- Delete category modal --}}
        @include('admin.categories.partials.delete-dialog')

        {{-- Create/Edit category drawer --}}
        @include('admin.categories.partials.upsert-form')

    </div>

</div>
