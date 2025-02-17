<article x-data="{hoverOnProduct: false}" class="w-72 group cursor-pointer no-select"
@mouseenter="hoverOnProduct = true" @mouseleave="hoverOnProduct = false" title="{{ $product->name }}">
    <a href="{{ $product->detailPageUrl() }}">
        <!-- Image -->
        <div class="relative rounded-t-xl w-full overflow-hidden border">
            <img src="{{ $product->first_image }}"
            class="w-full h-56 transition-all duration-700 object-cover group-hover:scale-[1.03]">

            @if ($product->featured)
                <div class="absolute top-0 left-0 transition duration-200" :class="hoverOnProduct ? 'opacity-40' : 'opacity-100'">
                    <h6 class="text-center font-semibold py-2 tracking-wider px-3 rounded-br-xl bg-red-400 text-white text-xs">
                        Destacado
                    </h6>
                </div>
            @endif

            <div x-show="hoverOnProduct" x-cloak x-transition class="p-0.5 absolute top-1 right-1">
                <x-icon @click.prevent="" code="favorite" x-tooltip.raw="Añadir a favoritos" 
                class="transition duration-300 cursor-pointer p-2 text-red-400 bg-white shadow-md rounded-full"
                style="font-size: 20px" />
            </div>
        </div>

        <!-- Body -->
        <div class="border border-t-0 border-gray-200 w-full rounded-b-xl pb-5 pt-2 px-3 
        shadow-transparent transition duration-500 group-hover:shadow-gray-300 
        group-hover:bg-gray-50 group-hover:border-gray-300 min-h-[125px] flex flex-col justify-between"
        :class="hoverOnProduct ? '!shadow-lg' : '!shadow-sm'">

            <h5 class="mb-2 line-clamp-2 text-sm font-semibold">
                {{ $product->name }}
            </h5>

            <div class="flex min-[400px]:items-center justify-between gap-2 flex-col 
            min-[400px]:flex-row">
                <div class="flex items-center gap-2">
                    <h6 class="font-semibold text-xl leading-8 text-black">
                        @if ($product->hasDiscount())
                            <div class="flex items-center gap-1">
                                <del class="block text-xs text-gray-500">${{ priceFormat($product->price) }}</del> 
                                <x-badge color="green" class="!rounded-full font-semibold">%{{ $product->discount_percent }} OFF</x-badge>
                            </div>
                        @endif
                        ${{ priceFormat($product->current_price) }}
                    </h6>
                </div>

                <!-- Rating -->
                <div class="flex items-center gap-2">
                    <span
                        class="flex items-center gap-1 py-1 px-2 rounded-3xl  text-white font-medium text-sm bg-amber-400">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_13076_15364)">
                                <path
                                    d="M6.10326 2.16708C6.47008 1.42384 7.52992 1.42384 7.89674 2.16708L8.82458 4.0471C8.97024 4.34224 9.25181 4.54681 9.57752 4.59414L11.6522 4.89561C12.4725 5.0148 12.8 6.02277 12.2064 6.6013L10.7052 8.06469C10.4695 8.29443 10.3619 8.62543 10.4176 8.94982L10.772 11.0162C10.9121 11.8331 10.0547 12.456 9.32102 12.0703L7.46534 11.0947C7.17402 10.9416 6.82598 10.9416 6.53466 11.0947L4.67898 12.0703C3.94535 12.456 3.08792 11.8331 3.22803 11.0162L3.58243 8.94982C3.63807 8.62543 3.53052 8.29443 3.29483 8.06469L1.79355 6.60131C1.20004 6.02277 1.52755 5.0148 2.34777 4.89561L4.42248 4.59414C4.74819 4.54681 5.02976 4.34224 5.17542 4.0471L6.10326 2.16708Z"
                                    fill="white" />
                                <g clip-path="url(#clip1_13076_15364)">
                                    <path
                                        d="M6.10326 2.16708C6.47008 1.42384 7.52992 1.42384 7.89674 2.16708L8.82458 4.0471C8.97024 4.34224 9.25181 4.54681 9.57752 4.59414L11.6522 4.89561C12.4725 5.0148 12.8 6.02277 12.2064 6.6013L10.7052 8.06469C10.4695 8.29443 10.3619 8.62543 10.4176 8.94982L10.772 11.0162C10.9121 11.8331 10.0547 12.456 9.32102 12.0703L7.46534 11.0947C7.17402 10.9416 6.82598 10.9416 6.53466 11.0947L4.67898 12.0703C3.94535 12.456 3.08792 11.8331 3.22803 11.0162L3.58243 8.94982C3.63807 8.62543 3.53052 8.29443 3.29483 8.06469L1.79355 6.60131C1.20004 6.02277 1.52755 5.0148 2.34777 4.89561L4.42248 4.59414C4.74819 4.54681 5.02976 4.34224 5.17542 4.0471L6.10326 2.16708Z"
                                        fill="white" />
                                </g>
                            </g>
                            <defs>
                                <clipPath id="clip0_13076_15364">
                                    <rect width="14" height="14" fill="white" />
                                </clipPath>
                                <clipPath id="clip1_13076_15364">
                                    <rect width="14" height="14" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        4.8
                    </span>
                </div>
            </div>
        </div>
    </a>
</article>

{{-- <article class="w-72 rounded-xl border border-gray-200 bg-white shadow-sm 
dark:border-gray-700 dark:bg-gray-800 overflow-hidden">

    <a href="{{ $product->detailPageUrl() }}">
        <img class="mx-auto h-56 w-full object-cover" src="{{ $product->first_image }}" alt="Product image">
    </a>

    <div class="p-4 border-t">

        <div class="mb-4 flex items-center justify-between gap-4">
            
            <x-badge color="green">40% OFF</x-badge>

            <div class="flex items-center justify-end gap-x-2">

                <x-icon code="favorite" class="text-gray-500 p-1.5 border bg-gray-50 rounded-full" />

                <x-icon code="shopping_cart" class="text-gray-500 p-1.5 border bg-gray-50 rounded-full" />

            </div>
        </div>

        <a href="#" class="text-lg line-clamp-2 font-semibold leading-tight text-gray-900 hover:underline dark:text-white">
            {{ $product->name }}
        </a>

        <div class="mt-2 flex items-center gap-2">
            <div class="flex items-center">
                <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                    </path>
                </svg>

                <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                    </path>
                </svg>

                <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                    </path>
                </svg>

                <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                    </path>
                </svg>

                <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                    </path>
                </svg>
            </div>

            <p class="text-sm font-medium text-gray-900 dark:text-white">5.0</p>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">(455)</p>
        </div>

        <ul class="mt-2 flex items-center gap-4">
            <li class="flex items-center gap-2">
                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z">
                    </path>
                </svg>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fast Delivery</p>
            </li>

            <li class="flex items-center gap-2">
                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="M8 7V6c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1h-1M3 18v-7c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z">
                    </path>
                </svg>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Best Price</p>
            </li>
        </ul>

        <div class="mt-4 flex items-center justify-between gap-4">

            <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">
                ${{ priceFormat($product->current_price) }}
            </p>

            <x-button type="secondary" class="flex items-center gap-x-1">
                Agregar <x-icon code="shopping_cart" />
            </x-button>
        </div>
    </div>
</article> --}}
