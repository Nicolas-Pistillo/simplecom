<li wire:key='{{ time() }}' class="flex justify-between gap-x-6 py-5">

    <div class="flex min-w-0 gap-x-4 items-center">

        <input type="checkbox"
            class="h-4 w-4 rounded cursor-pointer border-gray-300 text-blue-600 focus:ring-blue-600">

        @if ($i % 2 === 0)
          <img class="h-14 w-14 rounded flex-none shadow-md" alt="product-img"
          src="{{ URL::to('img/no-image.png') }}">
        @else
          <img class="h-14 w-14 rounded flex-none shadow-md" alt="product-img"
          src="https://picsum.photos/200">
        @endif

        <div class="min-w-0 flex-auto">
            <p class="text-sm font-semibold leading-6 text-gray-900">
                Nombre del producto
            </p>
            <p class="mt-1 flex text-xs leading-5 text-gray-500">
                Alguna descripción o algo mas por aca
            </p>
        </div>
    </div>

    <div class="flex min-w-0 gap-x-4 items-center">

      @if ($i % 2 === 0)
        <x-badge color="red">Sin stock</x-badge>
      @else 
        <x-badge>Stock: 18</x-badge>
      @endif

    </div>

    <div class="flex shrink-0 items-center gap-x-6">
        <div class="hidden sm:flex sm:flex-col sm:items-end">
            <p class="text-sm leading-6 text-gray-900">Front-end Developer</p>
            <p class="mt-1 text-xs leading-5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h
                    ago</time></p>
        </div>
        <div x-data="{ actionsOpen: false }" class="relative flex-none">

            <div x-tooltip.raw.placement.top="Acciones">
                <x-icon @click="actionsOpen = !actionsOpen" code="more_vert"
                class="text-2xl text-gray-500 w-8 h-8 p-1 flex items-center
                rounded-full bg-gray-100 transition hover:bg-gray-200 text-center no-select shadow cursor-pointer" />
            </div>

            <div x-cloak x-show="actionsOpen" x-transition:enter="transition ease-out duration-125"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-125"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95" @click.away="actionsOpen = false"
                class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="options-menu-3-button"
                tabindex="-1">
                <!-- Active: "bg-gray-50", Not Active: "" -->
                <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem"
                tabindex="-1">View profile<span class="sr-only">, Lindsay
                        Walton</span></a>
                <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem"
                    tabindex="-1">Message<span class="sr-only">, Lindsay
                        Walton</span></a>
            </div>
        </div>
    </div>

</li>