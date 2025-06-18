<div>
    <article x-data="{ hoverOnProduct: false, detailPanelOpen: false }" class="w-72 group cursor-pointer no-select" @mouseenter="hoverOnProduct = true"
        @mouseleave="hoverOnProduct = false" title="{{ $product->name }}">
        <a href="{{ $product->detailPageUrl() }}">

            <!-- Image -->
            <div class="relative rounded-t-xl w-full overflow-hidden border bg-white">
                <img src="{{ $product->first_image }}"
                    class="w-full h-56 transition-all duration-700 object-cover group-hover:scale-[1.03]">

                @if ($product->featured)
                    <div class="absolute top-0 left-0 transition duration-200"
                        :class="hoverOnProduct ? 'opacity-40' : 'opacity-100'">
                        <h6 class="text-center font-semibold py-2 tracking-wider px-3 rounded-br-xl bg-red-400 text-white text-xs">
                            Destacado
                        </h6>
                    </div>
                @endif

                <div x-cloak x-show="hoverOnProduct" x-transition
                class="p-0.5 absolute top-1 right-1 flex flex-col gap-2">

                    <x-icon @click.prevent wire:click='toggleWished' code="favorite" 
                    x-tooltip.raw="{{ $product->isOnUserWishlist() ? 'Eliminar de favoritos' : 'Agregar a favoritos' }}"
                    class="transition duration-300 cursor-pointer p-2 shadow-md rounded-full
                    {{ $product->isOnUserWishlist() 
                        ? 'bg-red-400 text-white' 
                        : 'text-red-400 bg-white' }}"
                    style="font-size: 20px" />

                    @if ($quickView)
                        <x-icon @click.prevent="detailPanelOpen = true" code="visibility" x-tooltip.raw="Vistazo rápido"
                        class="transition duration-300 cursor-pointer p-2 text-gray-800 bg-white shadow-md rounded-full"
                        style="font-size: 20px" />
                    @endif
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

                <div
                    class="flex min-[400px]:items-center justify-between gap-2 flex-col 
                min-[400px]:flex-row">
                    <div class="flex items-center gap-2">
                        <h6 class="font-semibold text-xl leading-8 text-black">
                            @if ($product->hasDiscount())
                                <div class="flex items-center gap-1">
                                    <del class="block text-xs text-gray-500">${{ priceFormat($product->price) }}</del>
                                    <x-badge color="green"
                                        class="!rounded-full font-semibold">%{{ $product->discount_percent }}
                                        OFF</x-badge>
                                </div>
                            @endif
                            ${{ priceFormat($product->current_price) }}
                        </h6>
                    </div>

                    <!-- Rating -->
                    <!-- <div class="flex items-center gap-2">
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
                    </div> -->
                </div>
            </div>
        </a>

        @include('ecommerce.partials.products.quick-view-panel')

    </article>
</div>
