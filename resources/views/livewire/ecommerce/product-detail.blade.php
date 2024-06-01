<div>
    <div x-data class="py-8 lg:py-14 relative overflow-x-hidden">

        {{-- Product Overview --}}
        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">

                {{-- Product images block --}}
                <div class="no-select w-full flex md:block flex-col justify-center order-last 
                max-lg:max-w-[608px] max-lg:mx-auto">

                    {{-- Category trees bradcrumb --}}
                    <div class="mb-3">
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol role="list" class="flex items-center space-x-2 text-sm">

                                {{-- Category Grandfather --}}
                                @if ($product->category->father?->father)
                                    <li>
                                        <div class="flex items-center">
                                            <a href="#" class="text-gray-400 hover:text-blue-600 mr-1">
                                                <span>{{ $product->category->father->father->name }}</span>
                                            </a>
                                            <x-icon code="navigate_next" class="text-gray-400"
                                                style="font-size: 20px" />
                                        </div>
                                    </li>
                                @endif

                                {{-- Category father --}}
                                @if ($product->category->father)
                                    <li>
                                        <div class="flex items-center">
                                            <a href="#" class="text-gray-400 hover:text-blue-600 mr-1">
                                                <span>{{ $product->category->father->name }}</span>
                                            </a>
                                            <x-icon code="navigate_next" class="text-gray-400"
                                                style="font-size: 20px" />
                                        </div>
                                    </li>
                                @endif

                                <li>
                                    <div class="flex items-center">
                                        <a href="#" class="text-gray-400 hover:text-blue-600 mr-1">
                                            <span>{{ $product->category->name }}</span>
                                        </a>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                    </div>

                    {{-- Product images --}}
                    <div x-data="{ currentImage: '{{ $product->first_image }}' }">

                        {{-- Main image preview --}}
                        <div class="w-full mx-auto relative mb-6" x-transition>
                            <img x-bind:src="currentImage" alt="product-image"
                                class="w-[500px] h-[450px] rounded-lg shadow-md object-cover">
                        </div>

                        {{-- All product images list --}}
                        <div class="w-[500px] flex items-center gap-3 flex-wrap">
                            @if ($product->images->count() > 1)
                                @foreach ($product->images as $image)
                                    <div class="shadow rounded-lg border-2 border-transparent
                                    cursor-pointer overflow-hidden"
                                        :class="currentImage == '{{ Storage::url($image->url) }}' ?
                                            '!border-blue-600' :
                                            'hover:border-blue-600'">
                                        <img src="{{ Storage::url($image->url) }}"
                                            class="w-16 h-16 object-cover rounded-lg" alt="product-image"
                                            @mouseenter.prevent="currentImage = '{{ Storage::url($image->url) }}'">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Product info block --}}
                <div class="pro-detail w-full flex flex-col justify-center order-last 
                max-lg:max-w-[608px] max-lg:mx-auto">

                    {{-- Category, Brand & LikeButton --}}
                    <div class="flex justify-between items-center mb-3">

                        <div class="flex items-center">
                            <p class="font-medium text-{{ tenant('color') }}-600"> {{ $product->category->name }} </p>
                            @if ($product->brand)
                                <span
                                    class="ml-3 inline-flex items-center bg-white pl-1 pr-3 shadow rounded-full
                                transition duration-300 hover:shadow-lg cursor-pointer"
                                    x-tooltip.raw.placement.right="Ver más productos de esta marca">
                                    <img src="{{ $product->brand->image_url }}" class="w-8 h-8 rounded-full"
                                        alt="brand-logo">
                                    <small class="ml-1 text-gray-700 font-semibold">{{ $product->brand->name }}</small>
                                </span>
                            @endif
                        </div>

                        <x-icon code="favorite" x-tooltip.raw.placement.left="Añadir a favoritos"
                        class="transition duration-300 cursor-pointer p-2 text-red-400 
                        bg-white shadow hover:shadow-lg rounded-full" />
                    </div>

                    {{-- Product name --}}
                    <h1 class="mb-2 font-manrope font-bold text-3xl leading-10 text-gray-900">
                        {{ $product->name }}
                    </h1>

                    {{-- Price & Reviews --}}
                    <div class="mb-6">
                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <h6 class="font-manrope font-semibold text-2xl leading-9 text-gray-900 pr-5 
                            sm:border-r border-gray-200 mr-5">
                                @if ($product->hasDiscount())
                                    <div class="flex items-center">
                                        <del class="block text-xs text-gray-500">${{ priceFormat($product->price) }}</del>
                                        <span class="text-green-500 text-xs ml-1.5">%{{ $product->discount_percent }}
                                            OFF</span>
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
                                <div wire:click='openCartPanel' class="flex items-center py-1 px-2 rounded-full border text-xs
                                transition duration-300 hover:bg-white hover:shadow-md cursor-pointer">
                                    <x-icon code="shopping_cart" class="text-lg mr-1 text-gray-600" />
                                    Ya tenés {{ $qtyOnCart }} {{ $qtyOnCart === 1 ? 'unidad' : 'unidades' }} en tu carrito
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Description --}}
                    <p class="text-gray-500 text-base font-normal mb-6">
                        {{ $product->description ?? 'Sin descripción' }}
                    </p>

                    {{-- Variants --}}
                    @if (!empty($variants))
                        @include('ecommerce.partials.product-detail.variants')
                    @endif

                    {{-- Quantity & Add to cart --}}
                    <div class="flex items-start flex-wrap sm:flex-nowrap gap-3 mb-8">

                        <div class="w-full sm:w-1/2">
                            <div class="flex justify-center">
                                <div class="flex items-center justify-center border border-gray-400 rounded-full">

                                    {{-- Substract 1 quantity --}}
                                    <button wire:click='substractQuantity'
                                        class="px-3 w-full border-r border-gray-400 rounded-l-full h-full flex items-center justify-center bg-white shadow-sm shadow-transparent transition-all duration-300 hover:bg-gray-50 hover:shadow-gray-300">
                                        <svg class="stroke-black group-hover:stroke-black" width="22" height="22"
                                            viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 11H5.5" stroke="" stroke-width="1.6" stroke-linecap="round">
                                            </path>
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                                stroke-linecap="round"></path>
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                                stroke-linecap="round"></path>
                                        </svg>
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
                                        <svg class="stroke-black group-hover:stroke-black" width="22" height="22"
                                            viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="#9CA3AF" stroke-width="1.6"
                                                stroke-linecap="round"></path>
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="black" stroke-opacity="0.2"
                                                stroke-width="1.6" stroke-linecap="round"></path>
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="black" stroke-opacity="0.2"
                                                stroke-width="1.6" stroke-linecap="round"></path>
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

                        <x-button wire:click='addToCart'
                        type="soft" class="w-full sm:w-1/2 flex !p-3.5 justify-center items-center !rounded-full">
                            <x-icon code="shopping_cart" class="mr-2" />
                            Agregar al carrito
                        </x-button>
                    </div>

                    {{-- Buy now --}}
                    <div class="flex items-center gap-3">
                        <x-button wire:click='buyNow' size="big" class="!rounded-full w-full !p-3.5 text-lg">
                            Comprar ahora
                        </x-button>
                    </div>
                </div>
            </div>
        </section>

        {{-- Product reviews --}}
        <section class="py-24 relative">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-12">
                    <div class="col-span-12 lg:col-span-4 w-full max-lg:max-w-sm max-lg:mx-auto">
                        <div class="w-full lg:pr-11 lg:border-r border-gray-200">
                            <p class="font-manrope font-bold text-2xl leading-9 text-black text-center mb-4 ">
                                AVERAGE RATING
                            </p>
                            <div class="flex items-center justify-center gap-3 pb-8 border-b border-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"
                                    fill="none">
                                    <g clip-path="url(#clip0_13857_262)">
                                        <path
                                            d="M17.1033 2.71689C17.4701 1.97364 18.5299 1.97364 18.8967 2.71689L23.0574 11.1473C23.2031 11.4425 23.4846 11.647 23.8103 11.6943L33.1139 13.0462C33.9341 13.1654 34.2616 14.1734 33.6681 14.7519L26.936 21.3141C26.7003 21.5438 26.5927 21.8748 26.6484 22.1992L28.2376 31.4651C28.3777 32.2821 27.5203 32.905 26.7867 32.5193L18.4653 28.1445C18.174 27.9914 17.826 27.9914 17.5347 28.1445L9.21334 32.5193C8.47971 32.905 7.62228 32.2821 7.76239 31.4651L9.35162 22.1992C9.40726 21.8748 9.29971 21.5438 9.06402 21.3141L2.33193 14.7519C1.73841 14.1734 2.06593 13.1654 2.88615 13.0462L12.1897 11.6943C12.5154 11.647 12.7969 11.4425 12.9426 11.1473L17.1033 2.71689Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_13857_262">
                                            <rect width="36" height="36" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"
                                    fill="none">
                                    <g clip-path="url(#clip0_13857_262)">
                                        <path
                                            d="M17.1033 2.71689C17.4701 1.97364 18.5299 1.97364 18.8967 2.71689L23.0574 11.1473C23.2031 11.4425 23.4846 11.647 23.8103 11.6943L33.1139 13.0462C33.9341 13.1654 34.2616 14.1734 33.6681 14.7519L26.936 21.3141C26.7003 21.5438 26.5927 21.8748 26.6484 22.1992L28.2376 31.4651C28.3777 32.2821 27.5203 32.905 26.7867 32.5193L18.4653 28.1445C18.174 27.9914 17.826 27.9914 17.5347 28.1445L9.21334 32.5193C8.47971 32.905 7.62228 32.2821 7.76239 31.4651L9.35162 22.1992C9.40726 21.8748 9.29971 21.5438 9.06402 21.3141L2.33193 14.7519C1.73841 14.1734 2.06593 13.1654 2.88615 13.0462L12.1897 11.6943C12.5154 11.647 12.7969 11.4425 12.9426 11.1473L17.1033 2.71689Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_13857_262">
                                            <rect width="36" height="36" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"
                                    fill="none">
                                    <g clip-path="url(#clip0_13857_262)">
                                        <path
                                            d="M17.1033 2.71689C17.4701 1.97364 18.5299 1.97364 18.8967 2.71689L23.0574 11.1473C23.2031 11.4425 23.4846 11.647 23.8103 11.6943L33.1139 13.0462C33.9341 13.1654 34.2616 14.1734 33.6681 14.7519L26.936 21.3141C26.7003 21.5438 26.5927 21.8748 26.6484 22.1992L28.2376 31.4651C28.3777 32.2821 27.5203 32.905 26.7867 32.5193L18.4653 28.1445C18.174 27.9914 17.826 27.9914 17.5347 28.1445L9.21334 32.5193C8.47971 32.905 7.62228 32.2821 7.76239 31.4651L9.35162 22.1992C9.40726 21.8748 9.29971 21.5438 9.06402 21.3141L2.33193 14.7519C1.73841 14.1734 2.06593 13.1654 2.88615 13.0462L12.1897 11.6943C12.5154 11.647 12.7969 11.4425 12.9426 11.1473L17.1033 2.71689Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_13857_262">
                                            <rect width="36" height="36" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"
                                    fill="none">
                                    <g clip-path="url(#clip0_13857_262)">
                                        <path
                                            d="M17.1033 2.71689C17.4701 1.97364 18.5299 1.97364 18.8967 2.71689L23.0574 11.1473C23.2031 11.4425 23.4846 11.647 23.8103 11.6943L33.1139 13.0462C33.9341 13.1654 34.2616 14.1734 33.6681 14.7519L26.936 21.3141C26.7003 21.5438 26.5927 21.8748 26.6484 22.1992L28.2376 31.4651C28.3777 32.2821 27.5203 32.905 26.7867 32.5193L18.4653 28.1445C18.174 27.9914 17.826 27.9914 17.5347 28.1445L9.21334 32.5193C8.47971 32.905 7.62228 32.2821 7.76239 31.4651L9.35162 22.1992C9.40726 21.8748 9.29971 21.5438 9.06402 21.3141L2.33193 14.7519C1.73841 14.1734 2.06593 13.1654 2.88615 13.0462L12.1897 11.6943C12.5154 11.647 12.7969 11.4425 12.9426 11.1473L17.1033 2.71689Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_13857_262">
                                            <rect width="36" height="36" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_13839_5339)">
                                        <path
                                            d="M16.8791 3.17162C17.3376 2.24256 18.6624 2.24257 19.1209 3.17162L22.9992 11.0299C23.1813 11.3989 23.5333 11.6546 23.9404 11.7137L32.6126 12.9739C33.6378 13.1229 34.0472 14.3828 33.3053 15.106L27.0301 21.2228C26.7355 21.51 26.6011 21.9238 26.6706 22.3293L28.152 30.9664C28.3271 31.9875 27.2553 32.7662 26.3383 32.2841L18.5817 28.2062C18.2175 28.0147 17.7825 28.0147 17.4183 28.2062L9.66171 32.2841C8.74467 32.7662 7.67288 31.9875 7.84802 30.9664L9.3294 22.3292C9.39895 21.9238 9.26451 21.51 8.96991 21.2228L2.69467 15.106C1.95277 14.3828 2.36216 13.1229 3.38744 12.9739L12.0596 11.7137C12.4667 11.6546 12.8187 11.3989 13.0008 11.0299L16.8791 3.17162Z"
                                            fill="#E5E7EB" />
                                        <g clip-path="url(#clip1_13839_5339)">
                                            <path
                                                d="M16.8791 3.17162C17.3376 2.24256 18.6624 2.24257 19.1209 3.17162L22.9992 11.0299C23.1813 11.3989 23.5333 11.6546 23.9404 11.7137L32.6126 12.9739C33.6378 13.1229 34.0472 14.3828 33.3053 15.106L27.0301 21.2228C26.7355 21.51 26.6011 21.9238 26.6706 22.3293L28.152 30.9664C28.3271 31.9875 27.2553 32.7662 26.3383 32.2841L18.5817 28.2062C18.2175 28.0147 17.7825 28.0147 17.4183 28.2062L9.66171 32.2841C8.74467 32.7662 7.67288 31.9875 7.84802 30.9664L9.3294 22.3292C9.39895 21.9238 9.26451 21.51 8.96991 21.2228L2.69467 15.106C1.95277 14.3828 2.36216 13.1229 3.38744 12.9739L12.0596 11.7137C12.4667 11.6546 12.8187 11.3989 13.0008 11.0299L16.8791 3.17162Z"
                                                fill="#FBBF24" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_13839_5339">
                                            <rect width="36" height="36" fill="white" />
                                        </clipPath>
                                        <clipPath id="clip1_13839_5339">
                                            <rect width="18" height="36" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
    
                            </div>
                            <div class="star-box lg:px-10 pt-8">
                                <div class="flex items-center justify-between mb-2 gap-3">
                                    <div class="flex items-center gap-4 lg:gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <p class="leading-8 font-semibold">4.5k</p>
                                </div>
    
                                <div class="flex items-center justify-between mb-2 gap-3">
                                    <div class="flex items-center gap-4 lg:gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3330)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#E5E7EB" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3330">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <p class="font-medium text-lg leading-8 text-black ">(789)</p>
                                </div>
    
                                <div class="flex items-center justify-between mb-2 gap-3">
                                    <div class="flex items-center gap-4 lg:gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3330)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#E5E7EB" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3330">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3330)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#E5E7EB" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3330">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <p class="font-medium text-lg leading-8 text-black ">(98)</p>
                                </div>
    
                                <div class="flex items-center justify-between mb-2 gap-3">
                                    <div class="flex items-center gap-4 lg:gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3330)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#E5E7EB" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3330">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3330)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#E5E7EB" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3330">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3330)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#E5E7EB" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3330">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <p class="font-medium text-lg leading-8 text-black ">(21)</p>
                                </div>
    
                                <div class="flex items-center justify-between mb-2 gap-3">
                                    <div class="flex items-center gap-4 lg:gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3287)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#FBBF24" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3287">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3330)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#E5E7EB" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3330">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3330)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#E5E7EB" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3330">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3330)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#E5E7EB" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3330">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                            fill="none">
                                            <g clip-path="url(#clip0_13857_3330)">
                                                <path
                                                    d="M14.1033 2.56698C14.4701 1.82374 15.5299 1.82374 15.8967 2.56699L19.1757 9.21093C19.3214 9.50607 19.6029 9.71064 19.9287 9.75797L27.2607 10.8234C28.0809 10.9426 28.4084 11.9505 27.8149 12.5291L22.5094 17.7007C22.2737 17.9304 22.1662 18.2614 22.2218 18.5858L23.4743 25.8882C23.6144 26.7051 22.7569 27.3281 22.0233 26.9424L15.4653 23.4946C15.174 23.3415 14.826 23.3415 14.5347 23.4946L7.9767 26.9424C7.24307 27.3281 6.38563 26.7051 6.52574 25.8882L7.7782 18.5858C7.83384 18.2614 7.72629 17.9304 7.49061 17.7007L2.1851 12.5291C1.59159 11.9505 1.91909 10.9426 2.73931 10.8234L10.0713 9.75797C10.3971 9.71064 10.6786 9.50607 10.8243 9.21093L14.1033 2.56698Z"
                                                    fill="#E5E7EB" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13857_3330">
                                                    <rect width="30" height="30" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <p class="font-medium text-lg leading-8 text-black ">(9)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-span-12 lg:col-span-8 lg:pl-11 w-full max-lg:mt-8 max-lg:max-w-2xl max-lg:mx-auto flex items-center">
                        <div class="">
                            <div class="flex items-center gap-2 mb-7 max-lg:justify-center">
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_12042_6907)">
                                        <path
                                            d="M9.60326 2.31699C9.97008 1.57374 11.0299 1.57374 11.3967 2.31699L13.2063 5.98347C13.3519 6.27862 13.6335 6.48319 13.9592 6.53051L18.0054 7.11846C18.8256 7.23765 19.1531 8.24562 18.5596 8.82416L15.6318 11.6781C15.3961 11.9079 15.2885 12.2389 15.3442 12.5632L16.0353 16.5931C16.1754 17.41 15.318 18.033 14.5844 17.6473L10.9653 15.7446C10.674 15.5915 10.326 15.5915 10.0347 15.7446L6.41562 17.6473C5.68199 18.033 4.82456 17.41 4.96467 16.5931L5.65585 12.5632C5.71148 12.2389 5.60393 11.9079 5.36825 11.6781L2.44038 8.82416C1.84687 8.24562 2.17438 7.23765 2.9946 7.11846L7.04081 6.53051C7.36652 6.48319 7.64808 6.27862 7.79374 5.98347L9.60326 2.31699Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_12042_6907">
                                            <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_12042_6907)">
                                        <path
                                            d="M9.60326 2.31699C9.97008 1.57374 11.0299 1.57374 11.3967 2.31699L13.2063 5.98347C13.3519 6.27862 13.6335 6.48319 13.9592 6.53051L18.0054 7.11846C18.8256 7.23765 19.1531 8.24562 18.5596 8.82416L15.6318 11.6781C15.3961 11.9079 15.2885 12.2389 15.3442 12.5632L16.0353 16.5931C16.1754 17.41 15.318 18.033 14.5844 17.6473L10.9653 15.7446C10.674 15.5915 10.326 15.5915 10.0347 15.7446L6.41562 17.6473C5.68199 18.033 4.82456 17.41 4.96467 16.5931L5.65585 12.5632C5.71148 12.2389 5.60393 11.9079 5.36825 11.6781L2.44038 8.82416C1.84687 8.24562 2.17438 7.23765 2.9946 7.11846L7.04081 6.53051C7.36652 6.48319 7.64808 6.27862 7.79374 5.98347L9.60326 2.31699Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_12042_6907">
                                            <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_12042_6907)">
                                        <path
                                            d="M9.60326 2.31699C9.97008 1.57374 11.0299 1.57374 11.3967 2.31699L13.2063 5.98347C13.3519 6.27862 13.6335 6.48319 13.9592 6.53051L18.0054 7.11846C18.8256 7.23765 19.1531 8.24562 18.5596 8.82416L15.6318 11.6781C15.3961 11.9079 15.2885 12.2389 15.3442 12.5632L16.0353 16.5931C16.1754 17.41 15.318 18.033 14.5844 17.6473L10.9653 15.7446C10.674 15.5915 10.326 15.5915 10.0347 15.7446L6.41562 17.6473C5.68199 18.033 4.82456 17.41 4.96467 16.5931L5.65585 12.5632C5.71148 12.2389 5.60393 11.9079 5.36825 11.6781L2.44038 8.82416C1.84687 8.24562 2.17438 7.23765 2.9946 7.11846L7.04081 6.53051C7.36652 6.48319 7.64808 6.27862 7.79374 5.98347L9.60326 2.31699Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_12042_6907">
                                            <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_12042_6907)">
                                        <path
                                            d="M9.60326 2.31699C9.97008 1.57374 11.0299 1.57374 11.3967 2.31699L13.2063 5.98347C13.3519 6.27862 13.6335 6.48319 13.9592 6.53051L18.0054 7.11846C18.8256 7.23765 19.1531 8.24562 18.5596 8.82416L15.6318 11.6781C15.3961 11.9079 15.2885 12.2389 15.3442 12.5632L16.0353 16.5931C16.1754 17.41 15.318 18.033 14.5844 17.6473L10.9653 15.7446C10.674 15.5915 10.326 15.5915 10.0347 15.7446L6.41562 17.6473C5.68199 18.033 4.82456 17.41 4.96467 16.5931L5.65585 12.5632C5.71148 12.2389 5.60393 11.9079 5.36825 11.6781L2.44038 8.82416C1.84687 8.24562 2.17438 7.23765 2.9946 7.11846L7.04081 6.53051C7.36652 6.48319 7.64808 6.27862 7.79374 5.98347L9.60326 2.31699Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_12042_6907">
                                            <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_12042_6907)">
                                        <path
                                            d="M9.60326 2.31699C9.97008 1.57374 11.0299 1.57374 11.3967 2.31699L13.2063 5.98347C13.3519 6.27862 13.6335 6.48319 13.9592 6.53051L18.0054 7.11846C18.8256 7.23765 19.1531 8.24562 18.5596 8.82416L15.6318 11.6781C15.3961 11.9079 15.2885 12.2389 15.3442 12.5632L16.0353 16.5931C16.1754 17.41 15.318 18.033 14.5844 17.6473L10.9653 15.7446C10.674 15.5915 10.326 15.5915 10.0347 15.7446L6.41562 17.6473C5.68199 18.033 4.82456 17.41 4.96467 16.5931L5.65585 12.5632C5.71148 12.2389 5.60393 11.9079 5.36825 11.6781L2.44038 8.82416C1.84687 8.24562 2.17438 7.23765 2.9946 7.11846L7.04081 6.53051C7.36652 6.48319 7.64808 6.27862 7.79374 5.98347L9.60326 2.31699Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_12042_6907">
                                            <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <h4 class="font-manrope font-semibold text-2xl leading-9 text-black mb-7 max-lg:text-center">
                                Outstanding Experience!!!</h4>
                            <div class="flex items-center mb-7 max-lg:justify-center">
                                <img src="https://pagedone.io/asset/uploads/1704349572.png" alt="John image" class="w-8 h-8">
                                <p class="font-semibold text-lg text-black mx-3">John Watson</p>
                                <span
                                    class="py-1.5 pl-1.5 pr-2 rounded-full bg-indigo-50 text-indigo-600 font-medium text-sm flex items-center gap-1.5">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.14952 9.94216L7.71521 9.37648L7.14952 9.94216ZM6.56569 8.22696C6.25327 7.91454 5.74673 7.91454 5.43431 8.22696C5.1219 8.53938 5.1219 9.04591 5.43431 9.35833L6.56569 8.22696ZM9.27084 9.94216L8.70516 9.37648L9.27084 9.94216ZM13.0685 7.27587C13.3809 6.96345 13.3809 6.45691 13.0685 6.14449C12.7561 5.83208 12.2496 5.83208 11.9371 6.14449L13.0685 7.27587ZM14.95 9C14.95 12.2861 12.2861 14.95 9 14.95V16.55C13.1698 16.55 16.55 13.1698 16.55 9H14.95ZM9 14.95C5.71391 14.95 3.05 12.2861 3.05 9H1.45C1.45 13.1698 4.83025 16.55 9 16.55V14.95ZM3.05 9C3.05 5.71391 5.71391 3.05 9 3.05V1.45C4.83025 1.45 1.45 4.83025 1.45 9H3.05ZM9 3.05C12.2861 3.05 14.95 5.71391 14.95 9H16.55C16.55 4.83025 13.1698 1.45 9 1.45V3.05ZM7.71521 9.37648L6.56569 8.22696L5.43431 9.35833L6.58384 10.5078L7.71521 9.37648ZM6.58384 10.5078C6.81784 10.7419 7.04906 10.9755 7.26559 11.1407C7.50058 11.32 7.8096 11.4922 8.21018 11.4922V9.89216C8.3001 9.89216 8.32879 9.93935 8.23612 9.86865C8.12499 9.78386 7.9812 9.64247 7.71521 9.37648L6.58384 10.5078ZM8.70516 9.37648C8.43916 9.64247 8.29538 9.78386 8.18424 9.86865C8.09157 9.93935 8.12026 9.89216 8.21018 9.89216V11.4922C8.61076 11.4922 8.91978 11.32 9.15477 11.1407C9.37131 10.9755 9.60252 10.7419 9.83653 10.5078L8.70516 9.37648ZM11.9371 6.14449L8.70516 9.37648L9.83653 10.5078L13.0685 7.27587L11.9371 6.14449Z"
                                            fill="#4F46E5" />
                                    </svg>
                                    Verified
                                </span>
    
                            </div>
                            <p class="font-normal text-lg text-gray-500 mb-11 max-lg:text-center">
                          One of the standout features of Pagedone is its intuitive and user-friendly interface. Navigating through the system feels natural, and the layout makes it easy to locate and utilize various design elements. This is particularly beneficial for designers looking to streamline their workflow.
    
                            </p>
                            <div class="flex items-center gap-7 max-lg:justify-center">
                                <button
                                    class="p-2 sm:p-4 rounded-full border group border-gray-200 shadow-sm shadow-transparent transition-all duration-500 hover:bg-indigo-600 hover:shadow-indigo-300 hover:border-indigo-600">
                                    <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-white"
                                        width="26" height="26" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.2503 19.5L9.75 12.9997L16.2541 6.49561" stroke="" stroke-width="1.6"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button
                                    class="p-2 sm:p-4 rounded-full border group border-gray-200 shadow-sm shadow-transparent transition-all duration-500 hover:bg-indigo-600 hover:shadow-indigo-300 hover:border-indigo-600">
                                    <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-white"
                                        xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"
                                        fill="none">
                                        <path d="M9.75408 6.49536L16.2543 12.9956L9.75024 19.4997" stroke=""
                                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>                                           
                                                        
    </div>
</div>
