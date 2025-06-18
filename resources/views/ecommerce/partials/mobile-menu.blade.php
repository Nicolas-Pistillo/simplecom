<div x-cloak x-show="mobileMenuOpen" class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
    <!-- Off-canvas menu backdrop -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50"></div>

    <!-- Off-canvas menu sidebar -->
    <div class="fixed inset-0 z-40 flex">
        <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false"
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
            class="relative flex w-[270px] flex-col overflow-y-auto bg-white pb-12 shadow-xl">

            <!-- Brand logo -->
            <img src="{{ Storage::url(tenant()->logo_url) }}" alt="Ecommerce logo"
            class="h-24 p-3 object-contain shadow relative">

            <!-- Links -->
            <nav class="flex flex-1 flex-col m-4">
                <ul role="list" class="flex flex-1 flex-col gap-y-7 divide-y">

                    <li>
                        <ul role="list" class="-mx-2 mt-2 space-y-1">
                            <li>
                                <a href="{{ route('ecommerce.index') }}"
                                class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 
                                group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <x-icon code="home" />
                                    <span class="truncate">Inicio</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ecommerce.products') }}"
                                class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 
                                group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <x-icon code="storefront" />
                                    <span class="truncate">Productos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ecommerce.contact') }}"
                                class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 
                                group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <x-icon code="mail" />
                                    <span class="truncate">Contacto</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    @if ($featured_categories->isNotEmpty())
                        <li class="pt-3">
                            <div class="text-xs font-semibold leading-6 text-gray-500
                            flex gap-1.5">
                                Destacados <x-icon code="local_fire_department" class="text-red-500 -mt-1" />
                            </div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                @foreach ($featured_categories->take(10) as $category)
                                    <li>
                                        <a href="{{ $category->pageUrl() }}"
                                        class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 
                                        group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            @if (!empty($category->image_url))
                                                <img src="{{ Storage::URL($category->image_url) }}" 
                                                class="w-6 h-6 rounded-full" alt="{{ $category->name }}">
                                            @endif
                                            <span class="truncate">{{ $category->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    @if ($product_collections->isNotEmpty())
                        <li class="pt-3">
                            <div class="text-xs font-semibold leading-6 text-gray-500
                            flex gap-1.5">
                                Colecciones
                            </div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                @foreach ($product_collections as $collection)
                                    <li>
                                        <a href="{{ $collection->ecommercePage() }}"
                                        class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 
                                        group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <span class="truncate">{{ $collection->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        
                    @endif

                    @if ($principal_categories->isNotEmpty())
                        <li class="pt-3">
                            <div class="text-xs font-semibold leading-6 text-gray-500
                            flex gap-1.5">
                                Categorías
                            </div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                @foreach ($principal_categories->take(10) as $category)
                                    <li>
                                        <a href="{{ $category->pageUrl() }}"
                                        class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 
                                        group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            @if (!empty($category->image_url))
                                                <img src="{{ Storage::URL($category->image_url) }}" 
                                                class="w-6 h-6 rounded-full" alt="{{ $category->name }}">
                                            @endif
                                            <span class="truncate">{{ $category->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    @if ($brands->isNotEmpty())
                        <li class="pt-3">
                            <div class="text-xs font-semibold leading-6 text-gray-500">
                                Marcas
                            </div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                @foreach ($brands->sortByDesc('featured')->take(10) as $brand)
                                    <li>
                                        <a href="{{ $brand->pageUrl() }}"
                                        class="text-gray-700 hover:text-blue-600 hover:bg-gray-50 
                                        group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            @if (!empty($brand->image_url))
                                                <img src="{{ Storage::URL($brand->image_url) }}" 
                                                class="w-6 h-6 rounded-full" alt="{{ $brand->name }}">
                                            @endif
                                            <span class="truncate">{{ $brand->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>