<div>
    <div x-data="{open: false}" class="relative hidden sm:block">
                                        
        <x-icon @click="open = !open" code="favorite" x-tooltip.raw.placement.bottom="Favoritos"
        class="transition colors duration-300 ml-3
        cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
        hover:bg-gray-200 focus:outline-none focus:ring relative" />

        @if ($wishlist->count() > 0)
            <span class="absolute -top-2 -right-2 inline-flex items-center 
            justify-center w-5 h-5 text-xs font-semibold text-white bg-red-600 
            rounded-full ring-1 ring-white">
                {{ $wishlist->count() }}
            </span>
        @endif

        <div x-show="open" x-cloak @click.away="open = false"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute top-12 -right-6 mx-auto w-full sm:w-[400px]">
            <div class="z-20 w-full bg-white divide-y divide-gray-100 
            rounded-none sm:rounded-lg shadow-lg hidden sm:block">
                <div class="block px-4 py-2 font-semibold text-center text-white 
                rounded-t-none sm:rounded-t-lg bg-{{ tenant('color') }}-600">
                    Mis favoritos
                </div>
                <div class="divide-y divide-gray-100 max-h-[350px] overflow-y-auto py-2">
                    @forelse ($wishlist as $item)
                        <div wire:key='{{ $item->id }}' class="flex py-2 px-4">
                            <div class="h-20 w-20 transition duration-200 flex-shrink-0 overflow-hidden 
                                rounded-md border border-gray-200 hover:border-gray-300">
                                <a href="{{ $item->product->detailPageUrl() }}">
                                    <img src="{{ $item->product->first_image }}" 
                                    class="h-full w-full object-contain object-center">
                                </a>
                            </div>

                            <div class="ml-4 flex flex-1 flex-col">
                                <div>
                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                        <h3 class="text-sm" title="{{ $item->product->name }}">
                                            <a href="{{ $item->product->detailPageUrl() }}" class="line-clamp-2 transition duration-200 
                                                hover:text-blue-600 text-gray-600 font-semibold">
                                                {{ $item->product->name }}
                                            </a>
                                        </h3>
                                        <p class="ml-4 {{ $item->product->hasDiscount() ? 'text-green-700' : '' }}">
                                            ${{ priceFormat($item->product->current_price) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full flex flex-1 items-end justify-between text-sm">    

                                    <span wire:click="removeItem({{ $item->id }})" 
                                    class="font-medium cursor-pointer text-red-600 hover:text-red-500">
                                        Eliminar
                                    </span>

                                    @if ($item->product->hasDiscount())
                                        <span class="text-green-700">¡En oferta!</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center pt-2 px-6">

                            <x-icon code="heart_plus" class="text-4xl text-gray-700" />

                            <div class="mb-4">

                                <h3 class="mt-2 text-sm font-semibold text-gray-900">
                                    Lista vacía
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    Podes marcar los productos que desees como favoritos para acceder a ellos rápidamente.
                                </p>

                                <x-button type="soft" :href="route('ecommerce.products')" 
                                class="inline-block mt-4">Ver productos</x-button>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
