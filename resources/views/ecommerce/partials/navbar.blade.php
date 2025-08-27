<header class="relative">
    <nav aria-label="Top">
        <div class="bg-{{ tenant('color') }}-600">
            <div class="mx-auto flex h-10 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

                <div class="flex items-center space-x-6 text-white">
                    <a href="{{ route('ecommerce.contact') }}" class="text-xs sm:text-sm font-medium">Contacto</a>
                    <!-- <a href="{{ route('ecommerce.about') }}" class="text-xs sm:text-sm font-medium">Nosotros</a> -->
                </div>

                @auth
                    <div x-data="{ openUserMenu: false }" class="relative">

                        <button @click="openUserMenu = !openUserMenu" type="button"
                            class="-m-1.5 flex items-center p-1.5 gap-x-2" id="user-menu-button" aria-expanded="false"
                            aria-haspopup="true">

                            <img class="h-8 w-8 rounded-full" src="{{ initialsAvatar() }}" alt="user avatar">

                            <div class="hidden lg:flex lg:items-center text-white">
                                <span class="text-sm font-semibold leading-6" aria-hidden="true">
                                    {{ Auth::user()->name }}
                                </span>
                                <x-icon code="keyboard_arrow_down" class="opacity-70" />
                            </div>
                        </button>

                        <div x-cloak x-show="openUserMenu" @click.away="openUserMenu = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 top-12 z-10 w-max origin-top-right rounded-md 
                        bg-white pb-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">

                            <div class="px-4 py-3 border-b" role="none">
                                <p class="text-sm font-semibold" role="none">{{ Auth::user()->full_name }}</p>
                                <p class="truncate text-xs font-medium text-gray-900" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>

                            <a href="{{ route('customer.orders.index') }}"
                                class="flex items-center gap-x-2 px-3 py-2 text-sm leading-6 
                            transition hover:bg-gray-50">
                                <x-icon code="shopping_bag" class="text-gray-700" style="font-size: 21px" />
                                Mis pedidos
                            </a>

                            <a href="{{ route('customer.settings') }}"
                                class="flex items-center gap-x-2 px-3 py-2 text-sm leading-6 
                            transition hover:bg-gray-50">
                                <x-icon code="settings" class="text-gray-700" style="font-size: 21px" />
                                Configuración
                            </a>

                            <form action="{{ route('customer.logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full text-left px-3 
                                py-2 gap-x-2 text-sm leading-6 text-red-500 transition hover:bg-gray-50">
                                    <x-icon code="logout" style="font-size: 21px" />
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-6 text-white">
                        <span @click="$dispatch('open-login-panel')" class="cursor-pointer text-xs sm:text-sm font-medium">
                            Ingresar | Registrarse
                        </span>
                    </div>
                @endauth

            </div>
        </div>
        <div class="bg-white z-30">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div>
                    <div class="flex h-16 items-center justify-between">

                        {{-- Ecommerce logo --}}
                        <div class="hidden lg:flex lg:items-center">
                            <a class="w-32" href="{{ route('ecommerce.index') }}">
                                <span class="sr-only">{{ tenant('name') }}</span>
                                <img class="h-12 w-32 object-contain object-center" title="Inicio" alt="logo"
                                    src="{{ Storage::url(tenant()->logo_url) }}">
                            </a>
                        </div>

                        {{-- Items for navigation --}}
                        <div class="hidden h-full lg:flex">
                            <div class="ml-8">
                                <div class="flex h-full justify-center space-x-8">

                                    {{-- Categories menu --}}
                                    <div x-data="{open: false}" class="flex">
                                        <div class="relative flex">
                                            <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
                                            <button type="button"
                                                @click="open = !open"
                                                class="relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out"
                                                :class="open ? 'border-{{ tenant('color') }}-600 text-{{ tenant('color') }}-600' 
                                                             : 'border-transparent text-gray-700 hover:text-gray-800'">
                                                    Categorías
                                            </button>

                                            <div x-cloak x-show="open" @click.away="open = false" 
                                            x-transition:enter="transition ease-out duration-200" 
                                            x-transition:enter-start="opacity-0 translate-y-1" 
                                            x-transition:enter-end="opacity-100 translate-y-0" 
                                            x-transition:leave="transition ease-in duration-150" 
                                            x-transition:leave-start="opacity-100 translate-y-0" 
                                            x-transition:leave-end="opacity-0 translate-y-1" 
                                            class="absolute z-10 top-[4.5rem] -left-4 p-4 
                                            whitespace-nowrap rounded-xl shadow-lg ring-1 
                                            ring-gray-900/5 bg-white">

                                                <div class="flex gap-y-6 gap-x-10 bg-white text-gray-900 ">

                                                    @if ($principal_categories->isNotEmpty())
                                                        <div class="flex flex-col w-max">
                                                            <p class="p-2 font-semibold">Principales</p>
                                                            @foreach ($principal_categories->take(6) as $category)
                                                                <a href="{{ $category->pageUrl() }}" 
                                                                class="inline-block p-2 text-sm hover:text-blue-600">
                                                                    {{ $category->name }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    @if ($featured_categories->isNotEmpty())
                                                        <div class="flex flex-col w-max">
                                                            <p class="p-2 font-semibold">Destacadas</p>
                                                            @foreach ($featured_categories->take(6) as $category)
                                                                <a href="{{ $category->pageUrl() }}" 
                                                                class="inline-block p-2 text-sm hover:text-blue-600">
                                                                    {{ $category->name }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    @if ($brands->isNotEmpty())
                                                        <div class="flex flex-col w-max">
                                                            <p class="p-2 font-semibold">Marcas</p>
                                                            @foreach ($brands->sortByDesc('featured')->take(6) as $brand)
                                                                <a href="{{ $brand->pageUrl() }}" 
                                                                class="flex items-center gap-1.5 p-2 text-sm hover:text-blue-600">
                                                                    @if (!empty($brand->image_url))
                                                                        <img src="{{ Storage::url($brand->image_url) }}"
                                                                        alt="{{ $brand->name }}"
                                                                        class="w-6 h-6 object-contain rounded-full">
                                                                    @endif
                                                                    {{ $brand->name }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    @if ($product_collections->isNotEmpty())
                                                        <div class="flex flex-col w-max">
                                                            <p class="p-2 font-semibold">Colecciones</p>
                                                            @foreach ($product_collections as $collection)
                                                                <a href="{{ $collection->ecommercePage() }}" 
                                                                class="flex items-center gap-1.5 p-2 text-sm hover:text-blue-600">
                                                                    {{ $collection->name }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>

                                                <a href="{{ route('ecommerce.products') }}" 
                                                class="flex items-center gap-1.5 mt-6 pt-2 border-t text-sm
                                                transition-colors duration-300 hover:text-blue-600">
                                                    Ver todos los productos
                                                    <x-icon code="arrow_forward" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Products --}}
                                    <a href="{{ route('ecommerce.products') }}"
                                        class="flex items-center text-sm font-medium border-b-2
                                    {{ Route::is('ecommerce.products')
                                        ? "border-$tenantColor-600 text-$tenantColor-600"
                                        : 'border-transparent text-gray-700 hover:text-gray-800' }}">
                                        Productos
                                    </a>

                                    {{-- Offers --}}
                                    {{-- <a href="{{ route('ecommerce.products') }}"
                                        class="flex items-center text-sm font-medium border-b-2
                                    {{ Route::is('ecommerce.products')
                                        ? "border-$tenantColor-600 text-$tenantColor-600"
                                        : 'border-transparent text-gray-700 hover:text-gray-800' }}">
                                        Ofertas
                                    </a> --}}

                                </div>
                            </div>
                        </div>

                        <!-- Mobile menu toggle -->
                        <div class="flex flex-1 items-center lg:hidden">
                            <x-icon @click="mobileMenuOpen = true" code="menu"
                                class="transition colors duration-300 cursor-pointer text-gray-600 mr-2 focus:outline-none focus:ring" />
                        </div>

                        <!-- Main search -->
                        <div class="pl-0 lg:pl-12 w-full">
                            <div
                                class="flex items-center px-2 py-4 md:mx-auto md:max-w-3xl lg:mx-0 lg:max-w-none xl:px-0">
                                <div class="w-full">
                                    <label for="search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <x-icon code="search" class="text-gray-400" />
                                        </div>
                                        <input id="search" autocomplete="off" name="search"
                                            class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 
                                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 
                                          focus:ring-blue-500 text-sm sm:leading-6"
                                            placeholder="¿Qué estás buscando?" type="search">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist & Cart -->
                        <div class="flex flex-1 items-center justify-end">
                            <div class="flex items-center lg:ml-4 no-select">

                                @auth
                                    {{-- Wishlist --}}
                                    @livewire('ecommerce.wishlist')
                                @endauth

                                {{-- Cart --}}
                                @if (!Route::is('ecommerce.checkout'))
                                    <div class="relative ml-3">
                                        <x-icon code="shopping_cart" @click="cartMenuOpen = true"
                                        x-tooltip.raw.placement.bottom="Carrito"
                                        class="transition colors cursor-pointer bg-gray-100
                                        text-gray-600 p-2 rounded-full hover:bg-gray-200 
                                        focus:outline-none focus:ring duration-300" />

                                        @if (Cart::count() > 0)
                                            <span class="absolute -top-2 -right-2 inline-flex items-center 
                                            justify-center w-5 h-5 text-xs font-semibold text-white bg-green-600 
                                            rounded-full ring-1 ring-white">
                                                {{ Cart::count() }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
