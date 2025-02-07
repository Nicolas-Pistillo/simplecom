<div>

    @if (!$hasProducts)
        <div class="text-center pt-8">

            <img src="{{ URL::to('img/illustrations/data_processing.svg') }}" class="h-64 mx-auto mb-4" alt="no-data-img">

            <div class="mb-4">
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Aún no cargaste productos</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Recordá crear primero tus
                    <a href="{{ route('admin.categories.index') }}"
                        class="text-blue-500 hover:underline hover:text-blue-600">categorías</a>
                    antes de crear tu primer producto
                </p>
            </div>
        </div>
    @else
        <div x-data="{ showBulkDeleteConfirm: false }" x-on:close-bulk-delete-dialog.window="showBulkDeleteConfirm = false">
            <section>
                <div class="mx-auto max-w-screen-2xl">
                    <div class="relative shadow-md rounded-lg">

                        <div
                            class="flex items-end justify-between flex-wrap gap-4 px-4 py-3 
                        bg-white rounded-t-lg border border-gray-100">

                            <div class="relative w-full order-2 sm:order-1 sm:w-72">

                                <div
                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <x-icon code="search" class="text-gray-500" />
                                </div>

                                <input type="search" wire:model.live='search'
                                    class="block w-full pt-2 ps-10 text-sm text-gray-900 
                                border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 
                              focus:border-blue-500"
                                    placeholder="Buscar productos...">
                            </div>

                            <div class="flex items-center order-1 sm:order-2 gap-3">

                                <div x-data="{ open: false }" class="relative">

                                    <x-icon code="tune" x-tooltip.raw.placement.top="Filtrar" @click="open = !open"
                                        class="transition colors cursor-pointer bg-gray-100 text-gray-500 
                                        p-1.5 rounded-full hover:bg-gray-200 no-select focus:outline-none 
                                        focus:ring duration-300" />

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
                                            <div class="flex items-center border-t border-slate-400/20 py-3">
                                                <span class="w-2/5 flex-none">Language</span><span
                                                    class="">English</span>
                                                <span
                                                    class="pointer-events-auto ml-auto font-medium text-indigo-600 
                                            hover:text-indigo-500">Update</span>
                                            </div>
                                            <div class="flex items-center border-t border-slate-400/20 py-3">
                                                <span class="w-2/5 flex-none">Date format</span>
                                                <span class="">DD-MM-YYYY</span>
                                                <span class="ml-auto flex items-center font-medium text-indigo-600">
                                                    <span
                                                        class="pointer-events-auto hover:text-indigo-500">Update</span>
                                                    <span class="mx-3 h-6 w-px bg-slate-400/20"></span>
                                                    <span
                                                        class="pointer-events-auto hover:text-indigo-500">Remove</span>
                                                </span>
                                            </div>
                                            <div class="flex items-center border-t border-slate-400/20 py-3">
                                                <span>Automatic timezone</span>
                                                <span class="ml-auto flex items-center">
                                                    <x-switch />
                                                </span>
                                            </div>
                                            <div class="flex items-center border-t border-slate-400/20 pt-3">
                                                <span>Auto-update applicant data</span>
                                                <span class="ml-auto flex items-center">
                                                    <x-switch />
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div x-data="{ open: false }" class="relative">

                                    <x-icon code="download" x-tooltip.raw.placement.top="Descargar"
                                        @click="open = !open"
                                        class="transition colors 
                                        cursor-pointer bg-gray-100 text-gray-500 p-1.5 rounded-full 
                                        hover:bg-gray-200 no-select focus:outline-none focus:ring duration-300" />

                                    <div x-show="open" x-cloak @click.away="open = false"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="transform opacity-0 scale-90"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-100"
                                        x-transition:leave-start="transform opacity-100 scale-200"
                                        x-transition:leave-end="transform opacity-0 scale-90"
                                        class="absolute top-12 right-0 w-max bg-white 
                                    ring-1 shadow-xl shadow-black/5 ring-slate-700/10 
                                    rounded-md overflow-hidden">

                                        <div class="text-[0.8125rem]/6 text-slate-900">

                                            <ul class="flex flex-col border-slate-400/20 rounded-md">

                                                <li
                                                    class="flex justify-between items-center px-3 py-1 text-sm leading-6 text-gray-900 
                                        transition hover:bg-gray-50 cursor-pointer">
                                                    Descargar en PDF
                                                    <x-icon code="description" class="text-red-700" />
                                                </li>

                                                <li
                                                    class="flex justify-between gap-x-2 items-center px-3 py-1 text-sm leading-6 text-gray-900 
                                        transition hover:bg-gray-50 cursor-pointer">
                                                    Descargar en Excel
                                                    <x-icon code="description" class="text-green-700" />
                                                </li>

                                                <li
                                                    class="flex justify-between items-center px-3 py-1 text-sm leading-6 text-gray-900 
                                        transition hover:bg-gray-50 cursor-pointer">
                                                    Descargar en CSV
                                                    <x-icon code="description" class="text-blue-700" />
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto" scrollbar-thin>
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-all" type="checkbox"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                                <label for="checkbox-all" class="sr-only">checkbox</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-4 py-3">Producto</th>
                                        <th scope="col" class="px-4 py-3">Categoría</th>
                                        <th scope="col" class="px-4 py-3">Stock</th>
                                        <th scope="col" class="px-4 py-3">Precio</th>
                                        <th scope="col" class="px-4 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr wire:key='{{ $product->id }}'
                                            class="border-b text-xs text-center transition-colors cursor-pointer 
                                        duration-300 hover:bg-gray-50"
                                            @click="alert('Le mando click')">

                                            <td class="w-4 px-4 py-3" onclick="event.stopPropagation()">
                                                <div class="flex items-center">
                                                    <input id="checkbox-table-search-1" type="checkbox"
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                                </div>
                                            </td>

                                            <th class="flex items-center pl-4 pr-8 py-2 font-medium text-gray-900">

                                                <img src="{{ $product->first_image }}" alt="{{ $product->name }}"
                                                    class="w-8 h-8 mr-3 rounded-lg">

                                                <div class="flex flex-col items-start">
                                                    <span class="max-w-[220px] truncate font-semibold"
                                                        x-tooltip.raw.placement.top="{{ $product->name }}">
                                                        {{ $product->name }}
                                                    </span>

                                                    <div class="text-gray-600 font-semibold">
                                                        <small style="font-size: 11px">ID {{ $product->id }}</small>

                                                        @if (!empty($product->code))
                                                            <small style="font-size: 11px">- Código
                                                                {{ $product->code }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </th>

                                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $product->category->name }}
                                            </td>

                                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $product->stock }}
                                            </td>

                                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                                <div class="flex justify-center gap-x-1">

                                                    <span>${{ priceFormat($product->current_price) }}</span>

                                                    @if ($product->hasDiscount())
                                                        <small class="text-green-700 font-semibold"
                                                            style="font-size: 11px">
                                                            %{{ $product->discount_percent }} OFF
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="px-4 py-2 whitespace-nowrap mx-auto"
                                                onclick="event.stopPropagation()">
                                                <span class="inline-flex overflow-hidden shadow-sm">

                                                    <span class="flex h-7 mx-auto rounded-md shadow-sm">

                                                        <x-button type="secondary"
                                                            wire:click='togglePublishedProduct({{ $product->id }})'
                                                            x-tooltip.raw.placement.top="{{ $product->published ? 'Despublicar' : 'Publicar' }}"
                                                            class="text-xs rounded-r-none flex items-center
                                                            {{ $product->published ? '!bg-blue-100 !text-blue-500' : '' }}">

                                                            <x-icon wire:loading.remove
                                                                wire:target='togglePublishedProduct({{ $product->id }})'
                                                                code="{{ $product->published ? 'visibility' : 'visibility_off' }}"
                                                                style="font-size: 16px" />

                                                            <x-spinner wire:loading
                                                                wire:target='togglePublishedProduct({{ $product->id }})'
                                                                spinnerclass="!h-4 !w-4" />

                                                        </x-button>

                                                        <x-button type="secondary"
                                                            wire:click='toggleFeaturedProduct({{ $product->id }})'
                                                            x-tooltip.raw.placement.top="{{ $product->featured ? 'No destacar' : 'Destacar' }}"
                                                            class="rounded-none flex items-center
                                                            {{ $product->featured ? '!bg-yellow-100 !text-yellow-500' : '' }}">

                                                            <x-icon wire:loading.remove
                                                                wire:target='toggleFeaturedProduct({{ $product->id }})'
                                                                code="star" style="font-size: 16px" />

                                                            <x-spinner wire:loading
                                                                wire:target='toggleFeaturedProduct({{ $product->id }})'
                                                                spinnerclass="!h-4 !w-4" />

                                                        </x-button>

                                                        <x-button :href="route('admin.products.edit', $product->id)" type="secondary"
                                                            class="flex items-center rounded-none"
                                                            x-tooltip.raw.placement.top="Editar">
                                                            <x-icon code="edit" style="font-size: 16px" />
                                                        </x-button>

                                                        <x-button :href="$product->detailPageUrl()" blank type="secondary"
                                                            class="flex items-center rounded-l-none"
                                                            x-tooltip.raw.placement.top="Ver producto en la tienda">
                                                            <x-icon code="storefront" style="font-size: 16px" />
                                                        </x-button>

                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr
                                            class="border-b text-xs text-center transition-colors duration-300
                                        hover:bg-gray-50">
                                            <td></td>
                                            <td
                                                class="px-4 py-2 font-semibold 
                                            text-gray-900 whitespace-nowrap">
                                                Sin resultados
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($products->total() > 10)
                            <nav class="p-4 space-y-3 md:flex-row md:items-center md:space-y-0"
                                aria-label="Table navigation">
                                {{ $products->onEachSide(0)->links() }}
                            </nav>
                        @endif

                        {{-- TODO: Product quick edit drawer
                        <div class="relative z-40" aria-labelledby="slide-over-title" role="dialog"
                            aria-modal="true">
                            <!-- Background backdrop, show/hide based on slide-over state. -->
                            <div class="fixed inset-0 bg-gray-600/50"></div>

                            <div class="fixed inset-0 overflow-hidden">
                                <div class="absolute inset-0 overflow-hidden">
                                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                                        <!--
                                    Slide-over panel, show/hide based on slide-over state.
                          
                                    Entering: "transform transition ease-in-out duration-500 sm:duration-700"
                                      From: "translate-x-full"
                                      To: "translate-x-0"
                                    Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
                                      From: "translate-x-0"
                                      To: "translate-x-full"
                                  -->
                                        <div class="pointer-events-auto w-screen max-w-md">
                                            <div class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl">
                                                <div class="flex min-h-0 flex-1 flex-col overflow-y-scroll pb-6">
                                                    <div>

                                                        <div class="p-6 flex items-start justify-between">
                                                            <h2 class="text-base font-semibold text-gray-900"
                                                                id="slide-over-title">Producto</h2>
                                                            <div class="ml-3 flex h-7 items-center">
                                                                <button type="button"
                                                                    class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                                    <span class="absolute -inset-2.5"></span>
                                                                    <span class="sr-only">Close panel</span>
                                                                    <svg class="size-6" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor" aria-hidden="true"
                                                                        data-slot="icon">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M6 18 18 6M6 6l12 12" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="border-b border-gray-200">
                                                            <div class="px-6">
                                                                <nav class="-mb-px flex space-x-6"
                                                                    x-description="Tab component">
                                                                    <a href="#"
                                                                        class="border-indigo-500 text-indigo-600 whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium"
                                                                        x-state:on="Current" x-state:off="Default"
                                                                        x-state-description="Current: &quot;border-indigo-500 text-indigo-600&quot;, Default: &quot;border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700&quot;">All</a>
                                                                    <a href="#"
                                                                        class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium"
                                                                        x-state-description="undefined: &quot;border-indigo-500 text-indigo-600&quot;, undefined: &quot;border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700&quot;">Online</a>
                                                                    <a href="#"
                                                                        class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 whitespace-nowrap border-b-2 px-1 pb-4 text-sm font-medium"
                                                                        x-state-description="undefined: &quot;border-indigo-500 text-indigo-600&quot;, undefined: &quot;border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700&quot;">Offline</a>
                                                                </nav>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="relative mt-6 flex-1 px-4 sm:px-6">

                                                        <!-- Your content -->

                                                        <div class="space-y-6">
                                                            <div>
                                                                <label for="project-name"
                                                                    class="block text-sm/6 font-medium text-gray-900">Project
                                                                    name</label>
                                                                <div class="mt-2">
                                                                    <input type="text" name="project-name"
                                                                        id="project-name"
                                                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label for="project-description"
                                                                    class="block text-sm/6 font-medium text-gray-900">Description</label>
                                                                <div class="mt-2">
                                                                    <textarea rows="3" name="project-description" id="project-description"
                                                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h3 class="text-sm/6 font-medium text-gray-900">Team
                                                                    Members</h3>
                                                                <div class="mt-2">
                                                                    <div class="flex space-x-2">
                                                                        <a href="#"
                                                                            class="relative rounded-full hover:opacity-75">
                                                                            <img class="inline-block w-10 h-10 rounded-full"
                                                                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                                                                alt="Tom Cook">
                                                                        </a>
                                                                        <a href="#"
                                                                            class="relative rounded-full hover:opacity-75">
                                                                            <img class="inline-block w-10 h-10 rounded-full"
                                                                                src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                                                                alt="Whitney Francis">
                                                                        </a>
                                                                        <a href="#"
                                                                            class="relative rounded-full hover:opacity-75">
                                                                            <img class="inline-block w-10 h-10 rounded-full"
                                                                                src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                                                                alt="Leonard Krasner">
                                                                        </a>
                                                                        <a href="#"
                                                                            class="relative rounded-full hover:opacity-75">
                                                                            <img class="inline-block w-10 h-10 rounded-full"
                                                                                src="https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                                                                alt="Floyd Miles">
                                                                        </a>
                                                                        <a href="#"
                                                                            class="relative rounded-full hover:opacity-75">
                                                                            <img class="inline-block w-10 h-10 rounded-full"
                                                                                src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                                                                alt="Emily Selman">
                                                                        </a>

                                                                        <button type="button"
                                                                            class="relative inline-flex w-10 h-10 shrink-0 items-center justify-center rounded-full border-2 border-dashed border-gray-200 bg-white text-gray-400 hover:border-gray-300 hover:text-gray-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-hidden">
                                                                            <span class="absolute -inset-2"></span>
                                                                            <span class="sr-only">Add team
                                                                                member</span>
                                                                            <svg class="size-5" viewBox="0 0 20 20"
                                                                                fill="currentColor" aria-hidden="true"
                                                                                data-slot="icon">
                                                                                <path
                                                                                    d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z">
                                                                                </path>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <fieldset>
                                                                <legend class="text-sm/6 font-medium text-gray-900">
                                                                    Privacy</legend>
                                                                <div class="mt-2 space-y-4">
                                                                    <div class="relative flex items-start">
                                                                        <div class="absolute flex h-6 items-center">
                                                                            <input id="privacy-public" name="privacy"
                                                                                value="public"
                                                                                aria-describedby="privacy-public-description"
                                                                                type="radio" checked=""
                                                                                class="relative size-4 appearance-none rounded-full border border-gray-300 before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                                                                        </div>
                                                                        <div class="pl-7 text-sm/6">
                                                                            <label for="privacy-public"
                                                                                class="font-medium text-gray-900">Public
                                                                                access</label>
                                                                            <p id="privacy-public-description"
                                                                                class="text-gray-500">Everyone with the
                                                                                link will see this project.</p>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="relative flex items-start">
                                                                            <div
                                                                                class="absolute flex h-6 items-center">
                                                                                <input id="privacy-private-to-project"
                                                                                    name="privacy"
                                                                                    value="private-to-project"
                                                                                    aria-describedby="privacy-private-to-project-description"
                                                                                    type="radio"
                                                                                    class="relative size-4 appearance-none rounded-full border border-gray-300 before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                                                                            </div>
                                                                            <div class="pl-7 text-sm/6">
                                                                                <label for="privacy-private-to-project"
                                                                                    class="font-medium text-gray-900">Private
                                                                                    to project members</label>
                                                                                <p id="privacy-private-to-project-description"
                                                                                    class="text-gray-500">Only members
                                                                                    of this project would be able to
                                                                                    access.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="relative flex items-start">
                                                                            <div
                                                                                class="absolute flex h-6 items-center">
                                                                                <input id="privacy-private"
                                                                                    name="privacy" value="private"
                                                                                    aria-describedby="privacy-private-to-project-description"
                                                                                    type="radio"
                                                                                    class="relative size-4 appearance-none rounded-full border border-gray-300 before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden">
                                                                            </div>
                                                                            <div class="pl-7 text-sm/6">
                                                                                <label for="privacy-private"
                                                                                    class="font-medium text-gray-900">Private
                                                                                    to you</label>
                                                                                <p id="privacy-private-description"
                                                                                    class="text-gray-500">You are the
                                                                                    only one able to access this
                                                                                    project.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="flex shrink-0 justify-end px-4 py-4">
                                                    <button type="button"
                                                        class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400">Cancel</button>
                                                    <button type="submit"
                                                        class="ml-4 inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                    </div>
                </div>
            </section>
        </div>
    @endif

</div>
