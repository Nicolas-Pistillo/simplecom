<div wire:key='{{ $category->id }}' data-id="{{ $category->id }}">
    <div class="p-3 flex items-center justify-between gap-x-3 cursor-move
    border rounded-lg font-medium text-sm hover:bg-gray-50">
        <div class="w-full flex items-center justify-between gap-1.5">
            <div class="flex items-center gap-1.5">

                <x-icon code="drag_indicator" />

                <img src="{{ $category->image }}" alt="{{ $category->name }}" 
                class="w-8 h-8 rounded-full object-cover @if(!$category->published) grayscale @endif">

                <span class="@if(!$category->published) text-gray-500 @endif">
                    {{ $category->name }}
                </span>

                @if ($category->featured)
                    <x-review-star filled class="!w-4 !h-4" />
                @endif
            </div>
            <div>
                <x-dropdown position="right-0" containerClass="w-48">

                    <x-slot name="trigger">
                        <x-icon code="more_vert" x-tooltip.raw="Acciones" style="font-size: 18px"
                        class="material-symbols-outlined transition colors cursor-pointer 
                        bg-gray-100 text-gray-600 p-1.5 rounded-full 
                        focus:outline-none focus:ring duration-300 border 
                        border-gray-300 hover:border-gray-400"
                        />
                    </x-slot>

                    <x-dropdown-item closeOnClick label="Agregar subcategoría"
                    icon="add" wire:click='openAddSubcategory({{ $category->id }})' />

                    <x-dropdown-item closeOnClick 
                    icon="edit" wire:click='openEdit({{ $category->id }})' 
                    label="Editar" />

                    <x-dropdown-item closeOnClick 
                    wire:click='togglePublished({{ $category->id }})' 
                    :icon="$category->published ? 'public_off' : 'public'" 
                    :label="$category->published ? 'Despublicar' : 'Publicar'" />

                    <x-dropdown-item closeOnClick 
                    wire:click='toggleFeatured({{ $category->id }})' 
                    :icon="$category->featured ? 'star' : 'star_rate_half'" 
                    :label="$category->featured ? 'No destacar' : 'Destacar'" />

                    <x-dropdown-item closeOnClick icon="delete" label="Eliminar" 
                    wire:click='openDelete({{ $category->id }})'
                    iconClass="text-red-500" />
                </x-dropdown>
            </div>
        </div>
    </div>
    <div class="ps-8 ml-3 nested-sortable-item space-y-1.5 mt-1.5 border-l">
        @include('admin.categories.partials.category-child-item')
    </div>
</div>
