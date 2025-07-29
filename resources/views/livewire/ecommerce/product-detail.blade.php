<div>
    <div x-data class="py-8 lg:py-14 relative overflow-x-hidden">

        {{-- Product Overview --}}
        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">

                {{-- Product images block --}}
                <div
                    class="no-select w-full flex md:block flex-col justify-center order-last 
                max-lg:max-w-[608px] max-lg:mx-auto">

                    {{-- Category trees bradcrumb --}}
                    <div class="mb-3">
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol role="list" class="flex items-center space-x-2 text-sm">

                                {{-- Category Grandfather --}}
                                @if ($product->category->father?->father)
                                    <li>
                                        <div class="flex items-center">
                                            <a href="{{ $product->category->father->father->pageUrl() }}"
                                                class="text-gray-400 hover:text-blue-600 mr-1">
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
                                            <a href="{{ $product->category->father->pageUrl() }}"
                                                class="text-gray-400 hover:text-blue-600 mr-1">
                                                <span>{{ $product->category->father->name }}</span>
                                            </a>
                                            <x-icon code="navigate_next" class="text-gray-400"
                                                style="font-size: 20px" />
                                        </div>
                                    </li>
                                @endif

                                <li>
                                    <div class="flex items-center">
                                        <a href="{{ $product->category->pageUrl() }}"
                                            class="text-gray-400 hover:text-blue-600 mr-1">
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
                                class="w-full sm:w-[500px] h-[350px] sm:h-[450px] 
                            object-cover rounded-lg shadow-md">
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
                <div class="pro-detail w-full flex flex-col order-last 
                max-lg:max-w-[608px] max-lg:mx-auto">

                    {{-- Category, Brand & LikeButton --}}
                    <div class="flex justify-between items-center mb-3">

                        <div class="flex items-center">
                            {{-- <p class="font-medium text-{{ tenant('color') }}-600"> {{ $product->category->name }} </p> --}}
                            @if ($product->brand)
                                <a href="{{ $product->brand->pageUrl() }}"
                                    class="inline-flex items-center bg-white pr-3 shadow rounded-full
                                transition duration-300 hover:shadow-lg cursor-pointer"
                                    x-tooltip.raw.placement.right="Ver mas productos de esta marca">
                                    <img src="{{ !empty($product->brand->image_url) ? Storage::url($product->brand->image_url) : URL::to('img/no-image-alt.png') }}"
                                        class="w-8 h-8 rounded-full" alt="brand-logo">
                                    <small class="ml-1 text-gray-700 font-semibold">{{ $product->brand->name }}</small>
                                </a>
                            @endif
                        </div>

                        <x-icon code="favorite" wire:click='toggleWished'
                            x-tooltip.raw.placement.left="{{ $product->isOnUserWishlist() ? 'Eliminar de favoritos' : 'Agregar a favoritos' }}"
                            class="transition duration-300 cursor-pointer p-2 shadow hover:shadow-lg rounded-full
                        {{ $product->isOnUserWishlist() ? 'bg-red-400 text-white' : 'text-red-400 bg-white' }}" />
                    </div>

                    {{-- Product name --}}
                    <h1 class="mb-2 font-manrope font-bold text-3xl leading-10 text-gray-900">
                        {{ $product->name }}
                    </h1>

                    {{-- Price & Reviews --}}
                    <div class="mb-6">
                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <h6 class="font-manrope font-semibold text-2xl leading-9 text-gray-900 pr-5 
                            {{-- sm:border-r --}} border-gray-200 mr-5">
                                @if ($product->hasDiscount())
                                    <div class="flex items-center">
                                        <del
                                            class="block text-xs text-gray-500">${{ priceFormat($product->price) }}</del>
                                        <span class="text-green-500 text-xs ml-1.5">%{{ $product->discount_percent }}
                                            OFF</span>
                                    </div>
                                @endif
                                ${{ priceFormat($product->current_price) }}
                            </h6>
                            {{-- <button class="flex items-center gap-1 rounded-lg bg-amber-400 py-1.5 px-2.5 w-max">
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
                            </button> --}}
                        </div>
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
                                        <svg wire:loading.remove wire:target='substractQuantity'
                                            class="stroke-black group-hover:stroke-black" width="22" height="22"
                                            viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                stroke-linecap="round">
                                            </path>
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                stroke-width="1.6" stroke-linecap="round"></path>
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                stroke-width="1.6" stroke-linecap="round"></path>
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
                                            class="stroke-black group-hover:stroke-black" width="22"
                                            height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
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
                            <x-icon wire:loading.remove wire:target='addToCart' code="shopping_cart"
                                class="mr-2" />
                            <div wire:loading wire:target='addToCart'>
                                <x-spinner class="mr-2" />
                            </div>
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

        {{-- FAQs --}}
        <section>
            <div class="mx-auto max-w-7xl px-6 py-24 sm:pt-32 lg:px-8">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                    <div class="lg:col-span-5">
                        <h2 class="text-3xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-4xl">
                            Preguntas Frecuentes
                        </h2>
                        <p class="mt-4 text-base/7 text-pretty text-gray-600">Can’t find the answer you’re looking for?
                            Reach out to our <a href="#"
                            class="font-semibold text-indigo-600 hover:text-indigo-500">customer support</a> team.
                        </p>
                    </div>
                    <dl class="lg:col-span-7 divide-y divide-gray-900/10">
                        @for ($i = 0; $i < 7; $i++)
                            <div x-data="{open: false}" class="py-6 first:pt-0 last:pb-0">
                                <dt>
                                    <button @click="open = !open" type="button" class="flex w-full items-start 
                                    justify-between text-left text-gray-900">
                                        <span class="text-base/7 font-semibold">
                                            ¿{{ fake()->sentence }}?
                                        </span>
                                        <span class="ml-6 flex h-7 items-center">
                                            <i class="material-symbols-outlined" x-text="open ? 'remove' : 'add'"></i>
                                        </span>
                                    </button>
                                </dt>
                                <div x-cloak x-show="open" x-transition>
                                    <dd class="mt-2 pr-12">
                                        <p class="text-base/7 text-gray-600">I don't know, but the flag is a big plus.
                                            {{ fake()->sentence(70) }}
                                        </p>
                                    </dd>
                                </div>
                            </div>
                        @endfor
                    </dl>
                </div>
            </div>
        </section>

        {{-- Product reviews --}}
        @include('ecommerce.partials.product-detail.reviews')

    </div>
</div>
