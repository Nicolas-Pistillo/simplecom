{{-- Granchild category --}}
<li wire:key='{{ $grandChild->id }}' x-data="{ mouseOnGrandChild: false }" 
    @mouseover="mouseOnGrandChild = true"
    @mouseover.away="mouseOnGrandChild = false"
    class="relative flex justify-between gap-x-6 p-3 
    transition duration-200 hover:bg-gray-50 hover:shadow sm:px-6 rounded-l-md">

    <div class="flex min-w-0 gap-x-4">

        @if ($grandChild->image_url)
            <img src="{{ Storage::url($grandChild->image_url) }}" alt="category-img"
                class="w-12 h-12 rounded-full object-cover">
        @else
            <x-icon code="library_books"
                class="text-2xl text-gray-600 w-10 h-10 p-1
                rounded-full bg-gray-50 text-center shadow" />
        @endif

        <div class="min-w-0 flex-auto">
            <p class="text-sm font-semibold leading-6 text-gray-900">

                {{ $grandChild->name }}

                @if ($grandChild->published)
                    <x-badge color="blue" class="mx-1">Publicada</x-badge>
                @else
                    <x-badge class="mx-1">No publicada</x-badge>
                @endif

                @if ($grandChild->featured)
                    <x-badge color="purple" class="mx-1">Destacada</x-badge>
                @endif

            </p>
            <p class="mt-1 flex text-xs leading-5 text-gray-500">
                {{ $grandChild->description ?? 'Sin descripción' }}
            </p>
        </div>
    </div>

    <div class="flex shrink-0 items-center gap-x-4">

        {{-- Edit subcategory --}}
        <div x-tooltip.raw.placement.left="Editar subcategoría">
            <x-icon x-show="mouseOnGrandChild" code="edit" wire:click='openEditCategory({{ $grandChild }})'
                class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
                rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
        </div>

        {{-- Delete subcategory --}}
        <div x-tooltip.raw.placement.left="Elminar subcategoría">
            <x-icon x-show="mouseOnGrandChild" code="delete" wire:click='openDeleteCategory({{ $grandChild }})'
                class="text-2xl text-red-400 w-8 h-8 p-1 rounded-full flex items-center
                bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
        </div>

    </div>

</li>
