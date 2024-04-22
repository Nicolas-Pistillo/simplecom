{{-- Pricipal Category --}}
<li x-data="{ mouseOnCategory: false }" @click="subcategorySelected = null"
@mouseover="mouseOnCategory = true" @mouseover.away="mouseOnCategory = false" 
class="relative flex justify-between  gap-x-6 p-3 sm:px-6 cursor-pointer transition duration-200" 
:class="selected == {{ $category->id }} ? 'bg-gray-50 shadow-md' : 'hover:bg-gray-50'">

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
            <p class="text-sm flex items-center font-semibold leading-6 text-gray-900">
                
                {{ $category->name }}

                <span @click.prevent="$event.stopPropagation()" class="flex h-8 ml-4 rounded-md shadow-sm">

                    <x-button type="secondary" wire:click='togglePublishedCategory({{ $category->id }})'
                    x-tooltip.raw.placement.top="{{ $category->published ? 'Publicada' : 'No publicada' }}"
                    class="text-xs rounded-r-none flex items-center
                    {{ $category->published ? '!bg-blue-100 !text-blue-500' : '' }}">

                        <span wire:loading.remove wire:target='togglePublishedCategory({{ $category->id }})' 
                        class="flex items-center">
                            <x-icon code="{{ $category->published ? 'visibility' : 'visibility_off' }}" 
                            style="font-size: 16px" />
                        </span>

                        <span wire:loading wire:target='togglePublishedCategory({{ $category->id }})'>
                            <x-spinner spinnerclass="!h-4 !w-4" />
                        </span>
                    </x-button>

                    <x-button type="secondary" wire:click='toggleFeaturedCategory({{ $category->id }})'
                    x-tooltip.raw.placement.top="{{ $category->featured ? 'Destacada' : 'No destacada' }}"
                    class="rounded-l-none flex items-center
                    {{ $category->featured ? '!bg-yellow-100 !text-yellow-500' : '' }}">

                        <span wire:loading.remove wire:target='toggleFeaturedCategory({{ $category->id }})' 
                        class="flex items-center">
                            <x-icon code="star" style="font-size: 16px" />
                        </span>

                        <span wire:loading wire:target='toggleFeaturedCategory({{ $category->id }})'>
                            <x-spinner spinnerclass="!h-4 !w-4" />
                        </span>

                    </x-button>

                </span>
            </p>
            <p class="mt-1 flex text-xs leading-5 text-gray-500">
                {{ $category->description ?? 'Sin descripción' }}
            </p> 
        </div>
    </div>

    <div class="flex shrink-0 items-center gap-x-4">

        {{-- Add subcategory --}}
        <div x-tooltip.raw.placement.left="Agregar subcategoría">
            <x-icon wire:click='openAddSubcategory({{ $category }})' x-show="mouseOnCategory" code="library_add"
            @click="selected = {{ $category->id }};"
            class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
            rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
        </div>

        {{-- Edit category --}}
        <div x-tooltip.raw.placement.left="Editar categoría">
            <x-icon wire:click='openEditCategory({{ $category }})' x-show="mouseOnCategory" code="edit"
            class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
            rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
        </div>

        {{-- Delete category --}}
        <div x-tooltip.raw.placement.left="Elminar categoría">
            <x-icon x-show="mouseOnCategory" code="delete" 
            @click="selected = null"
            wire:click='openDeleteCategory({{ $category }})'
            class="text-2xl text-red-400 w-8 h-8 p-1 rounded-full flex items-center
            bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
        </div>

        {{-- Show subcategories --}}
        @if ($category->hasChilds())
            <div x-tooltip.placement.left="selected == {{ $category->id }} ? 'Contraer' : 'Ver subcategorías'">
                <i @click="selected !== {{ $category->id }} ? selected = {{ $category->id }} : selected = null"
                class="material-symbols-outlined text-gray-600 shadow p-1 rounded-full 
                bg-gray-50 transition hover:bg-white cursor-pointer"
                x-text="selected == {{ $category->id }} ? 'expand_less' : 'expand_more'"></i>
            </div>
        @endif
    </div>
</li>
