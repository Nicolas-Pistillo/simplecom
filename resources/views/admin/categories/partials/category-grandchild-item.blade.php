@foreach ($childCategory->childs->sortBy('order') as $grandChildCategory)
    <div wire:key='{{ $grandChildCategory->id }}' data-id="{{ $grandChildCategory->id }}"
        data-parent-id="{{ $childCategory->id }}">
        <div class="p-3 flex items-center justify-between gap-x-3 cursor-move
        border rounded-lg font-medium text-sm hover:bg-gray-50">
            <div class="w-full flex items-center justify-between gap-1.5">
                <div class="flex items-center gap-1.5">

                    <x-icon code="drag_indicator" />

                    <img src="{{ $grandChildCategory->image }}" alt="{{ $grandChildCategory->name }}"
                        class="w-8 h-8 rounded-full object-cover @if (!$grandChildCategory->published) grayscale @endif">

                    <span class="@if (!$grandChildCategory->published) text-gray-500 @endif">
                        {{ $grandChildCategory->name }}
                    </span>

                    @if ($grandChildCategory->featured)
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
                            border-gray-300 hover:border-gray-400" />
                        </x-slot>

                        <x-dropdown-item closeOnClick icon="edit" wire:click='openEdit({{ $grandChildCategory->id }})'
                            label="Editar" />

                        <x-dropdown-item closeOnClick wire:click='togglePublished({{ $grandChildCategory->id }})'
                            :icon="$grandChildCategory->published ? 'public_off' : 'public'" :label="$grandChildCategory->published ? 'Despublicar' : 'Publicar'" />

                        <x-dropdown-item closeOnClick wire:click='toggleFeatured({{ $grandChildCategory->id }})'
                            :icon="$grandChildCategory->featured ? 'star' : 'star_rate_half'" :label="$grandChildCategory->featured ? 'No destacar' : 'Destacar'" />

                        <x-dropdown-item closeOnClick icon="delete" label="Eliminar"
                            wire:click='openDelete({{ $grandChildCategory->id }})' iconClass="text-red-500" />
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
@endforeach
