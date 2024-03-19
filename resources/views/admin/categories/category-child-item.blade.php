{{-- Child category --}}
<li wire:key='{{ $category->id }}' x-data="{ mouseOnSubCategory: false }" x-cloak
    @mouseover="mouseOnSubCategory = true" @mouseover.away = "mouseOnSubCategory = false" 
    class="relative flex justify-between gap-x-6 p-3 
    transition duration-200 hover:bg-gray-50 hover:shadow sm:px-6 rounded-l-md"
    :class="subcategorySelected == {{ $childCategory->id }} && 'bg-gray-50 shadow'">

    <div class="flex w-full gap-x-4"
        @click="subcategorySelected !== {{ $childCategory->id }} ? subcategorySelected = {{ $childCategory->id }} : subcategorySelected = null">

        @if ($childCategory->image_url)
            <img src="{{ Storage::url($childCategory->image_url) }}" alt="category-img"
                class="w-12 h-12 rounded-full object-cover">
        @else
            <x-icon code="library_books"
                class="text-2xl text-gray-600 w-10 h-10 p-1
                rounded-full bg-gray-50 text-center shadow" />
        @endif

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

        {{-- Add subcategory --}}
        <div x-tooltip.placement.left x-tooltip.raw="Agregar subcategoría">
            <x-icon wire:click='openAddSubcategory({{ $childCategory }})' x-show="mouseOnSubCategory" code="library_add"
            @click="subcategorySelected = {{ $childCategory->id }}"
            class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
            rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
        </div>

        {{-- Edit subcategory --}}
        <div x-tooltip.placement.left x-tooltip.raw="Editar subcategoría">
            <x-icon x-show="mouseOnSubCategory" code="edit" wire:click='openEditCategory({{ $childCategory }})'
            class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
            rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
        </div>

        {{-- Delete subcategory --}}
        <div x-tooltip.placement.left x-tooltip.raw="Elminar subcategoría">
            <x-icon x-show="mouseOnSubCategory" code="delete" wire:click='openDeleteCategory({{ $childCategory }})'
            class="text-2xl text-red-400 w-8 h-8 p-1 rounded-full flex items-center
            bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
        </div>

        {{-- Show subcategories --}}
        @if ($childCategory->hasChilds())

            <div x-tooltip.placement.left x-tooltip="subcategorySelected == {{ $childCategory->id }} ? 'Contraer' : 'Ver subcategorías'">
                <i x-show="mouseOnSubCategory"
                @click="subcategorySelected !== {{ $childCategory->id }} ? subcategorySelected = {{ $childCategory->id }} : subcategorySelected = null"
                class="material-symbols-outlined
                text-gray-600 shadow p-1 rounded-full bg-gray-50 transition hover:bg-white cursor-pointer"
                x-text="subcategorySelected == {{ $childCategory->id }} ? 'expand_less' : 'expand_more'"></i>
            </div>
        @endif

    </div>
</li>
