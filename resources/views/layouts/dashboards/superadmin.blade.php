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
    <script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/alpine-tooltip@1.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <title>@yield('title', 'Simplecom - Superadmin')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @yield('head')
</head>

<body>
    <div class="min-h-full">

        {{-- Global notifications --}}
        @livewire('notification')

        <nav x-data="{ open: false }" class="fixed w-full z-20 bg-white shadow-sm border-b">
            <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
                <div class="flex h-16 justify-between">
                    <div class="flex px-2 lg:px-0">
                        <div class="flex shrink-0 items-center">
                            <img class="h-12" src="{{ asset('img/simplecom/png/logo-simple-black.png') }}"
                                alt="Logo" title="Simplecom">
                        </div>
                        <div class="hidden md:ml-6 md:flex md:space-x-8">

                            <a href="{{ route('superadmin.dashboard.index') }}" 
                            class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium transition duration-300
                            {{ Route::is('superadmin.dashboard.index') 
                            ? 'border-blue-600 text-gray-900' 
                            : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                                Dashboard
                            </a>

                            <a href="{{ route('superadmin.tenants.index') }}" 
                            class="inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium transition duration-300
                            {{ Route::is('superadmin.tenants.*') 
                            ? 'border-blue-600 text-gray-900' 
                            : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                                Comercios
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-1 items-center justify-center px-2 md:ml-6 md:justify-end">
                        <div class="grid w-full max-w-lg grid-cols-1 md:max-w-xs">
                            <input type="search" name="search"
                            class="col-start-1 row-start-1 block w-full rounded-md bg-white py-1.5 pr-3 outline-none pl-10 text-gray-900 border-gray-300 placeholder:text-gray-400 text-sm/6"
                            placeholder="Buscar...">
                            <svg class="pointer-events-none col-start-1 row-start-1 ml-3 h-5 self-center text-gray-400"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center md:hidden">
                        <!-- Mobile menu button -->
                        <button type="button" class="relative inline-flex items-center 
                        justify-center rounded-md p-2 bg-gray-100 text-gray-500
                        transition duration-300 hover:bg-gray-200"
                            aria-controls="mobile-menu" @click="open = !open" aria-expanded="false"
                            x-bind:aria-expanded="open.toString()">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open main menu</span>
                            <svg x-description="Icon when menu is closed." x-state:on="Menu open"
                                x-state:off="Menu closed" class="block h-5"
                                :class="{ 'hidden': open, 'block': !(open) }" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                            </svg>
                            <svg x-description="Icon when menu is open." x-state:on="Menu open"
                                x-state:off="Menu closed" class="hidden h-5"
                                :class="{ 'block': open, 'hidden': !(open) }" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="hidden md:ml-4 md:flex md:items-center">

                        <!-- Notifications -->
                        <button type="button" class="relative ml-auto shrink-0 rounded-full 
                        bg-white text-gray-400 hover:text-gray-500">
                            <x-icon code="notifications" class="transition colors cursor-pointer 
                            bg-gray-100 text-gray-600 p-1.5 rounded-full hover:bg-gray-200 duration-300" />
                        </button>

                        <!-- Profile dropdown -->
                        <div x-data="{open: false}" class="relative ml-4 shrink-0">
                            <div>
                                <button type="button" @click="open = !open"
                                class="relative flex rounded-full bg-white text-sm">
                                    <img class="w-9 h-9 rounded-full"
                                    src="{{ initialsAvatar(['name' => Auth::user()->name, 'background' => '#2563eb', 'color' => '#fff']) }}"
                                    alt="User avatar">
                                </button>
                            </div>

                            <div x-cloak x-show="open" @click.away="open = false"
                                    x-transition:enter.duration.300ms x-transition:leave.duration.300ms
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md 
                                    bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="px-4 py-3 border-b" role="none">
                                        <p class="text-sm font-semibold" role="none"> {{ Auth::user()->name }} </p>
                                        <p class="truncate text-xs font-medium text-gray-900" role="none">
                                            {{ Auth::user()->email }} </p>
                                    </div>
                                    <form action="{{ route('superadmin.logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="block w-full text-left 
                                        px-4 py-2 text-sm text-red-500
                                        transition duration-300 hover:bg-gray-50">
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </div>

                        </div>
                    </div>
                </div>
            </div>

            <div x-cloak x-show="open" @click.away="open = false" x-collapse.duration.300
            class="md:hidden">
                <div class="space-y-1 pt-2 pb-3">
                    
                    <a href="{{ route('superadmin.dashboard.index') }}" 
                    class="block border-l-4 py-2 pr-4 pl-3 text-base font-medium
                    {{ Route::is('superadmin.dashboard.index') 
                    ? 'bg-blue-50 border-blue-500 text-blue-700' 
                    : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('superadmin.tenants.index') }}" 
                    class="block border-l-4 py-2 pr-4 pl-3 text-base font-medium
                    {{ Route::is('superadmin.tenants.*') 
                    ? 'bg-blue-50 border-blue-500 text-blue-700' 
                    : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                        Comercios
                    </a>
                </div>
                <div class="border-t border-gray-200 pt-4 pb-3">
                    <div class="flex items-center px-4">
                        <div class="shrink-0">
                            <img class="w-10 h-10 rounded-full"
                            src="{{ initialsAvatar(['name' => Auth::user()->name, 'background' => '#2563eb', 'color' => '#fff']) }}"
                            alt="User Avatar">
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        <button type="button" class="relative ml-auto shrink-0 rounded-full 
                        bg-white p-1 text-gray-400 hover:text-gray-500">
                            <x-icon code="notifications" class="transition colors cursor-pointer bg-gray-100
                            text-gray-600 p-2 rounded-full hover:bg-gray-200 duration-300" />
                        </button>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Settings</a>
                        <form action="{{ route('superadmin.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="block w-full text-left 
                            px-4 py-2 text-base text-red-500
                            transition duration-300 hover:bg-gray-50">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="pt-20">
            <div class="mx-auto max-w-7xl py-6 px-3 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

    </div>
</body>

</html>
