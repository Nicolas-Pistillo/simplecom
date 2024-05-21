@php
  $tenantColor = tenant('color')
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/alpine-tooltip@1.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ URL::to('favicon-store-default.png') }}" type="image/x-icon">
    <style> [x-cloak] { display: none !important; } [data-carousel-item] { z-index: 5; } </style>
    <title>@yield('title', tenant()->ecommerce_name ?? tenant()->name)</title>
    @yield('head')
</head>
<body>
    @yield('begin-body')

    <!-- Navbar -->
    <div class="bg-white fixed w-full shadow-md z-10" 
    x-data="{megaMenu1Open: false, megaMenu2Open: false, mobileMenuOpen: false, cartMenuOpen: false}">

        <!-- Breaking news Banner -->
        {{-- <div class="relative isolate flex items-center gap-x-6 overflow-hidden bg-gray-50 px-6 py-2.5 sm:px-3.5 sm:before:flex-1">
            <div class="absolute left-[max(-7rem,calc(50%-52rem))] top-1/2 -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
            <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)"></div>
            </div>
            <div class="absolute left-[max(45rem,calc(50%+8rem))] top-1/2 -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
            <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)"></div>
            </div>
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
            <p class="text-sm leading-6 text-gray-900">
                <strong class="font-semibold">GeneriCon 2023</strong><svg viewBox="0 0 2 2" class="mx-2 inline h-0.5 w-0.5 fill-current" aria-hidden="true"><circle cx="1" cy="1" r="1" /></svg>Join us in Denver from June 7 – 9 to see what’s coming next.
            </p>
            <a href="#" class="flex-none rounded-full bg-gray-900 px-3.5 py-1 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">Register now <span aria-hidden="true">&rarr;</span></a>
            </div>
            <div class="flex flex-1 justify-end">
            <button type="button" class="-m-3 p-3 focus-visible:outline-offset-[-4px]">
                <span class="sr-only">Dismiss</span>
                <svg class="h-5 w-5 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                </svg>
            </button>
            </div>
        </div> --}}

        <!-- Mobile menu -->
        <div x-cloak x-show="mobileMenuOpen" 
        class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
            <!-- Off-canvas menu backdrop -->
            <div x-show="mobileMenuOpen" 
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50"></div>

            <!-- Off-canvas menu sidebar -->
            <div class="fixed inset-0 z-40 flex">
                <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl">

                    <!-- Brand logo -->
                    <img src="{{ Storage::url(tenant()->logo_url) }}" alt="Ecommerce logo" 
                    class="h-24 p-3 object-contain shadow relative">

                    <!-- Links -->
                    <nav class="flex flex-1 flex-col m-4">
                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                        <a href="#" class="bg-gray-50 text-indigo-600 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <svg class="h-6 w-6 shrink-0 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                                            </svg>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                                            </svg>
                                            Team
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"></path>
                                            </svg>
                                            Projects
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"></path>
                                            </svg>
                                            Calendar
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"></path>
                                            </svg>
                                            Documents
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z"></path>
                                            </svg>
                                            Reports
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="text-xs font-semibold leading-6 text-gray-400">Your teams</div>
                                <ul role="list" class="-mx-2 mt-2 space-y-1">
                                    <li>
                                        <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">H</span>
                                            <span class="truncate">Heroicons</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">T</span>
                                            <span class="truncate">Tailwind Labs</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-gray-50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">W</span>
                                            <span class="truncate">Workcation</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="mt-auto">
                                <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                    <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <header class="relative">
            <nav aria-label="Top">
                <!-- Secondary navigation -->
                <div class="bg-white">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div>
                            <div class="flex h-16 items-center justify-between">
                                <!-- Logo (lg+) -->
                                <div class="hidden lg:flex lg:items-center">
                                    <a class="w-32" href="{{ route('ecommerce.index') }}">
                                        <span class="sr-only">Your Company</span>
                                        <img class="h-12 w-32 object-contain" title="Inicio" alt="logo"
                                        src="{{ Storage::url(tenant()->logo_url) }}">
                                    </a>
                                </div>

                                <!-- Items for navigation -->
                                <div class="hidden h-full lg:flex">                                
                                    <div class="ml-8">
                                        <div class="flex h-full justify-center space-x-8">

                                            <!-- Mega menu 1 -->
                                            <div class="flex">
                                                <div class="relative flex">
                                                    <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
                                                    <button type="button" @click="megaMenu1Open = !megaMenu1Open; megaMenu2Open = false"
                                                        class="relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out"
                                                        :class="megaMenu1Open ? 'border-{{ tenant('color') }}-600 text-{{ tenant('color') }}-600' : 'border-transparent text-gray-700 hover:text-gray-800'"
                                                        aria-expanded="false">Women</button>
                                                </div>

                                                <!-- 'Women' mega menu, show/hide based on flyout menu state. -->
                                                <div x-cloak x-show="megaMenu1Open" @click.away="megaMenu1Open = false" 
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-90"
                                                x-transition:enter-end="opacity-100 scale-100" 
                                                class="absolute inset-x-0 top-full text-gray-500 sm:text-sm shadow-lg mt-px z-10">
                                                    <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                                                    <div class="absolute inset-0 top-1/2 bg-white"
                                                        aria-hidden="true"></div>

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
                                                                                    class="hover:text-gray-800">My Way</a>
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

                                            <!-- Mega menu 2 -->
                                            <div class="flex">
                                                <div class="relative flex">
                                                    <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
                                                    <button type="button" @click="megaMenu2Open = !megaMenu2Open; megaMenu1Open = false"
                                                        class="relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out"
                                                        :class="megaMenu2Open ? 'border-{{ tenant('color') }}-600 text-{{ tenant('color') }}-600' : 'border-transparent text-gray-700 hover:text-gray-800'"
                                                        aria-expanded="false">Men</button>
                                                </div>

                                                <!-- 'Men' mega menu, show/hide based on flyout menu state. -->
                                                <div x-cloak x-show="megaMenu2Open" @click.away="megaMenu2Open = false" 
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-90"
                                                x-transition:enter-end="opacity-100 scale-100" 
                                                class="absolute inset-x-0 top-full text-gray-500 sm:text-sm shadow-lg mt-px z-10">
                                                    <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                                                    <div class="absolute inset-0 top-1/2 bg-white"
                                                        aria-hidden="true"></div>

                                                    <div class="relative bg-white">
                                                        <div class="mx-auto max-w-7xl px-8">
                                                            <div
                                                                class="grid grid-cols-2 items-start gap-x-8 gap-y-10 pb-12 pt-10">
                                                                <div class="grid grid-cols-2 gap-x-8 gap-y-10">
                                                                    <div>
                                                                        <p id="desktop-featured-heading-1"
                                                                            class="font-medium text-gray-900">Featured</p>
                                                                        <ul role="list"
                                                                            aria-labelledby="desktop-featured-heading-1"
                                                                            class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                            <li class="flex">
                                                                                <a href="#"
                                                                                    class="hover:text-gray-800">Casual</a>
                                                                            </li>
                                                                            <li class="flex">
                                                                                <a href="#"
                                                                                    class="hover:text-gray-800">Boxers</a>
                                                                            </li>
                                                                            <li class="flex">
                                                                                <a href="#"
                                                                                    class="hover:text-gray-800">Outdoor</a>
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
                                                                                    class="hover:text-gray-800">Artwork
                                                                                    Tees</a>
                                                                            </li>
                                                                            <li class="flex">
                                                                                <a href="#"
                                                                                    class="hover:text-gray-800">Pants</a>
                                                                            </li>
                                                                            <li class="flex">
                                                                                <a href="#"
                                                                                    class="hover:text-gray-800">Accessories</a>
                                                                            </li>
                                                                            <li class="flex">
                                                                                <a href="#"
                                                                                    class="hover:text-gray-800">Boxers</a>
                                                                            </li>
                                                                            <li class="flex">
                                                                                <a href="#"
                                                                                    class="hover:text-gray-800">Basic
                                                                                    Tees</a>
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
                                                                                    class="hover:text-gray-800">Significant
                                                                                    Other</a>
                                                                            </li>
                                                                            <li class="flex">
                                                                                <a href="#"
                                                                                    class="hover:text-gray-800">My Way</a>
                                                                            </li>
                                                                            <li class="flex">
                                                                                <a href="#"
                                                                                    class="hover:text-gray-800">Counterfeit</a>
                                                                            </li>
                                                                            <li class="flex">
                                                                                <a href="#"
                                                                                    class="hover:text-gray-800">Re-Arranged</a>
                                                                            </li>
                                                                            <li class="flex">
                                                                                <a href="#"
                                                                                    class="hover:text-gray-800">Full
                                                                                    Nelson</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Other navigation links -->
                                            <a href="{{ route('ecommerce.about') }}" 
                                            class="flex items-center text-sm font-medium text-gray-700 border-b-2
                                            {{
                                                Route::is('ecommerce.about')
                                                    ? "border-$tenantColor-600 text-$tenantColor-600"
                                                    : "border-transparent text-gray-700 hover:text-gray-800";
                                            }}">
                                                Nosotros
                                            </a>

                                            <a href="{{ route('ecommerce.contact') }}"
                                            class="flex items-center text-sm font-medium text-gray-700 border-b-2
                                            {{
                                                Route::is('ecommerce.contact')
                                                    ? "border-$tenantColor-600 text-$tenantColor-600"
                                                    : "border-transparent text-gray-700 hover:text-gray-800";
                                            }}">
                                                Contacto
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mobile menu toggle -->
                                <div class="flex flex-1 items-center lg:hidden">
                                    <x-icon @click="mobileMenuOpen = true" code="menu" class="transition colors duration-300 cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none focus:ring" />
                                </div>

                                <!-- Main search -->
                                <div class="pl-0 lg:pl-12 w-full">
                                    <div class="flex items-center px-2 py-4 md:mx-auto md:max-w-3xl lg:mx-0 lg:max-w-none xl:px-0">
                                      <div class="w-full">
                                        <label for="search" class="sr-only">Search</label>
                                        <div class="relative">
                                          <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                            <x-icon code="search" class="text-gray-400" />
                                          </div>
                                          <input id="search" autocomplete="off" name="search" class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 
                                          ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 
                                          focus:ring-gray-500 sm:text-sm sm:leading-6" placeholder="Buscar..." type="search">
                                        </div>
                                      </div>
                                    </div>
                                </div>

                                <!-- Account & cart -->
                                <div class="flex flex-1 items-center justify-end">
                                    <div class="flex items-center lg:ml-8">

                                        <!-- Account -->
                                        <x-icon code="person" x-tooltip.raw.placement.bottom="Mi cuenta"
                                        class="transition colors duration-300 
                                        cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                        hover:bg-gray-200 focus:outline-none focus:ring" />

                                        <span class="mx-4 h-6 w-px bg-gray-200" aria-hidden="true"></span>

                                        <!-- Cart -->
                                        <x-icon code="shopping_cart" @click="cartMenuOpen = true" 
                                        x-tooltip.raw.placement.bottom="Carrito"
                                        class="transition colors cursor-pointer bg-gray-100
                                        text-gray-600 p-2 rounded-full hover:bg-gray-200 
                                        focus:outline-none focus:ring duration-300" /> 
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Cart Drawer -->
        @livewire('ecommerce.cart-panel')
      
    </div>

    <div class="pt-16 bg-gray-50"></div>

    <!-- Page main content -->
    <main class="bg-gray-50">
        @yield('content')
    </main>

    <!-- Cookies advicement popover -->
    {{-- <div x-data="{open: true}" x-show="open"
    class="animate__animated animate__bounceInLeft pointer-events-none fixed inset-x-0 bottom-0 px-6 pb-6">
        <div class="pointer-events-auto max-w-xl rounded-xl bg-white p-6 shadow-lg ring-1 ring-gray-900/10">
          <p class="text-sm leading-6 text-gray-900">This website uses cookies to supplement a balanced diet and provide a much deserved reward to the senses after consuming bland but nutritious meals. Accepting our cookies is optional but recommended, as they are delicious. See our <a href="#" class="font-semibold text-indigo-600">cookie policy</a>.</p>
          <div class="mt-4 flex items-center gap-x-3">
            <x-button @click="open = false" type="primary">Aceptar</x-button>
            <x-button @click="open = false" type="secondary">Rechazar</x-button>
          </div>
        </div>
    </div> --}}
    
    <!-- Newsletter -->
    <div class="bg-{{ tenant('color') }}-600 py-16">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-6 lg:grid-cols-12 lg:gap-8 lg:px-8">
            <div class="max-w-xl text-3xl font-bold tracking-tight text-white sm:text-4xl lg:col-span-7">
                <h2 class="inline mb-2 sm:block lg:inline xl:block">No te pierdas ninguna novedad.</h2>
                <p class="inline sm:block lg:inline xl:block">Suscribite a nuestro newsletter</p>
            </div>
            <form class="w-full max-w-md lg:col-span-5 lg:pt-2">
                <div class="flex gap-x-4 mb-2">
                    <label for="email-address" class="sr-only">Email address</label>
                    <input id="email-address" name="newsletter_email" type="email" required class="min-w-0 flex-auto rounded-md border-0 px-3.5 py-2 shadow-sm ring-1 ring-inset sm:text-sm sm:leading-6" placeholder="Ingresa tu correo aquí">
                    <button type="submit" class="flex-none rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Suscribirme</button>
                </div>
                <p class="text-xs text-gray-300">
                    Tus datos se mantienen confidenciales con nosotros. Puedes revisar nuestro 
                    <a href="#" class="font-semibold text-white hover:underline">acuerdo de privacidad</a>.
                </p>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-900/10" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 lg:px-8">
          <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="space-y-8">
              <img class="h-20" src="{{ Storage::url(tenant('logo_url')) }}" alt="{{ tenant('name') }} logo">
              <p class="text-sm leading-6 text-gray-600">Making the world a better place through constructing elegant hierarchies.</p>
              <div class="flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-gray-500">
                  <span class="sr-only">Facebook</span>
                  <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                  </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                  <span class="sr-only">Instagram</span>
                  <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                  </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                  <span class="sr-only">Twitter</span>
                  <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                  </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                  <span class="sr-only">GitHub</span>
                  <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                  </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-500">
                  <span class="sr-only">YouTube</span>
                  <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z" clip-rule="evenodd" />
                  </svg>
                </a>
              </div>
            </div>
            <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
              <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                  <h3 class="text-sm font-semibold leading-6 text-gray-900">Solutions</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Marketing</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Analytics</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Commerce</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Insights</a>
                    </li>
                  </ul>
                </div>
                <div class="mt-10 md:mt-0">
                  <h3 class="text-sm font-semibold leading-6 text-gray-900">Support</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Pricing</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Documentation</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Guides</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">API Status</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                  <h3 class="text-sm font-semibold leading-6 text-gray-900">Company</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">About</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Blog</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Jobs</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Press</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Partners</a>
                    </li>
                  </ul>
                </div>
                <div class="mt-10 md:mt-0">
                  <h3 class="text-sm font-semibold leading-6 text-gray-900">Legal</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Claim</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Privacy</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Terms</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-16 text-center border-t border-gray-900/10 pt-8 sm:mt-20 lg:mt-24">
            <p class="text-xs leading-5 text-gray-500">
                Desarrollado por 
                <a href="{{ route('simplecom.landing') }}" target="_blank"
                class="text-blue-700 hover:underline">
                    Simplecom&copy;
                </a>.
                Todos los derechos reservados
            </p>
          </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
    @yield('end-body')
</body>
</html>