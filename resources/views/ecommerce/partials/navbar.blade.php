<header class="relative">
    <nav aria-label="Top">
        <div class="bg-{{ tenant('color') }}-600">
            <div class="mx-auto flex h-10 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

                <div class="flex items-center space-x-6 text-white">
                    <a href="{{ route('ecommerce.contact') }}" class="text-xs sm:text-sm font-medium">Contacto</a>
                    <a href="{{ route('ecommerce.about') }}" class="text-xs sm:text-sm font-medium">Nosotros</a>
                </div>

                <div class="flex items-center space-x-6 text-white">
                    <span @click="$dispatch('open-user-panel')" class="cursor-pointer text-xs sm:text-sm font-medium">
                        Ingresar | Registrarse
                    </span>
                </div>

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
                                <img class="h-12 w-32 object-contain" title="Inicio" alt="logo"
                                    src="{{ Storage::url(tenant()->logo_url) }}">
                            </a>
                        </div>

                        {{-- Items for navigation --}}
                        <div class="hidden h-full lg:flex">
                            <div class="ml-8">
                                <div class="flex h-full justify-center space-x-8">

                                    {{-- Categories menu --}}
                                    <div class="flex">
                                        <div class="relative flex">
                                            <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
                                            <button type="button"
                                                @click="megaMenu1Open = !megaMenu1Open; megaMenu2Open = false"
                                                class="relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out"
                                                :class="megaMenu1Open ?
                                                    'border-{{ tenant('color') }}-600 text-{{ tenant('color') }}-600' :
                                                    'border-transparent text-gray-700 hover:text-gray-800'"
                                                aria-expanded="false">Categorías</button>
                                        </div>

                                        <!-- 'Women' mega menu, show/hide based on flyout menu state. -->
                                        <div x-cloak x-show="megaMenu1Open" @click.away="megaMenu1Open = false"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 scale-90"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            class="absolute inset-x-0 top-full text-gray-500 sm:text-sm shadow-lg mt-px z-10">
                                            <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                                            <div class="absolute inset-0 top-1/2 bg-white" aria-hidden="true"></div>

                                            <div class="relative bg-white">
                                                <div class="mx-auto max-w-7xl px-8">
                                                    <div
                                                        class="grid grid-cols-2 items-start gap-x-8 gap-y-10 pb-12 pt-10">
                                                        <div class="grid grid-cols-2 gap-x-8 gap-y-10">
                                                            <div>
                                                                <p id="desktop-featured-heading-0"
                                                                    class="font-medium text-gray-900">Featured</p>
                                                                <ul role="list"
                                                                    aria-labelledby="desktop-featured-heading-0"
                                                                    class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Sleep</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Swimwear</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Underwear</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div>
                                                                <p id="desktop-categories-heading"
                                                                    class="font-medium text-gray-900">Categories
                                                                </p>
                                                                <ul role="list"
                                                                    aria-labelledby="desktop-categories-heading"
                                                                    class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Basic
                                                                            Tees</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Artwork
                                                                            Tees</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Bottoms</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Underwear</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Accessories</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-2 gap-x-8 gap-y-10">
                                                            <div>
                                                                <p id="desktop-collection-heading"
                                                                    class="font-medium text-gray-900">Collection
                                                                </p>
                                                                <ul role="list"
                                                                    aria-labelledby="desktop-collection-heading"
                                                                    class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Everything</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Core</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">New
                                                                            Arrivals</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Sale</a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <div>
                                                                <p id="desktop-brand-heading"
                                                                    class="font-medium text-gray-900">Brands</p>
                                                                <ul role="list"
                                                                    aria-labelledby="desktop-brand-heading"
                                                                    class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Full
                                                                            Nelson</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">My
                                                                            Way</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Re-Arranged</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Counterfeit</a>
                                                                    </li>
                                                                    <li class="flex">
                                                                        <a href="#"
                                                                            class="hover:text-gray-800">Significant
                                                                            Other</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                          focus:ring-gray-400/80 sm:text-sm sm:leading-6"
                                            placeholder="Buscar..." type="search">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Account & cart -->
                        <div class="flex flex-1 items-center justify-end">
                            <div class="flex items-center lg:ml-8 no-select">

                                <!-- wishlist -->
                                <x-icon code="favorite" x-tooltip.raw.placement.bottom="Favoritos"
                                    class="transition colors duration-300 ml-3
                                cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                hover:bg-gray-200 focus:outline-none focus:ring" />

                                <!-- Cart -->
                                @if (!Route::is('ecommerce.checkout'))
                                    <div class="relative ml-3">
                                        <x-icon code="shopping_cart" @click="cartMenuOpen = true"
                                            x-tooltip.raw.placement.bottom="Carrito"
                                            class="transition colors cursor-pointer bg-gray-100
                                        text-gray-600 p-2 rounded-full hover:bg-gray-200 
                                        focus:outline-none focus:ring duration-300" />

                                        @if (Cart::count() > 0)
                                            <x-badge color="green"
                                                class="absolute -bottom-3 right-0
                                            !rounded-full">
                                                {{ Cart::content()->count() }} </x-badge>
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
