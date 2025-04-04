<div x-cloak x-show="detailPanelOpen" class="relative z-10" role="dialog" aria-modal="true"
x-on:close-product-quick-view.window="detailPanelOpen = false">

    <div x-show="detailPanelOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 hidden bg-black/50 transition-opacity md:block" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">

        <div class="flex min-h-full items-stretch justify-center text-center md:items-center md:px-2 lg:px-4">

            <span class="hidden md:inline-block md:h-screen md:align-middle" aria-hidden="true">&#8203;</span>

            <div x-show="detailPanelOpen" x-transition:enter="ease-out duration-800"
                x-transition:enter-start="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 md:scale-100"
                x-transition:leave="ease-in duration-800"
                x-transition:leave-start="opacity-100 translate-y-0 md:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
                @click.away="detailPanelOpen = false"
                class="flex w-full transform text-left text-base transition md:my-8 
                md:max-w-2xl md:px-4 lg:max-w-4xl cursor-default">

                <div class="relative flex w-full items-center overflow-hidden bg-white px-4 pb-8 
                pt-14 shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8 rounded-lg">

                    <x-icon code="close" @click="detailPanelOpen = false" x-tooltip.raw="Cerrar"
                    class="transition colors duration-300 text-[18px] absolute top-4 right-4
                    cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                    hover:bg-gray-200 focus:outline-none focus:ring" />

                    <div class="grid w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:items-center lg:gap-x-8">

                        <img src="{{ $product->first_image }}"
                        class="w-full rounded-lg bg-white object-contain sm:col-span-4 lg:col-span-5">

                        <div class="sm:col-span-8 lg:col-span-7">

                            <h2 class="text-xl font-medium text-gray-900 pr-6">
                                {{ $product->name }}
                            </h2>

                            <section aria-labelledby="information-heading" class="mt-1">

                                <div class="flex flex-col sm:flex-row sm:items-center mt-4">

                                    <h6 class="font-manrope font-semibold text-2xl leading-9 text-gray-900 pr-5 
                                    sm:border-r border-gray-200 mr-5">

                                        @if ($product->hasDiscount())
                                            <div class="flex items-center">
                                                <del class="block text-xs text-gray-500">
                                                    ${{ priceFormat($product->price) }}
                                                </del>
                                                <span class="text-green-500 text-xs ml-1.5">
                                                    %15 OFF
                                                </span>
                                            </div>
                                        @endif

                                        ${{ priceFormat($product->current_price) }}
                                    </h6>

                                    <button class="flex items-center gap-1 rounded-lg bg-amber-400 py-1.5 px-2.5 w-max">

                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_12657_16865)">
                                                <path d="M8.10326 2.26718C8.47008 1.52393 9.52992 1.52394 9.89674 2.26718L11.4124 5.33818C11.558 5.63332 11.8396 5.83789 12.1653 5.88522L15.5543 6.37768C16.3746 6.49686 16.7021 7.50483 16.1086 8.08337L13.6562 10.4738C13.4205 10.7035 13.313 11.0345 13.3686 11.3589L13.9475 14.7343C14.0877 15.5512 13.2302 16.1742 12.4966 15.7885L9.46534 14.1948C9.17402 14.0417 8.82598 14.0417 8.53466 14.1948L5.5034 15.7885C4.76978 16.1742 3.91235 15.5512 4.05246 14.7343L4.63137 11.3589C4.68701 11.0345 4.57946 10.7035 4.34378 10.4738L1.89144 8.08337C1.29792 7.50483 1.62543 6.49686 2.44565 6.37768L5.8347 5.88522C6.16041 5.83789 6.44197 5.63332 6.58764 5.33818L8.10326 2.26718Z" fill="white"></path>
                                                <g clip-path="url(#clip1_12657_16865)">
                                                    <path d="M8.10326 2.26718C8.47008 1.52393 9.52992 1.52394 9.89674 2.26718L11.4124 5.33818C11.558 5.63332 11.8396 5.83789 12.1653 5.88522L15.5543 6.37768C16.3746 6.49686 16.7021 7.50483 16.1086 8.08337L13.6562 10.4738C13.4205 10.7035 13.313 11.0345 13.3686 11.3589L13.9475 14.7343C14.0877 15.5512 13.2302 16.1742 12.4966 15.7885L9.46534 14.1948C9.17402 14.0417 8.82598 14.0417 8.53466 14.1948L5.5034 15.7885C4.76978 16.1742 3.91235 15.5512 4.05246 14.7343L4.63137 11.3589C4.68701 11.0345 4.57946 10.7035 4.34378 10.4738L1.89144 8.08337C1.29792 7.50483 1.62543 6.49686 2.44565 6.37768L5.8347 5.88522C6.16041 5.83789 6.44197 5.63332 6.58764 5.33818L8.10326 2.26718Z" fill="white"></path>
                                                </g>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_12657_16865">
                                                    <rect width="18" height="18" fill="white"></rect>
                                                </clipPath>
                                                <clipPath id="clip1_12657_16865">
                                                    <rect width="18" height="18" fill="white"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <span class="text-sm font-medium text-white">4.8</span>
                                    </button>
                                </div>

                                @php
                                    // Calculate current product qty on cart
                                    $qtyOnCart = null;
                                    $itemsOnCart = Cart::search(fn($cartItem) => $cartItem->id === $product->id);
                                    
                                    if ($itemsOnCart->isNotEmpty())
                                    {
                                        $qtyOnCart = $itemsOnCart->sum('qty');
                                    }
                                @endphp
                                @if ($qtyOnCart)
                                    <div class="flex items-center mt-3 no-select">
                                        <div @click="$dispatch('close-product-quick-view');$dispatch('open-cart-panel')" 
                                        class="flex items-center py-1 px-2 rounded-full border text-xs
                                        transition duration-300 hover:bg-white hover:shadow-md cursor-pointer">
                                            <x-icon code="shopping_cart" class="text-lg mr-1 text-gray-600" />
                                            Ya tenés {{ $qtyOnCart }} {{ $qtyOnCart === 1 ? 'unidad' : 'unidades' }} en tu carrito
                                        </div>
                                    </div>
                                @endif

                                <p class="text-gray-700 text-sm mt-4 line-clamp-4">
                                    {{ !empty($product->description) ? $product->description : 'Sin descripción' }}
                                </p>
                            </section>

                            {{-- Variants --}}
                            @if (!empty($variants))
                                @include('ecommerce.partials.product-detail.variants')
                            @endif

                            <div class="flex items-start flex-wrap sm:flex-nowrap gap-3 my-6">

                                <div class="flex-1">
                                    <div class="flex justify-center">
                                        <div class="flex items-center justify-center border border-gray-400 rounded-full">
        
                                            <button wire:click="substractQuantity" class="px-2 w-full border-r border-gray-400 rounded-l-full h-full flex items-center justify-center bg-white shadow-sm shadow-transparent transition-all duration-300 hover:bg-gray-50 hover:shadow-gray-300">
                                                <svg class="stroke-black group-hover:stroke-black" width="18" height="18" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16.5 11H5.5" stroke="" stroke-width="1.6" stroke-linecap="round">
                                                    </path>
                                                    <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round"></path>
                                                    <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round"></path>
                                                </svg>
                                            </button>
                                                    
                                            <input type="text" readonly wire:model.live="quantitySelected" class="font-semibold text-gray-900 
                                            text-lg py-1.5 px-2 w-full min-[400px]:min-w-[75px] h-full bg-transparent 
                                            placeholder:text-gray-900 text-center hover:text-blue-600 outline-0 
                                            hover:placeholder:text-blue-600">
                
                                            
                                            <button wire:click="addQuantity" class="group px-3 w-full border-l border-gray-400 rounded-r-full h-full flex items-center justify-center bg-white shadow-sm shadow-transparent transition-all duration-300 hover:bg-gray-50 hover:shadow-gray-300">
                                                <svg class="stroke-black group-hover:stroke-black" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11 5.5V16.5M16.5 11H5.5" stroke="#9CA3AF" stroke-width="1.6" stroke-linecap="round"></path>
                                                    <path d="M11 5.5V16.5M16.5 11H5.5" stroke="black" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round"></path>
                                                    <path d="M11 5.5V16.5M16.5 11H5.5" stroke="black" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    @error('selection')
                                        <small class="inline-block text-red-500 mt-1 text-xs">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                <x-button type="soft" wire:click='addToCart' size="large" 
                                class="flex flex-1 justify-center items-center gap-2 !rounded-full">
                                    <x-icon code="shopping_cart" />
                                    Agregar al carrito
                                </x-button>
                            </div>

                            <section aria-labelledby="options-heading" class="mt-4">
                                <div>
                                    <x-button size="big" wire:click='buyNow' class="w-full !rounded-full">
                                        Comprar ahora
                                    </x-button>

                                    <p class="absolute left-4 top-4 text-center sm:static mt-4">
                                        <a href="{{ $product->detailPageUrl() }}"
                                        class="font-medium text-blue-600 hover:text-blue-700
                                        hover:underline text-sm">
                                            Ver detalle completo
                                        </a>
                                    </p>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>