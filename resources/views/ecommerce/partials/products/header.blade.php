{{-- <div class="pt-8">
    <img src="https://t4.ftcdn.net/jpg/02/49/50/15/360_F_249501541_XmWdfAfUbWAvGxBwAM0ba2aYT36ntlpH.jpg"
        class="w-full h-48 rounded-lg object-cover">
</div> --}}

<div class="flex items-end gap-6 flex-wrap justify-between border-b border-gray-200 pb-4 pt-8">

    <h1 class="text-4xl font-bold tracking-tight text-gray-900">
        @if ($form->category)
            {{ $form->category->name }}
        @else
            Productos
        @endif
    </h1>

    <div x-data="{mobileFiltersOpen: false}" class="no-select flex items-end gap-4">

        <div wire:loading wire:target='loadProducts'>
            <x-spinner />
        </div>

        <div class="relative inline-block text-left">
            <div>
                <label for="country" class="block text-sm/6 font-medium text-gray-900">
                    Ordenar por
                </label>
                <div class="grid grid-cols-1">
                    <select id="country" wire:model.live='form.order' name="country" autocomplete="country-name"
                        class="col-start-1 row-start-1 w-full appearance-none rounded-md 
                    bg-white py-1.5 pr-8 pl-3 text-gray-900 outline-1  border-gray-400
                    -outline-offset-1 outline-gray-300 focus:outline-2 
                    focus:-outline-offset-2 focus:outline-blue-600 text-sm/6">
                        <option value="relevantes">Mas relevantes</option>
                        <option value="nuevos">Mas nuevos</option>
                        <option value="menor_precio">Menor precio</option>
                        <option value="mayor_precio">Mayor precio</option>
                    </select>
                </div>
            </div>
        </div>

        <x-icon code="tune" @click="mobileFiltersOpen = true"
        class="block lg:hidden transition colors cursor-pointer bg-gray-100
        text-gray-500 p-2 rounded-full hover:bg-gray-200 
        focus:outline-none focus:ring duration-300" />

        @include('ecommerce.partials.products.mobile-filters')

    </div>
</div>

@if ($form->category)
    <nav class="flex border-b border-gray-200 bg-white overflow-x-auto" scrollbar-thin aria-label="Breadcrumb">

        <ol role="list" class="mx-auto flex w-full max-w-screen-xl space-x-4">

            <li class="flex">
                <div class="flex items-center">
                    <svg class="h-full w-6 shrink-0 text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none"
                        fill="currentColor" aria-hidden="true">
                        <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                    </svg>
                    <a href="{{ route('ecommerce.products') }}"
                        class="ml-4 text-sm font-medium text-gray-500 hover:text-blue-600 cursor-pointer"
                        aria-current="page">Productos</a>
                </div>
            </li>

            @if ($form->category->father?->father)
                <li class="flex">
                    <div class="flex items-center">
                        <svg class="h-full w-6 shrink-0 text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none"
                            fill="currentColor" aria-hidden="true">
                            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                        </svg>
                        <span wire:click='setCategory({{ $form->category->father->father->id }})'
                            class="ml-4 text-sm font-medium text-gray-500 hover:text-blue-600 cursor-pointer"
                            aria-current="page">{{ $form->category->father->father->name }}</span>
                    </div>
                </li>
            @endif

            @if ($form->category->father)
                <li class="flex">
                    <div class="flex items-center">
                        <svg class="h-full w-6 shrink-0 text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none"
                            fill="currentColor" aria-hidden="true">
                            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                        </svg>
                        <span wire:click='setCategory({{ $form->category->father->id }})'
                            class="ml-4 text-sm font-medium text-gray-500 hover:text-blue-600 cursor-pointer"
                            aria-current="page">{{ $form->category->father->name }}</span>
                    </div>
                </li>
            @endif

            <li class="flex">
                <div class="flex items-center">
                    <svg class="h-full w-6 shrink-0 text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none"
                        fill="currentColor" aria-hidden="true">
                        <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                    </svg>
                    <span class="ml-4 text-sm text-gray-700 font-semibold cursor-default"
                    aria-current="page">{{ $form->category->name }}</span>
                </div>
            </li>

        </ol>
    </nav>
@endif
