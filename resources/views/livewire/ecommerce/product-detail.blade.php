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
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_12029_1640)">
                                            <path
                                                d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                fill="#FBBF24" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_12029_1640">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_12029_1640)">
                                            <path
                                                d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                fill="#FBBF24" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_12029_1640">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_12029_1640)">
                                            <path
                                                d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                fill="#FBBF24" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_12029_1640">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_12029_1640)">
                                            <path
                                                d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                fill="#FBBF24" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_12029_1640">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_8480_66029)">
                                            <path
                                                d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                fill="#F3F4F6" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_8480_66029">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
    
                                </div>
                                <span class="pl-2 font-normal leading-7 text-gray-500 text-sm ">1624 review</span>
                            </div>
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
                                <div class="flex items-center py-1 px-2 rounded-full border text-xs">
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

        {{-- Product reviews stats --}}
        <section class="pt-14 relative">
            <div class="w-full max-w-7xl px-4 md:px-5 lg:px-6 mx-auto">
                <h2 class="w-full text-center text-black text-4xl font-semibold font-manrope leading-normal">Latest
                    Reviews</h2>
                <div
                    class="w-full my-14 p-5 rounded-2xl border border-gray-200 justify-start items-start gap-14 grid lg:grid-cols-2 grid-cols-1">
                    <div class="flex-col justify-center items-start gap-6 inline-flex">
                        <div class="w-full flex-col justify-center items-start gap-4 flex">
                            <div class="justify-start items-center gap-4 inline-flex">
                                <h3 class="text-gray-800 text-3xl font-semibold font-manrope leading-normal">4.5</h3>
                                <div class="flex-col justify-center items-start gap-1 inline-flex">
                                    <div class="justify-start items-center gap-1.5 inline-flex">
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g clip-path="url(#clip0_1624_1747)">
                                                    <path
                                                        d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                        fill="#FBBF24" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1624_1747">
                                                        <rect width="20" height="20" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g clip-path="url(#clip0_1624_1747)">
                                                    <path
                                                        d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                        fill="#FBBF24" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1624_1747">
                                                        <rect width="20" height="20" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g clip-path="url(#clip0_1624_1747)">
                                                    <path
                                                        d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                        fill="#FBBF24" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1624_1747">
                                                        <rect width="20" height="20" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g clip-path="url(#clip0_1624_1747)">
                                                    <path
                                                        d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                        fill="#FBBF24" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1624_1747">
                                                        <rect width="20" height="20" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g clip-path="url(#clip0_1515_3510)">
                                                    <path
                                                        d="M9.55163 2.53827C9.73504 2.16665 10.265 2.16665 10.4484 2.53827L12.2579 6.20476C12.4764 6.64747 12.8987 6.95433 13.3873 7.02532L17.4335 7.61327C17.8436 7.67286 18.0074 8.17685 17.7106 8.46611L14.7827 11.3201C14.4292 11.6647 14.2679 12.1612 14.3513 12.6478L15.0425 16.6776C15.1126 17.0861 14.6839 17.3976 14.3171 17.2047L10.698 15.3021C10.261 15.0723 9.73897 15.0723 9.30199 15.3021L5.68295 17.2047C5.31614 17.3976 4.88742 17.0861 4.95747 16.6776L5.64865 12.6478C5.73211 12.1612 5.57078 11.6647 5.21726 11.3201L2.28939 8.46611C1.99263 8.17685 2.15639 7.67286 2.5665 7.61327L6.61271 7.02532C7.10127 6.95433 7.52362 6.64747 7.74211 6.20476L9.55163 2.53827Z"
                                                        stroke="#FBBF24" />
                                                    <g clip-path="url(#clip1_1515_3510)">
                                                        <path
                                                            d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                            fill="#FBBF24" />
                                                    </g>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_1515_3510">
                                                        <rect width="20" height="20" fill="white" />
                                                    </clipPath>
                                                    <clipPath id="clip1_1515_3510">
                                                        <rect width="10" height="20" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="text-gray-400 text-base font-medium leading-relaxed">50k Reviews</div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex-col justify-start items-start gap-2.5 flex">
                            <div class="flex items-center w-full">
                                <p class="font-medium text-lg py-[1px] text-black">5</p>
                                <p class="h-2.5 w-full rounded-[30px] bg-gray-50 ml-5 mr-2.5">
                                    <span class="h-full w-[90%] rounded-[30px] bg-indigo-600 flex"></span>
                                </p>
                                <p class="font-medium text-sm py-[1px] text-gray-800 mr-1.5">90%</p>
                            </div>
                            <div class="flex items-center w-full">
                                <p class="font-medium text-lg py-[1px] text-black">4</p>
                                <p class="h-2.5 w-full rounded-[30px] bg-gray-50 ml-5 mr-2.5">
                                    <span class="h-full w-[60%] rounded-[30px] bg-indigo-600 flex"></span>
                                </p>
                                <p class="font-medium text-sm py-[1px] text-gray-800 mr-1.5">60%</p>
                            </div>
                            <div class="flex items-center w-full">
                                <p class="font-medium text-lg py-[1px] text-black">3</p>
                                <p class="h-2.5 w-full rounded-[30px] bg-gray-50 ml-5 mr-2.5">
                                    <span class="h-full w-[40%] rounded-[30px] bg-indigo-600 flex"></span>
                                </p>
                                <p class="font-medium text-sm py-[1px] text-gray-800 mr-1.5">40%</p>
                            </div>
                            <div class="flex items-center w-full">
                                <p class="font-medium text-lg py-[1px] text-black">2</p>
                                <p class="h-2.5 w-full rounded-[30px] bg-gray-50 ml-5 mr-2.5">
                                    <span class="h-full w-[30%] rounded-[30px] bg-indigo-600 flex"></span>
                                </p>
                                <p class="font-medium text-sm py-[1px] text-gray-800 mr-1.5">30%</p>
                            </div>
                            <div class="flex items-center w-full">
                                <p class="font-medium text-lg py-[1px] text-black">1</p>
                                <p class="h-2.5 w-full rounded-[30px] bg-gray-50 ml-5 mr-2.5">
                                    <span class="h-full w-[3%] rounded-[30px] bg-indigo-600 flex"></span>
                                </p>
                                <p class="font-medium text-sm py-[1px] text-gray-800 mr-1.5 flex items-center">3% <span
                                        class="text-transparent">0</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-col justify-center items-start gap-6 inline-flex">
                        <div class="flex-col justify-center items-start gap-4 flex">
                            <h4 class="text-gray-900 text-xl font-semibold leading-loose">Write your Experience</h4>
                            <p class="text-gray-400 text-base font-normal leading-relaxed">Share your feedback and
                                contribute to shaping an exceptional shopping journey for all. Together, let's build a
                                community where every voice is heard and every experience counts.</p>
                        </div>
                        <button
                            class="sm:w-fit w-full px-5 py-2.5 bg-indigo-600 hover:bg-indigo-800 transition-all duration-700 ease-in-out rounded-xl shadow justify-center items-center flex">
                            <span class="px-2 py-px text-white text-base font-semibold leading-relaxed">Submit
                                Reviews</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        {{-- Product reviews comments --}}
        <section class="relative">
            <div class="w-full max-w-7xl px-4 md:px-5 lg:px-6 mx-auto">
                <h2 class="w-full text-center text-black text-4xl font-semibold font-manrope leading-normal pb-14">Customer Reviews</h2>
                <div class="w-full p-6 bg-gray-50 rounded-2xl justify-center items-start gap-6 inline-flex">
                    <img src="https://pagedone.io/asset/uploads/1714988283.png" alt="image" class="w-16 h-16 rounded-full"/>
                    <div class="w-full flex-col justify-start items-start gap-4 inline-flex">
                        <div class="w-full flex-col justify-center items-start gap-2 flex">
                            <div class="w-full justify-between items-center inline-flex">
                                <h5 class="text-black text-lg font-semibold leading-8">Emma Davis</h5>
                                <div class="justify-start items-start gap-5 flex">
                                    <div class="justify-start items-center gap-1.5 flex">
                                        <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M3 11.4202C3 10.4774 3 10.006 3.29289 9.71311C3.58579 9.42022 4.05719 9.42022 5 9.42022C5.94281 9.42022 6.41421 9.42022 6.70711 9.71311C7 10.006 7 10.4774 7 11.4202V18.4202C7 19.363 7 19.8344 6.70711 20.1273C6.41421 20.4202 5.94281 20.4202 5 20.4202C4.05719 20.4202 3.58579 20.4202 3.29289 20.1273C3 19.8344 3 19.363 3 18.4202V11.4202Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
                                            <path d="M19.9619 15.3137L20.654 10.718C20.8148 9.64971 20.8953 9.11555 20.5961 8.76788C20.2968 8.42022 19.7566 8.42022 18.6763 8.42022H15.5695C15.0382 8.42022 14.7725 8.42022 14.5674 8.32183C14.3623 8.2234 14.1968 8.05794 14.0984 7.85277C14 7.64769 14 7.38202 14 6.85067C14 5.22554 14 4.41296 13.7027 4.05267C13.4083 3.69599 12.9467 3.52253 12.4903 3.59713C12.0293 3.67249 11.4942 4.28401 10.424 5.50705L7.49485 8.85468C7.25015 9.13434 7.12779 9.27417 7.0639 9.44423C7 9.61429 7 9.80009 7 10.1717V14.4202C7 17.2486 7 18.6629 7.87868 19.5415C8.75736 20.4202 10.1716 20.4202 13 20.4202H14.0288C16.4923 20.4202 17.7241 20.4202 18.5679 19.694C19.4116 18.9678 19.595 17.7498 19.9619 15.3137Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
                                        </svg>
                                        </a>
                                        <span class="text-black text-base font-normal leading-relaxed">8</span>
                                    </div>
                                    <div class="justify-start items-center gap-1.5 flex">
                                        <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M7.04962 9.99504L7 10M12 10L11.9504 10.005M17 10L16.9504 10.005M10.5 3H13.5C16.7875 3 18.4312 3 19.5376 3.90796C19.7401 4.07418 19.9258 4.25989 20.092 4.46243C21 5.56878 21 7.21252 21 10.5V12.4777C21 13.8941 21 14.6023 20.8226 15.1779C20.4329 16.4427 19.4427 17.4329 18.1779 17.8226C17.6023 18 16.8941 18 15.4777 18C15.0811 18 14.8828 18 14.6985 18.0349C14.2966 18.1109 13.9277 18.3083 13.6415 18.6005C13.5103 18.7345 13.4003 18.8995 13.1803 19.2295L13.1116 19.3326C12.779 19.8316 12.6126 20.081 12.409 20.198C12.1334 20.3564 11.7988 20.3743 11.5079 20.2462C11.2929 20.1515 11.101 19.9212 10.7171 19.4605L10.2896 18.9475C10.1037 18.7244 10.0108 18.6129 9.90791 18.5195C9.61025 18.2492 9.23801 18.0748 8.83977 18.0192C8.70218 18 8.55699 18 8.26662 18C7.08889 18 6.50002 18 6.01542 17.8769C4.59398 17.5159 3.48406 16.406 3.12307 14.9846C3 14.5 3 13.9111 3 12.7334V10.5C3 7.21252 3 5.56878 3.90796 4.46243C4.07418 4.25989 4.25989 4.07418 4.46243 3.90796C5.56878 3 7.21252 3 10.5 3Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
                                        </svg>
                                        </a>
                                        <span class="text-right text-black text-base font-normal leading-relaxed">2</span>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-start items-center gap-1.5 inline-flex">
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <h6 class="text-right text-gray-500 text-sm font-normal leading-snug">20 Mar, 2024</h6>
                        <p class="text-gray-400 text-base font-normal leading-relaxed">I recently had the opportunity to explore Pagedone's UI design system, and it left a lasting impression on my workflow. The system seamlessly blends user-friendly features with a robust set of design components, making it a go-to for creating visually stunning and consistent interfaces.</p>
                    </div>
                </div>
                <div class="w-full p-6 bg-gray-50 rounded-2xl justify-center items-start gap-6 inline-flex my-8">
                    <img  src="https://pagedone.io/asset/uploads/1714990847.png" alt="image" class="w-16 h-16 rounded-full"/>
                    <div class="w-full flex-col justify-start items-start gap-4 inline-flex">
                        <div class="w-full flex-col justify-center items-start gap-2 flex">
                            <div class="w-full justify-between items-center inline-flex">
                                <h5 class="text-black text-lg font-semibold leading-8">Anuj Mishra</h5>
                                <div class="justify-start items-start gap-5 flex">
                                    <div class="justify-start items-center gap-1.5 flex">
                                        <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M3 11.4202C3 10.4774 3 10.006 3.29289 9.71311C3.58579 9.42022 4.05719 9.42022 5 9.42022C5.94281 9.42022 6.41421 9.42022 6.70711 9.71311C7 10.006 7 10.4774 7 11.4202V18.4202C7 19.363 7 19.8344 6.70711 20.1273C6.41421 20.4202 5.94281 20.4202 5 20.4202C4.05719 20.4202 3.58579 20.4202 3.29289 20.1273C3 19.8344 3 19.363 3 18.4202V11.4202Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
                                            <path d="M19.9619 15.3137L20.654 10.718C20.8148 9.64971 20.8953 9.11555 20.5961 8.76788C20.2968 8.42022 19.7566 8.42022 18.6763 8.42022H15.5695C15.0382 8.42022 14.7725 8.42022 14.5674 8.32183C14.3623 8.2234 14.1968 8.05794 14.0984 7.85277C14 7.64769 14 7.38202 14 6.85067C14 5.22554 14 4.41296 13.7027 4.05267C13.4083 3.69599 12.9467 3.52253 12.4903 3.59713C12.0293 3.67249 11.4942 4.28401 10.424 5.50705L7.49485 8.85468C7.25015 9.13434 7.12779 9.27417 7.0639 9.44423C7 9.61429 7 9.80009 7 10.1717V14.4202C7 17.2486 7 18.6629 7.87868 19.5415C8.75736 20.4202 10.1716 20.4202 13 20.4202H14.0288C16.4923 20.4202 17.7241 20.4202 18.5679 19.694C19.4116 18.9678 19.595 17.7498 19.9619 15.3137Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
                                        </svg>
                                        </a>
                                        <span class="text-black text-base font-normal leading-relaxed">10</span>
                                    </div>
                                    <div class="justify-start items-center gap-1.5 flex">
                                        <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M7.04962 9.99504L7 10M12 10L11.9504 10.005M17 10L16.9504 10.005M10.5 3H13.5C16.7875 3 18.4312 3 19.5376 3.90796C19.7401 4.07418 19.9258 4.25989 20.092 4.46243C21 5.56878 21 7.21252 21 10.5V12.4777C21 13.8941 21 14.6023 20.8226 15.1779C20.4329 16.4427 19.4427 17.4329 18.1779 17.8226C17.6023 18 16.8941 18 15.4777 18C15.0811 18 14.8828 18 14.6985 18.0349C14.2966 18.1109 13.9277 18.3083 13.6415 18.6005C13.5103 18.7345 13.4003 18.8995 13.1803 19.2295L13.1116 19.3326C12.779 19.8316 12.6126 20.081 12.409 20.198C12.1334 20.3564 11.7988 20.3743 11.5079 20.2462C11.2929 20.1515 11.101 19.9212 10.7171 19.4605L10.2896 18.9475C10.1037 18.7244 10.0108 18.6129 9.90791 18.5195C9.61025 18.2492 9.23801 18.0748 8.83977 18.0192C8.70218 18 8.55699 18 8.26662 18C7.08889 18 6.50002 18 6.01542 17.8769C4.59398 17.5159 3.48406 16.406 3.12307 14.9846C3 14.5 3 13.9111 3 12.7334V10.5C3 7.21252 3 5.56878 3.90796 4.46243C4.07418 4.25989 4.25989 4.07418 4.46243 3.90796C5.56878 3 7.21252 3 10.5 3Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
                                        </svg>
                                        </a>
                                        <span class="text-right text-black text-base font-normal leading-relaxed">5</span>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-start items-center gap-1.5 inline-flex">
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <h6 class="text-right text-gray-500 text-sm font-normal leading-snug">16 Dec, 2023</h6>
                        <p class="text-gray-400 text-base font-normal leading-relaxed">I recently had the opportunity to explore Pagedone's UI design system, and it left a lasting impression on my workflow. The system seamlessly blends user-friendly features with a robust set of design components, making it a go-to for creating visually stunning and consistent interfaces.</p>
                    </div>
                </div>
                <div class="w-full p-6 bg-gray-50 rounded-2xl justify-center items-start gap-6 inline-flex">
                    <img src="https://pagedone.io/asset/uploads/1714994893.png" alt="image" class="w-16 h-16 rounded-full"/>
                    <div class="w-full flex-col justify-start items-start gap-4 inline-flex">
                        <div class="w-full flex-col justify-center items-start gap-2 flex">
                            <div class="w-full justify-between items-center inline-flex">
                                <h5 class="text-black text-lg font-semibold leading-8">Robert Karmazov</h5>
                                <div class="justify-start items-start gap-5 flex">
                                    <div class="justify-start items-center gap-1.5 flex">
                                        <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M3 11.4202C3 10.4774 3 10.006 3.29289 9.71311C3.58579 9.42022 4.05719 9.42022 5 9.42022C5.94281 9.42022 6.41421 9.42022 6.70711 9.71311C7 10.006 7 10.4774 7 11.4202V18.4202C7 19.363 7 19.8344 6.70711 20.1273C6.41421 20.4202 5.94281 20.4202 5 20.4202C4.05719 20.4202 3.58579 20.4202 3.29289 20.1273C3 19.8344 3 19.363 3 18.4202V11.4202Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
                                            <path d="M19.9619 15.3137L20.654 10.718C20.8148 9.64971 20.8953 9.11555 20.5961 8.76788C20.2968 8.42022 19.7566 8.42022 18.6763 8.42022H15.5695C15.0382 8.42022 14.7725 8.42022 14.5674 8.32183C14.3623 8.2234 14.1968 8.05794 14.0984 7.85277C14 7.64769 14 7.38202 14 6.85067C14 5.22554 14 4.41296 13.7027 4.05267C13.4083 3.69599 12.9467 3.52253 12.4903 3.59713C12.0293 3.67249 11.4942 4.28401 10.424 5.50705L7.49485 8.85468C7.25015 9.13434 7.12779 9.27417 7.0639 9.44423C7 9.61429 7 9.80009 7 10.1717V14.4202C7 17.2486 7 18.6629 7.87868 19.5415C8.75736 20.4202 10.1716 20.4202 13 20.4202H14.0288C16.4923 20.4202 17.7241 20.4202 18.5679 19.694C19.4116 18.9678 19.595 17.7498 19.9619 15.3137Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
                                        </svg>
                                        </a>
                                        <span class="text-black text-base font-normal leading-relaxed">4</span>
                                    </div>
                                    <div class="justify-start items-center gap-1.5 flex">
                                        <a href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M7.04962 9.99504L7 10M12 10L11.9504 10.005M17 10L16.9504 10.005M10.5 3H13.5C16.7875 3 18.4312 3 19.5376 3.90796C19.7401 4.07418 19.9258 4.25989 20.092 4.46243C21 5.56878 21 7.21252 21 10.5V12.4777C21 13.8941 21 14.6023 20.8226 15.1779C20.4329 16.4427 19.4427 17.4329 18.1779 17.8226C17.6023 18 16.8941 18 15.4777 18C15.0811 18 14.8828 18 14.6985 18.0349C14.2966 18.1109 13.9277 18.3083 13.6415 18.6005C13.5103 18.7345 13.4003 18.8995 13.1803 19.2295L13.1116 19.3326C12.779 19.8316 12.6126 20.081 12.409 20.198C12.1334 20.3564 11.7988 20.3743 11.5079 20.2462C11.2929 20.1515 11.101 19.9212 10.7171 19.4605L10.2896 18.9475C10.1037 18.7244 10.0108 18.6129 9.90791 18.5195C9.61025 18.2492 9.23801 18.0748 8.83977 18.0192C8.70218 18 8.55699 18 8.26662 18C7.08889 18 6.50002 18 6.01542 17.8769C4.59398 17.5159 3.48406 16.406 3.12307 14.9846C3 14.5 3 13.9111 3 12.7334V10.5C3 7.21252 3 5.56878 3.90796 4.46243C4.07418 4.25989 4.25989 4.07418 4.46243 3.90796C5.56878 3 7.21252 3 10.5 3Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
                                        </svg>
                                        </a>
                                        <span class="text-right text-black text-base font-normal leading-relaxed">0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-start items-center gap-1.5 inline-flex">
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <g clip-path="url(#clip0_1615_1999)">
                                          <path d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z" fill="#FBBF24"/>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_1615_1999">
                                            <rect width="20" height="20" fill="white"/>
                                          </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <h6 class="text-right text-gray-500 text-sm font-normal leading-snug">24 Oct, 2023</h6>
                        <p class="text-gray-400 text-base font-normal leading-relaxed">I recently had the opportunity to explore Pagedone's UI design system, and it left a lasting impression on my workflow. The system seamlessly blends user-friendly features with a robust set of design components, making it a go-to for creating visually stunning and consistent interfaces.</p>
                    </div>
                </div>
            </div>
        </section>
                                                        
    </div>
</div>
