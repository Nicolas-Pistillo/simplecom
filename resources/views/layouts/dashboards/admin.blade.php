<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&loading=async&libraries=marker&v=beta"
        defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #main-loader {
            width: 40px;
            aspect-ratio: 1;
            position: relative;
        }

        #main-loader:before,
        #main-loader:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            margin: -8px 0 0 -8px;
            width: 16px;
            aspect-ratio: 1;
            background: #2563eb;
            box-shadow: 2px 2px 6px #999;
            animation:
                l1-1 2s infinite,
                l1-2 .5s infinite;
        }

        #main-loader:after {
            background: #fff;
            animation-delay: -1s, 0s;
            box-shadow: 2px 2px 6px #999;
        }

        @keyframes l1-1 {
            0% {
                top: 0;
                left: 0
            }

            25% {
                top: 100%;
                left: 0
            }

            50% {
                top: 100%;
                left: 100%
            }

            75% {
                top: 0;
                left: 100%
            }

            100% {
                top: 0;
                left: 0
            }
        }

        @keyframes l1-2 {

            80%,
            100% {
                transform: rotate(0.5turn)
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/alpine-tooltip@1.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    <title>@yield('title', 'Panel de comercio')</title>
    @yield('head')
</head>

<body x-data="{ mobileMenuOpen: false }" class="min-h-screen overflow-y-auto">

    {{-- Global notification --}}
    @livewire('notification')

    <div>
        {{-- Mobile menu --}}
        <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true">

            <div x-cloak x-show="mobileMenuOpen" class="fixed inset-0 bg-gray-900/80"
                x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

            <div x-cloak x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" x-cloak
                x-show="mobileMenuOpen" class="fixed inset-0 flex">

                <div @click.away="mobileMenuOpen = false" class="relative mr-16 flex w-full max-w-xs flex-1">
                    <div x-cloak x-show="mobileMenuOpen" x-transition:enter="ease-in-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <x-icon @click="mobileMenuOpen = false" code="close"
                            class="ml-5 p-2 bg-white text-black cursor-pointer rounded-full border" />
                    </div>

                    <!-- Mobile sidebar -->
                    <div scrollbar-thin class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 py-4">
                        <div class="flex h-20 shrink-0 items-center mx-auto">
                            <img src="{{ tenant()->logo() }}" class="h-full object-contain py-1" alt="ecommerce logo">
                        </div>
                        <hr>
                        @include('admin.navbar')
                    </div>
                </div>
            </div>
        </div>

        {{-- Desktop menu --}}
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-40 lg:flex lg:w-72 lg:flex-col">
            <!-- Desktop sidebar -->
            <div class="flex grow flex-col gap-y-5 bg-white px-6 py-4 border-r" hover-scrollbar scrollbar-thin>
                <div class="flex h-20 shrink-0 items-center">
                    <img src="{{ tenant()->logo() }}" class="h-full object-contain" alt="ecommerce logo">
                </div>
                <hr>
                @include('admin.navbar')
            </div>
        </div>

        {{-- Content --}}
        <div class="lg:pl-72">

            {{-- Page header --}}
            <div id="main-header" class="hidden sticky top-0 z-40 w-full lg:px-6">
                <div
                    class="flex h-16 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-0 lg:shadow-none">
                    <button @click="mobileMenuOpen = true" type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>

                    <!-- Separator -->
                    <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true"></div>

                    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">

                        <!-- Main search -->
                        <form class="relative flex flex-1" action="#" method="GET">
                            <label for="search-field" class="sr-only">Search</label>
                            <svg class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <input id="search-field"
                                class="block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 
                            placeholder:text-gray-400 focus:ring-0 text-sm"
                                placeholder="Buscar..." type="search" autocomplete="off" name="search">
                        </form>

                        <!-- Notifications & User menu -->
                        <div class="no-select flex items-center justify-center gap-x-2 sm:gap-x-4">

                            {{-- Ecommerce site link --}}
                            <a href="{{ route('ecommerce.index') }}" target="_blank"
                                x-tooltip.raw.placement.bottom="Ver mi tienda"
                                class="hidden sm:block relative pt-2 text-gray-400 transition hover:text-gray-500">
                                <x-icon code="storefront" />
                            </a>

                            {{-- Origin point selector --}}
                            @livewire('admin.origin-point-navbar')

                            {{-- Notifications --}}
                            @livewire('admin.notifications')

                            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"></div>

                            {{-- User panel --}}
                            <div x-data="{ openUserMenu: false }" class="relative">
                                <button @click="openUserMenu = !openUserMenu" type="button"
                                    class="-m-1.5 flex items-center p-1.5" id="user-menu-button"
                                    aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full bg-gray-50"
                                        src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&bold=true&background=e5e7eb&color=000"
                                        alt="user avatar">
                                    <span class="hidden lg:flex lg:items-center">
                                        <span class="ml-3 text-sm font-semibold leading-6 text-gray-900"
                                            aria-hidden="true"> {{ Auth::user()->name }} </span>
                                        <x-icon code="keyboard_arrow_down" class="text-gray-900" />
                                        </svg>
                                    </span>
                                </button>

                                <div x-cloak x-show="openUserMenu" @click.away="openUserMenu = false"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute right-0 top-12 z-10 w-32 origin-top-right rounded-md 
                                  bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                                    <a href="#"
                                        class="block px-3 py-1 text-sm leading-6 text-gray-900 
                                    transition hover:bg-gray-50">
                                        Mi perfil
                                    </a>
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-3 py-1 text-sm leading-6 text-red-500 transition hover:bg-gray-50">
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content view --}}
            <main id="main-content" class="relative p-6 h-screen overflow-hidden">

                {{-- Page loader --}}
                <div id="main-loader-container" class="absolute z-20 top-0 left-0 w-full h-full bg-gray-50">
                    <div class="relative h-full flex flex-col justify-center items-center">
                        <div id="main-loader" class="mb-8"></div>
                        <h3 class="text-gray-700 font-semibold">Cargando...</h3>
                    </div>
                </div>

                {{-- Page content --}}
                @yield('content')

            </main>
        </div>
    </div>

    {{-- Loader remove --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('main-content').classList.remove('h-screen', 'overflow-hidden');
            document.getElementById('main-header').classList.remove('hidden');
            document.getElementById('main-loader-container').remove();
        })
    </script>

    {{-- Widget contacto soporte
    
    <div id="web3forms__widget" x-data="{ open: false }">
        <!-- x-init is only for demo purpose. you may remove it.  -->
        <div x-cloak id="w3f__widget--content" x-show="open" x-transition:enter-start="opacity-0 translate-y-5"
            x-transition:enter="transition duration-200 transform ease"
            x-transition:leave="transition duration-200 transform ease"
            x-transition:leave-end="opacity-0 translate-y-5" @click.away="open = false"
            class="fixed flex flex-col z-50 bottom-[100px] top-0 right-0 h-auto left-0 sm:top-auto sm:right-5 sm:left-auto h-[calc(100%-95px)] w-full sm:w-[350px] overflow-auto min-h-[250px] sm:h-[600px] border border-gray-300 bg-white shadow-2xl rounded-md">
            <div class="flex p-5 flex-col justify-center items-center h-32 bg-blue-600">
                <h3 class="text-lg text-white">How can we help?</h3>
                <p class="text-white opacity-50">We usually respond in a few hours</p>
            </div>
            <div class="bg-gray-50 flex-grow p-6">

                <form action="https://api.web3forms.com/submit" method="POST" id="form"
                    class="needs-validation" novalidate>
                    <input type="hidden" name="apikey" value="YOUR_ACCESS_KEY_HERE" />
                    <input type="hidden" name="subject" value="New Submission from Web3Forms" />
                    <input type="checkbox" name="botcheck" id="" style="display: none;" />


                    <div class="mb-4">
                        <label for="full_name" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Full
                            Name</label>
                        <input type="text" name="name" id="full_name" placeholder="John Doe" required
                            class="w-full px-3 py-2 bg-white placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-300" />
                    </div>




                    <div class="mb-4">
                        <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Email
                            Address</label>
                        <input type="email" name="email" id="email" placeholder="you@company.com" required
                            class="w-full px-3 py-2 bg-white placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-300" />
                    </div>


                    <div class="mb-4">
                        <label for="message" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Your
                            Message</label>

                        <textarea rows="4" name="message" id="message" placeholder="Your Message"
                            class="w-full h-28 px-3 py-2 bg-white placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-300"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <x-button size="large" class="w-full">Enviar mensaje</x-button>
                    </div>
                </form>
            </div>
        </div>
        <button x-cloak id="w3f__widget--btn" @click="open = !open"
            class="fixed z-40 right-5 bottom-5 shadow-lg flex justify-center items-center w-14 h-14 bg-blue-500 rounded-full focus:outline-none hover:bg-blue-600 focus:bg-blue-600 transition duration-300 ease">
            <svg class="w-6 h-6 text-white absolute" x-show="!open"
                x-transition:enter-start="opacity-0 -rotate-45 scale-75"
                x-transition:enter="transition duration-200 transform ease"
                x-transition:leave="transition duration-100 transform ease"
                x-transition:leave-end="opacity-0 -rotate-45" xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>

            <svg class="w-6 h-6 text-white absolute" x-show="open"
                x-transition:enter-start="opacity-0 rotate-45 scale-75"
                x-transition:enter="transition duration-200 transform ease"
                x-transition:leave="transition duration-100 transform ease"
                x-transition:leave-end="opacity-0 rotate-45" xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

    </div> --}}

    {{-- Widget botones deplegables hacia arriba

    <div x-data="floatingMenu()" 
     x-init="init()"
     class="fixed bottom-8 right-8 z-50">

    <!-- Botón principal -->
    <button @click="toggle()" :class="{'rotate-45 bg-red-500': isOpen, 'bg-blue-600': !isOpen}"
        class="p-4 rounded-full text-white shadow-lg hover:shadow-xl transition-all duration-300 transform focus:outline-none">
        <x-icon code="add" class="w-6 h-6" />
    </button>
    
    <!-- Botones secundarios - Ahora en columna hacia arriba -->
    <div class="absolute bottom-full right-0 mb-4 flex flex-col items-end space-y-3">
        <template x-for="(item, index) in items" :key="index">
            <a :href="item.link"
               x-show="isOpen"
               x-tooltip.placement.left="item.tooltip"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="opacity-0 translate-y-4"
               x-transition:enter-end="opacity-100 translate-y-0"
               x-transition:leave="transition ease-in duration-200"
               x-transition:leave-start="opacity-100 translate-y-0"
               x-transition:leave-end="opacity-0 translate-y-4"
               class="flex items-center justify-center p-3 rounded-full text-white shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-110"
               :class="item.color">
                <span x-text="item.icon" class="text-xl"></span>
                <span class="absolute -right-2 -top-2 bg-red-500 text-xs rounded-full h-5 w-5 flex items-center justify-center" 
                      x-show="item.badge" 
                      x-text="item.badge"></span>
                <span x-show="isOpen" class="absolute right-full mr-2 px-2 py-1 text-xs whitespace-nowrap rounded bg-gray-800 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200"></span>
            </a>
        </template>
    </div> 
</div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('floatingMenu', () => ({
                isOpen: false,
                items: [
                    { icon: '📊', link: '#', color: 'bg-green-500', badge: '3', tooltip: 'Reportes' },
                    { icon: '✉️', link: '#', color: 'bg-yellow-500', tooltip: 'Mensajes' },
                    { icon: '👥', link: '#', color: 'bg-purple-500', badge: '1', tooltip: 'Usuarios' },
                    { icon: '⚙️', link: '#', color: 'bg-gray-500', tooltip: 'Configuración' },
                    { icon: '➕', link: '#', color: 'bg-pink-500', tooltip: 'Nuevo Item' }
                ],
                
                init() {
                    // Cerrar al hacer click fuera
                    document.addEventListener('click', (e) => {
                        if (!this.$el.contains(e.target) && this.isOpen) {
                            this.close();
                        }
                    });
                },
                
                toggle() {
                    this.isOpen ? this.close() : this.open();
                },
                
                open() {
                    this.isOpen = true;
                },
                
                close() {
                    this.isOpen = false;
                }
            }));
        });
    </script>

    --}}

    {{-- Custom page sripts --}}
    @yield('end-body')
</body>

</html>
