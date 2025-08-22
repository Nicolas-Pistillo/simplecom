<div>
    <div class="bg-white">
        <div class="mx-auto px-4 py-16 sm:px-6 lg:max-w-7xl lg:px-8">

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
                                    <x-icon code="navigate_next" class="text-gray-400" style="font-size: 20px" />
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
                                    <x-icon code="navigate_next" class="text-gray-400" style="font-size: 20px" />
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

            {{-- - Product --}}
            <div class="lg:grid lg:grid-cols-7 lg:grid-rows-1 lg:gap-x-8 lg:gap-y-10 xl:gap-x-16">

                {{-- Product Images --}}
                <div x-data="{ currentImage: '{{ $product->first_image }}' }" 
                class="lg:col-span-4 lg:row-end-1">

                    <img x-bind:src="currentImage" alt="{{ $product->name }}"
                    class="w-full sm:w-[600px] h-[350px] sm:h-[450px] 
                    rounded-md object-contain mb-4" />

                    {{-- All product images list --}}
                    <div class="w-[500px] flex items-center gap-3 flex-wrap">
                        @if ($product->images->count() > 1)
                            @foreach ($product->images as $image)
                                <div class="shadow rounded-lg border-2 border-transparent
                                    cursor-pointer overflow-hidden"
                                    :class="currentImage == '{{ Storage::url($image->url) }}' ?
                                        '!border-blue-600' :
                                        'hover:border-blue-600'">
                                    <img src="{{ Storage::url($image->url) }}" class="w-16 h-16 object-cover rounded-lg"
                                        alt="product-image"
                                        @mouseenter.prevent="currentImage = '{{ Storage::url($image->url) }}'">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- Product Details --}}
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
                                        <del
                                            class="block text-xs text-gray-500">${{ priceFormat($product->price) }}</del>
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
                                <span class="text-gray-500 text-xs">2 vendidos</span>

                                {{-- Current AVG --}}
                                <div class="flex items-center -mt-1">
                                    <!-- Active: "text-yellow-400", Default: "text-gray-300" -->
                                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                        class="w-8 h-8 shrink-0 text-yellow-400">
                                        <path
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                            clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>

                                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                        class="w-8 h-8 shrink-0 text-yellow-400">
                                        <path
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                            clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>

                                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                        class="w-8 h-8 shrink-0 text-yellow-400">
                                        <path
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                            clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>

                                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                        class="w-8 h-8 shrink-0 text-yellow-400">
                                        <path
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                            clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>

                                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                        class="w-8 h-8 shrink-0 text-gray-300">
                                        <path
                                            d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                            clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
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
                            <a href="{{ $product->brand->pageUrl() }}" class="inline-flex w-max 
                                items-center bg-white pr-3 shadow rounded-full mb-2
                                transition duration-300 hover:shadow-lg cursor-pointer"
                                x-tooltip.raw.placement.right="Ver mas productos de esta marca">
                                <img src="{{ !empty($product->brand->image_url) ? Storage::url($product->brand->image_url) : URL::to('img/no-image-alt.png') }}"
                                class="w-8 h-8 rounded-full object-contain" alt="brand-logo">
                                <small class="ml-1 text-gray-700 font-semibold">{{ $product->brand->name }}</small>
                            </a>
                        @endif
                    </div>

                    {{-- CTA buttons --}}
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">

                        {{-- Buy now --}}
                        <x-button wire:click='buyNow' size="big" class="col-span-full !rounded-full">
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
                                <x-icon wire:loading.remove wire:target='addToCart' code="shopping_cart"
                                    class="mr-2" />
                                <div wire:loading wire:target='addToCart'>
                                    <x-spinner class="mr-2" />
                                </div>
                                Agregar al carrito
                            </x-button>
                        </div>
                    </div>

                    {{-- Dimensions --}}

                    @if (!empty($product->width) || !empty($product->height) || !empty($product->weight))
                        <div class="mt-10 border-t border-gray-200 pt-10">
                            <h3 class="text-sm font-medium text-gray-900">Dimensiones</h3>
                            <div class="mt-4">
                                <ul role="list" class="list-disc space-y-1 pl-5 text-sm/6 
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

                    <div class="mt-10 border-t border-gray-200 pt-10">
                        <h3 class="text-sm font-medium text-gray-900">Highlights</h3>
                        <div class="mt-4">
                            <ul role="list"
                                class="list-disc space-y-1 pl-5 text-sm/6 text-gray-500 marker:text-gray-300">
                                <li class="pl-2">200+ SVG icons in 3 unique styles</li>
                                <li class="pl-2">Compatible with Figma, Sketch, and Adobe XD</li>
                                <li class="pl-2">Drawn on 24 x 24 pixel grid</li>
                            </ul>
                        </div>
                    </div>

                    {{-- License --}}
                    <div class="mt-10 border-t border-gray-200 pt-10">
                        <h3 class="text-sm font-medium text-gray-900">License</h3>
                        <p class="mt-4 text-sm text-gray-500">For personal and professional use. You cannot resell or
                            redistribute these icons in their original or modified state. <a href="#"
                                class="font-medium text-indigo-600 hover:text-indigo-500">Read full license</a></p>
                    </div>

                    {{-- Share product link --}}
                    <div class="mt-10 border-t border-gray-200 pt-10">
                        <h3 class="text-sm font-medium text-gray-900">Share</h3>
                        <ul role="list" class="mt-4 flex items-center space-x-6">
                            <li>
                                <a href="#"
                                    class="flex size-6 items-center justify-center text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Share on Facebook</span>
                                    <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="w-8 h-8">
                                        <path
                                            d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z"
                                            clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex size-6 items-center justify-center text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Share on Instagram</span>
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="size-6">
                                        <path
                                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                            clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex size-6 items-center justify-center text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Share on X</span>
                                    <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="w-8 h-8">
                                        <path
                                            d="M11.4678 8.77491L17.2961 2H15.915L10.8543 7.88256L6.81232 2H2.15039L8.26263 10.8955L2.15039 18H3.53159L8.87581 11.7878L13.1444 18H17.8063L11.4675 8.77491H11.4678ZM9.57608 10.9738L8.95678 10.0881L4.02925 3.03974H6.15068L10.1273 8.72795L10.7466 9.61374L15.9156 17.0075H13.7942L9.57608 10.9742V10.9738Z" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Additional info tabs --}}
                <div class="mx-auto w-full max-w-2xl lg:col-span-4 lg:max-w-none overflow-y-hidden">
                    <x-tabs simple current="Descripción" containerClass="!w-full"
                        tabs="['Descripción', 'Reseñas', 'Preguntas Frecuentes', 'Licencia']">

                        <div x-cloak x-show="current === 'Descripción'">
                            {{-- Description --}}
                            <p class="mt-6 text-gray-500">
                                {!! !empty($product->description) ? $product->description : 'Sin descripción' !!}
                            </p>
                        </div>

                        <div x-cloak x-show="current === 'Reseñas'">

                            <div class="flex space-x-4 text-sm text-gray-500">
                                <div class="flex-none">
                                    <img src="{{ initialsAvatar(['name' => 'Emily Selman']) }}" alt=""
                                        class="w-8 h-8 rounded-full bg-gray-100">
                                </div>
                                <div class="pb-8">

                                    <h3 class="font-medium text-gray-900">Emily Selman</h3>

                                    <p><time datetime="2021-07-16">July 16, 2021</time></p>

                                    <div class="flex items-center">
                                        <!-- Active: "text-yellow-400", Default: "text-gray-300" -->
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </div>

                                    <div class="mt-4 text-sm/6 text-gray-500">
                                        <p>This icon pack is just what I need for my latest project. There's an icon for
                                            just about anything I could ever need. Love the playful look!</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex space-x-4 text-sm text-gray-500">
                                <div class="flex-none py-10">
                                    <img src="{{ initialsAvatar(['name' => 'Hector Gibbons']) }}" alt=""
                                        class="w-8 h-8 rounded-full bg-gray-100">
                                </div>
                                <div class="border-t border-gray-200 py-10">
                                    <h3 class="font-medium text-gray-900">Hector Gibbons</h3>
                                    <p><time datetime="2021-07-12">July 12, 2021</time></p>

                                    <div class="mt-4 flex items-center">
                                        <!-- Active: "text-yellow-400", Default: "text-gray-300" -->
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="sr-only">5 out of 5 stars</p>

                                    <div class="mt-4 text-sm/6 text-gray-500">
                                        <p>Blown away by how polished this icon pack is. Everything looks so consistent
                                            and each SVG is optimized out of the box so I can use it directly with
                                            confidence. It would take me several hours to create a single icon this
                                            good, so it's a steal at this price.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex space-x-4 text-sm text-gray-500">

                                <div class="flex-none py-10">
                                    <img src="{{ initialsAvatar(['name' => 'Mark Edwards']) }}" alt=""
                                        class="w-8 h-8 rounded-full bg-gray-100">
                                </div>

                                <div class="border-t border-gray-200 py-10">

                                    <h3 class="font-medium text-gray-900">Mark Edwards</h3>

                                    <p><time datetime="2021-07-06">July 6, 2021</time></p>

                                    <div class="mt-4 flex items-center">
                                        <!-- Active: "text-yellow-400", Default: "text-gray-300" -->
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-yellow-400">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                            class="w-6 h-6 shrink-0 text-gray-300">
                                            <path
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </div>

                                    <div class="mt-4 text-sm/6 text-gray-500">
                                        <p>
                                            Really happy with look and options of these icons. I've found uses for them
                                            everywhere in my recent projects. I hope there will be 20px versions in the
                                            future!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div x-cloak x-show="current === 'Preguntas Frecuentes'" class="text-sm text-gray-500">
                            @if (FaqsService::hasQuestions())
                                <dl x-data="{ selected: false }" class="lg:col-span-7 lg:mt-0 divide-y divide-gray-900/10">

                                    @foreach (FaqsService::get() as $faq)
                                        <div @click="selected === {{ $faq->id }} ? selected = false : selected = {{ $faq->id }}"
                                            class="py-6 first:pt-0 last:pb-0">
                                            <dt>
                                                <button @click="open = !open" type="button"
                                                    class="flex w-full items-start 
                                                    justify-between text-left text-gray-900">
                                                    <span class="text-base/7 font-semibold">{{ $faq->question }}</span>
                                                    <span class="ml-6 flex h-7 items-center">
                                                        <i class="material-symbols-outlined"
                                                            x-text="selected === {{ $faq->id }} ? 'remove' : 'add'"></i>
                                                    </span>
                                                </button>
                                            </dt>
                                            <div x-cloak x-show="selected === {{ $faq->id }}" x-collapse>
                                                <dd class="mt-2 pr-12">
                                                    <p class="text-base/7 text-gray-600">{{ $faq->response }}</p>
                                                </dd>
                                            </div>
                                        </div>
                                    @endforeach
                                </dl>
                            @endif
                        </div>

                        <div x-cloak x-show="current === 'Licencia'" class="pt-10">
                            <h3 class="sr-only">License</h3>

                            <div class="text-sm text-gray-500">
                                <h4>Overview</h4>

                                <p>For personal and professional use. You cannot resell or redistribute these icons in
                                    their original or modified state.</p>

                                <ul role="list">
                                    <li>You're allowed to use the icons in unlimited projects.</li>
                                    <li>Attribution is not required to use the icons.</li>
                                </ul>

                                <h4>What you can do with it</h4>

                                <ul role="list">
                                    <li>Use them freely in your personal and professional work.</li>
                                    <li>Make them your own. Change the colors to suit your project or brand.</li>
                                </ul>

                                <h4>What you can't do with it</h4>

                                <ul role="list">
                                    <li>Don't be greedy. Selling or distributing these icons in their original or
                                        modified state is prohibited.</li>
                                    <li>Don't be evil. These icons cannot be used on websites or applications that
                                        promote illegal or immoral beliefs or activities.</li>
                                </ul>
                            </div>
                        </div>
                    </x-tabs>
                </div>
            </div>
        </div>
    </div>
</div>
