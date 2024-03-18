{{-- Pricipal Category --}}
<li wire:key='{{ $category->id }}' x-data="{ mouseOnCategory: false }"
@mouseover="mouseOnCategory = true" @mouseover.away="mouseOnCategory = false" 
class="relative flex justify-between  gap-x-6 p-3 sm:px-6 cursor-pointer 
transition hover:bg-gray-50">

    <div @click="selected !== {{ $category->id }} ? selected = {{ $category->id }} : selected = null"
        class="flex w-full gap-x-4">

        @if ($category->image_url)
            <img src="{{ Storage::url($category->image_url) }}" alt="category-img"
                class="w-12 h-12 rounded-full object-cover">
        @else
            <x-icon code="sticky_note_2"
                class="text-2xl text-gray-600 w-10 h-10 p-1 
            rounded-full bg-gray-50 text-center shadow" />
        @endif

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
        <x-icon wire:click='openAddSubcategory({{ $category }})' x-show="mouseOnCategory" code="library_add"
            data-tooltip-target="add_subcategory_{{ $category->id }}" data-tooltip-placement="left"
            @click="selected = {{ $category->id }};"
            class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
        rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />

        <x-tooltip id="add_subcategory_{{ $category->id }}">
            Agregar subcategoría
        </x-tooltip>

        {{-- Edit category --}}
        <x-icon wire:click='openEditCategory({{ $category }})' x-show="mouseOnCategory" code="edit"
            data-tooltip-target="edit_category_{{ $category->id }}" data-tooltip-placement="left"
            class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
            rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />

        <x-tooltip id="edit_category_{{ $category->id }}">Editar categoría</x-tooltip>

        {{-- Delete category --}}
        <x-icon x-show="mouseOnCategory" code="delete" wire:click='openDeleteCategory({{ $category }})'
        data-tooltip-target="delete_category_{{ $category->id }}" data-tooltip-placement="left"
        class="text-2xl text-red-400 w-8 h-8 p-1 rounded-full flex items-center
        bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />

        <x-tooltip id="delete_category_{{ $category->id }}">
            Elminar categoría
        </x-tooltip>

        {{-- Show subcategories --}}
        @if ($category->hasChilds())
            <i @click="selected !== {{ $category->id }} ? selected = {{ $category->id }} : selected = null"
                class="material-symbols-outlined
            text-gray-600 shadow p-1 rounded-full bg-gray-50 transition hover:bg-white cursor-pointer"
                data-tooltip-target="expand_category_{{ $category->id }}" data-tooltip-placement="left"
                x-text="selected == {{ $category->id }} ? 'expand_less' : 'expand_more'"></i>

            <x-tooltip id="expand_category_{{ $category->id }}"
                x-text="selected == {{ $category->id }} ? 'Contraer' : 'Ver subcategorías'"></x-tooltip>
        @endif
    </div>
</li>
