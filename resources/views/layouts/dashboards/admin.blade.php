<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&loading=async&libraries=marker&v=beta" defer></script>
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
                l1-1 2s  infinite,
                l1-2 .5s infinite;
        }
        #main-loader:after {
            background:#fff;
            animation-delay: -1s,0s;
            box-shadow: 2px 2px 6px #999;
        }
        @keyframes l1-1 {
            0%   {top:0   ;left:0}
            25%  {top:100%;left:0}
            50%  {top:100%;left:100%}
            75%  {top:0   ;left:100%}
            100% {top:0   ;left:0}
        }
        @keyframes l1-2 {
            80%,100% {transform: rotate(0.5turn)}
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/alpine-tooltip@1.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    <title>@yield('title', 'Panel de comercio')</title>
    @yield('head')
</head>

<body x-data="{mobileMenuOpen: false}" class="min-h-screen overflow-y-auto">

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
                        <div class="flex h-20 shrink-0 items-center">
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
                                class="block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm"
                                placeholder="Search..." type="search" name="search">
                        </form>

                        <!-- Notifications & User menu -->
                        <div class="flex items-center gap-x-4">

                            <!-- Ecommerce site link -->
                            <a href="/" target="_blank" x-tooltip.raw.placement.bottom="Ver mi tienda"
                                class="relative mr-3 pt-2 text-gray-400 transition hover:text-gray-500">
                                <x-icon code="storefront" />
                            </a>

                            <!-- Notifications -->
                            @livewire('admin.notifications')

                            <!-- Separator -->
                            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"></div>

                            <!-- Profile dropdown -->
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
                                    <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900 
                                    transition hover:bg-gray-50">
                                        Mi perfil
                                    </a>
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-3 py-1 text-sm leading-6 text-red-500 transition hover:bg-gray-50">
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

    {{-- Custom page sripts --}}
    @yield('scripts')
</body>
</html>
