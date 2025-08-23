<div class="mx-auto mt-14 max-w-2xl sm:mt-16 lg:col-span-3 lg:row-span-2 lg:row-end-2 lg:mt-0 lg:max-w-none">

    {{-- Header --}}
    <div class="flex flex-col-reverse">

        {{-- Name, condition, price and current in cart --}}
        <div class="mt-4">

            {{-- Name --}}
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                {{ $product->name }}
            </h1>

            {{-- Condition --}}
            {{-- <p class="my-2 text-xs text-gray-500">
                                Reacondicionado
                            </p> --}}

            {{-- Price --}}
            <h6 class="mt-2 font-manrope font-semibold text-2xl leading-9 text-gray-900">

                @if ($product->hasDiscount())
                    <div class="flex items-center">
                        <del class="block text-xs text-gray-500">${{ priceFormat($product->price) }}</del>
                        <span class="text-green-500 text-xs ml-1.5">%{{ $product->discount_percent }}
                            OFF</span>
                    </div>
                @endif

                ${{ priceFormat($product->current_price) }}
            </h6>

            {{-- Current in cart --}}
            @php
                // Calculate current product qty on cart
                $qtyOnCart = null;
                $itemsOnCart = Cart::search(fn($cartItem) => $cartItem->id === $product->id);

                if ($itemsOnCart->isNotEmpty()) {
                    $qtyOnCart = $itemsOnCart->sum('qty');
                }
            @endphp

            @if ($qtyOnCart)
                <div class="flex items-center mt-3 no-select">
                    <div @click="$dispatch('open-cart-panel')"
                        class="flex items-center py-1 px-2 rounded-full border text-xs
                                    transition duration-300 hover:bg-white hover:shadow-md cursor-pointer">
                        <x-icon code="shopping_cart" class="text-lg mr-1 text-gray-600" />
                        Ya tenés {{ $qtyOnCart }} {{ $qtyOnCart === 1 ? 'unidad' : 'unidades' }} en tu
                        carrito
                    </div>
                </div>
            @endif
        </div>

        {{-- Current AVG reviews and wishlist btn --}}
        <div class="flex items-center justify-between">

            {{-- Total sold and current AVG --}}
            <div>
                {{-- Total sold --}}
                {{-- <span class="text-gray-500 text-xs">2 vendidos</span> --}}

                {{-- Current AVG --}}
                <div class="flex items-center -mt-1">
                    <x-review-star filled />
                    <x-review-star filled />
                    <x-review-star filled />
                    <x-review-star filled />
                    <x-review-star />
                </div>
            </div>

            {{-- Add to wishlist button --}}
            <x-icon code="favorite" wire:click='toggleWished'
            x-tooltip.raw.placement.left="{{ $product->isOnUserWishlist() ? 'Eliminar de favoritos' : 'Agregar a favoritos' }}"
            class="transition duration-300 cursor-pointer p-2 shadow hover:shadow-lg rounded-full
            {{ $product->isOnUserWishlist() ? 'bg-red-400 text-white' : 'text-red-400 bg-white' }}" />
        </div>

        {{-- Brand (if it have one) --}}
        @if ($product->brand)
            <a href="{{ $product->brand->pageUrl() }}"
                class="inline-flex w-max 
                                items-center bg-white pr-3 shadow rounded-full mb-2
                                transition duration-300 hover:shadow-lg cursor-pointer"
                x-tooltip.raw.placement.right="Ver mas productos de esta marca">
                <img src="{{ !empty($product->brand->image_url) ? Storage::url($product->brand->image_url) : URL::to('img/no-image-alt.png') }}"
                    class="w-8 h-8 rounded-full object-contain" alt="brand-logo">
                <small class="ml-1 text-gray-700 font-semibold">{{ $product->brand->name }}</small>
            </a>
        @endif
    </div>

    {{-- Variants --}}
    @if (!empty($variants))
        @include('ecommerce.partials.product-detail.variants')
    @endif

    {{-- CTA buttons --}}
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">

        {{-- Buy now --}}
        <x-button wire:click='buyNow' size="big" class="col-span-full !rounded-full !p-3.5">
            Comprar ahora
        </x-button>

        {{-- Quantity & Add to cart --}}
        <div class="col-span-full flex items-start flex-wrap sm:flex-nowrap gap-3 mb-8">

            <div class="w-full sm:w-1/2">
                <div class="flex justify-center">
                    <div class="flex items-center justify-center border border-gray-400 rounded-full">

                        {{-- Substract 1 quantity --}}
                        <button wire:click='substractQuantity'
                            class="px-3 w-full border-r border-gray-400 rounded-l-full h-full flex items-center justify-center bg-white shadow-sm shadow-transparent transition-all duration-300 hover:bg-gray-50 hover:shadow-gray-300">
                            <svg wire:loading.remove wire:target='substractQuantity'
                                class="stroke-black group-hover:stroke-black" width="22" height="22"
                                viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.5 11H5.5" stroke="" stroke-width="1.6" stroke-linecap="round">
                                </path>
                                <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                    stroke-linecap="round"></path>
                                <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                    stroke-linecap="round"></path>
                            </svg>
                            <div wire:loading wire:target='substractQuantity'>
                                <x-spinner />
                            </div>
                        </button>

                        {{-- Quantity --}}
                        <input type="text" readonly wire:model.live='quantitySelected'
                            class="font-semibold text-gray-900 
                            text-lg py-3 px-2 w-full min-[400px]:min-w-[75px] h-full bg-transparent 
                            placeholder:text-gray-900 text-center hover:text-blue-600 outline-0 
                            hover:placeholder:text-blue-600"
                            placeholder="1">

                        {{-- Add 1 quantity --}}
                        <button wire:click='addQuantity'
                            class="group px-3 w-full border-l border-gray-400 rounded-r-full h-full flex items-center justify-center bg-white shadow-sm shadow-transparent transition-all duration-300 hover:bg-gray-50 hover:shadow-gray-300">
                            <svg wire:loading.remove wire:target='addQuantity'
                                class="stroke-black group-hover:stroke-black" width="22" height="22"
                                viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 5.5V16.5M16.5 11H5.5" stroke="#9CA3AF" stroke-width="1.6"
                                    stroke-linecap="round"></path>
                                <path d="M11 5.5V16.5M16.5 11H5.5" stroke="black" stroke-opacity="0.2"
                                    stroke-width="1.6" stroke-linecap="round"></path>
                                <path d="M11 5.5V16.5M16.5 11H5.5" stroke="black" stroke-opacity="0.2"
                                    stroke-width="1.6" stroke-linecap="round"></path>
                            </svg>
                            <div wire:loading wire:target='addQuantity'>
                                <x-spinner />
                            </div>
                        </button>
                    </div>
                </div>
                @error('selection')
                    <small class="inline-block text-red-500 mt-1 text-xs">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <x-button wire:click='addToCart' type="soft"
                class="w-full sm:w-1/2 flex !p-3.5 justify-center items-center !rounded-full">
                <x-icon wire:loading.remove wire:target='addToCart' code="shopping_cart" class="mr-2" />
                <div wire:loading wire:target='addToCart'>
                    <x-spinner class="mr-2" />
                </div>
                Agregar al carrito
            </x-button>
        </div>
    </div>

    {{-- Dimensions --}}
    @if (!empty($product->width) || !empty($product->height) || !empty($product->weight))
        <div class="mt-4 border-t border-gray-200 pt-4">
            <h3 class="text-sm font-medium text-gray-900">Dimensiones</h3>
            <div class="mt-4">
                <ul role="list"
                    class="list-disc space-y-1 pl-5 text-sm/6 
                                text-gray-500 marker:text-gray-300">

                    @if (!empty($product->width))
                        <li>Ancho: {{ $product->width }} cm</li>
                    @endif

                    @if (!empty($product->height))
                        <li>Alto: {{ $product->height }} cm</li>
                    @endif

                    @if (!empty($product->length))
                        <li>Largo: {{ $product->length }} cm</li>
                    @endif

                    @if (!empty($product->weight))
                        <li>Peso: {{ $product->weight }} gr</li>
                    @endif
                </ul>
            </div>
        </div>
    @endif

    {{-- Share product link --}}
    <div class="mt-4 border-t border-gray-200 pt-4">

        <h3 class="text-sm font-medium text-gray-900">Compartir</h3>

        <ul role="list" class="mt-4 flex items-center space-x-6">

            <li>
                <a href="{{ $product->whatsappShareUrl() }}" target="_blank"
                    class="flex items-center justify-center text-gray-400 hover:text-gray-500">
                    <svg fill="currentColor" class="w-6 h-6" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 308 308" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g id="XMLID_468_">
                                <path id="XMLID_469_"
                                    d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156
                                    c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687
                                    c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887
                                    c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153
                                    c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348
                                    c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802
                                    c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922
                                    c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0
                                    c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458 C233.168,179.508,230.845,178.393,227.904,176.981z">
                                </path>
                                <path id="XMLID_470_"
                                    d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716
                                    c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396
                                    c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z
                                    M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188
                                    l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677
                                    c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867 C276.546,215.678,222.799,268.994,156.734,268.994z">
                                </path>
                            </g>
                        </g>
                    </svg></svg>
                </a>
            </li>

            <li>
                <a href="{{ $product->facebookShareUrl() }}" target="_blank"
                    class="flex items-center justify-center text-gray-400 hover:text-gray-500">
                    <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="w-6 h-6">
                        <path d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438
                                        9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195
                                        2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343
                                        19.128 20 14.991 20 10z" clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                </a>
            </li>

            <li>
                <a href="{{ $product->twitterShareUrl() }}" target="_blank"
                    class="flex items-center justify-center text-gray-400 hover:text-gray-500">
                    <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="w-6 h-6">
                        <path d="M11.4678 8.77491L17.2961 2H15.915L10.8543 7.88256L6.81232 2H2.15039L8.26263
                                        10.8955L2.15039 18H3.53159L8.87581 11.7878L13.1444 18H17.8063L11.4675
                                        8.77491H11.4678ZM9.57608 10.9738L8.95678 10.0881L4.02925 3.03974H6.15068L10.1273
                                        8.72795L10.7466 9.61374L15.9156 17.0075H13.7942L9.57608 10.9742V10.9738Z" />
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</div>
