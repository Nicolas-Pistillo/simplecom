<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; }</style>
    <title>@yield('page-title', 'Simplecom - Superadmin')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @yield('head')
</head>
<body>
<div class="min-h-full">

    <nav x-data="{mobileMenuOpen: false}" class="bg-blue-600">
      <!-- Desktop menu -->
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

          <div class="flex items-center">

            <div class="flex-shrink-0">
              <img class="h-12" src="{{ asset('img/simplecom/png/logo-simple-white.png') }}" alt="Logo" title="Simplecom">
            </div>

            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                
                <a href="{{ route('superadmin.dashboard.index') }}" 
                class="{{ Route::is('superadmin.dashboard.index') 
                  ? 'bg-white rounded-md px-3 py-2 text-sm font-medium' 
                  : 'hover:underline text-white rounded-md px-3 py-2 text-sm font-medium' 
                }}">
                  Dashboard
                </a>

                <a href="{{ route('superadmin.tenants.index') }}" 
                class="{{ Route::is('superadmin.tenants*') 
                  ? 'bg-white rounded-md px-3 py-2 text-sm font-medium' 
                  : 'hover:underline text-white rounded-md px-3 py-2 text-sm font-medium' 
                }}">
                  Tenants
                </a>
              </div>
            </div>

          </div>

          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <!-- Profile dropdown -->
              <div x-data="{userMenuOpen: false}" class="relative ml-3">
                <div @click="userMenuOpen = !userMenuOpen">
                  <button type="button" class="relative flex max-w-xs items-center rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Open user menu</span>
                    <img class="h-8 w-8 rounded-full" src="{{ asset('img/avatar-default.png') }}" alt="avatar">
                  </button>
                </div>
  
                <div x-cloak x-show="userMenuOpen" @click.away="userMenuOpen = false"
                x-transition:enter.duration.300ms
                x-transition:leave.duration.300ms
                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <div class="px-4 py-3 border-b" role="none">
                  <p class="text-sm font-semibold" role="none"> {{ Auth::user()->name }} </p>
                  <p class="truncate text-xs font-medium text-gray-900" role="none"> {{ Auth::user()->email }} </p>
                </div>
                  <!-- Active: "bg-gray-100", Not Active: "" -->
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                  <form action="{{ route('superadmin.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">
                      Cerrar sesión
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
            type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 focus:outline-none">
              <span class="absolute -inset-0.5"></span>
              <span class="sr-only">Open main menu</span>
              <!-- Menu open: "hidden", Menu closed: "block" -->
              <x-icon code="menu" class="text-white border rounded-full p-1.5" />
              <!-- Menu open: "block", Menu closed: "hidden" -->
              <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>
  
      <!-- Mobile menu, show/hide based on menu state. -->
      <div x-show="mobileMenuOpen" x-transition.duration.400 class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">

          <a href="{{ route('superadmin.dashboard.index') }}" 
          class="{{ Route::is('superadmin.dashboard.index') 
            ? 'bg-white block rounded-md px-3 py-2 text-base font-medium'
            : 'text-gray-300 block rounded-md px-3 py-2 text-base font-medium'
          }}">Dashboard</a>

          <a href="{{ route('superadmin.tenants.index') }}" 
          class="{{ Route::is('superadmin.tenants.index') 
            ? 'bg-white block rounded-md px-3 py-2 text-base font-medium'
            : 'text-gray-300 block rounded-md px-3 py-2 text-base font-medium'
          }}">Tenants</a>

        </div>
        <div class="border-t border-gray-700 pb-3 pt-4">
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <img class="h-10 w-10 rounded-full" src="{{ URL::to('img/avatar-default.png') }}" alt="avatar-img">
            </div>
            <div class="ml-3">
              <div class="text-base font-medium leading-none text-white"> {{ Auth::user()->name }} </div>
              <div class="text-sm font-medium leading-none text-gray-300"> {{ Auth::user()->email }} </div>
            </div>
          </div>
          <div class="mt-3 space-y-1 px-2">
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300">Your Profile</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300">Settings</a>
            <form action="{{ route('superadmin.logout') }}" method="post">
              @csrf
              <button type="submit" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300" role="menuitem" tabindex="-1" id="user-menu-item-2">
                Cerrar sesión
              </button>
            </form>
          </div>
        </div>
      </div>
    </nav>
  
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">@yield('title', 'Dashboard')</h1>
      </div>
    </header>

    <main>
      <div class="mx-auto max-w-7xl py-6 px-3 sm:px-6 lg:px-8">
        @yield('content')
      </div>
    </main>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
</body>
</html>