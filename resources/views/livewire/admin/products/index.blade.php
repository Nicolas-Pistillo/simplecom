<div>

    @if ($products->isEmpty())
        
        <div class="text-center pt-8">

            <img src="{{ URL::to('img/illustrations/data_processing.svg') }}" class="h-64 mx-auto mb-4"
                alt="no-data-img">

            <div class="mb-4">
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Aún no cargaste productos</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Recordá crear primero tus 
                    <a href="{{ route('admin.categories.index') }}" class="text-blue-500 hover:underline hover:text-blue-600">categorías</a> 
                    antes de crear tu primer producto
                </p>
            </div>
        </div>

    @else
        <ul role="list" class="divide-y divide-gray-100 mb-16">

            @foreach ($products as $product)
                <li wire:key='{{ time() }}' x-data="{selected: false}"
                class="flex justify-between gap-x-6 py-5">
                
                    <div class="flex items-center">
                        <div class="flex min-w-0 gap-x-4 items-center w-auto md:w-80">
                
                            <input type="checkbox"
                            class="h-4 w-4 rounded cursor-pointer border-gray-300 text-blue-600 focus:ring-blue-600">
                    
                            <img class="h-14 w-14 rounded flex-none shadow-md" alt="product-img"
                            src="{{ URL::to('img/no-image.png') }}">
                    
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                    {{ $product->name }}
                                </p>
                                <p class="mt-1 flex text-xs leading-5 text-gray-500">
                                    {{ $product->short_description }} asdasd asd
                                </p>
                            </div>
                        </div>

                        <div class="hidden md:flex items-center">
                            @if ($product->id % 2 === 0)
                                <x-badge color="red">Sin stock</x-badge>
                            @else 
                                <x-badge>Stock: 18</x-badge>
                            @endif
                        </div>
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
            @endforeach

        </ul>        
    @endif

</div>
