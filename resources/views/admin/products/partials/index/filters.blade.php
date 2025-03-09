<div x-show="open" x-cloak @click.away="open = false" 
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="transform opacity-0 scale-90" 
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100" 
    x-transition:leave-start="transform opacity-100 scale-200"
    x-transition:leave-end="transform opacity-0 scale-90"
    class="absolute top-12 z-20 right-0 w-[30.25rem] rounded-md bg-white 
    p-4 ring-1 shadow-xl shadow-black/5 ring-slate-700/10">
    <h6 class="font-semibold text-sm text-slate-900">Filtros</h6>

    <div class="mt-4 text-[0.8125rem]/6 text-slate-900">

        {{-- <div class="flex items-center border-t border-slate-400/20 py-3">
            <span class="w-2/5 flex-none">Date format</span>
            <span class="">DD-MM-YYYY</span>
            <span class="ml-auto flex items-center font-medium text-indigo-600">
                <span class="pointer-events-auto hover:text-indigo-500">Update</span>
                <span class="mx-3 h-6 w-px bg-slate-400/20"></span>
                <span class="pointer-events-auto hover:text-indigo-500">Remove</span>
            </span>
        </div> --}}

        <div class="flex items-center border-t border-slate-400/20 py-3">
            <span class="w-2/5 flex-none">Marca</span>
            <span class="pointer-events-auto ml-auto font-medium">
                <select wire:model.live="filters.brand_id"
                class="block w-full rounded-md border-none py-0.5 text-gray-900 
                shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                focus:ring-inset focus:ring-blue-600 text-sm leading-6">
                    <option value="0">Todas</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </span>
        </div>

        <div class="flex items-center border-t border-slate-400/20 py-3">
            <span class="w-2/5 flex-none">Categoría</span>
            <span class="pointer-events-auto ml-auto font-medium">
                <select wire:model.live="filters.category_id"
                class="block w-full rounded-md border-none py-0.5 text-gray-900 
                shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                focus:ring-inset focus:ring-blue-600 text-sm leading-6">
                    <option value="0">Todas</option>
                    
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>

                        @if ($category->hasChilds())
                            @foreach ($category->childs as $categoryChild)
                                <option value="{{ $categoryChild->id }}">
                                    {{ $category->name }} > {{ $categoryChild->name }}
                                </option>

                                @if ($categoryChild->hasChilds())
                                    @foreach ($categoryChild->childs as $categoryGrandchild)
                                        <option value="{{ $categoryGrandchild->id }}">
                                            {{ $category->name }} > {{ $categoryChild->name }} >
                                            {{ $categoryGrandchild->name }}
                                        </option>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </span>
        </div>

        <div class="flex items-center border-t border-slate-400/20 py-3">
            <span>Solo publicados</span>
            <span class="ml-auto flex items-center">
                <x-switch wireModel="filters.only_published" />
            </span>
        </div>

        <div class="flex items-center border-t border-slate-400/20 pt-3">
            <span>Solo destacados</span>
            <span class="ml-auto flex items-center">
                <x-switch wireModel="filters.only_featured" />
            </span>
        </div>
    </div>
</div>
