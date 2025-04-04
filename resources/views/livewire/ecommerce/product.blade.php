<div>
    <article x-data="{ hoverOnProduct: false, detailPanelOpen: false }" class="w-72 group cursor-pointer no-select" @mouseenter="hoverOnProduct = true"
        @mouseleave="hoverOnProduct = false" title="{{ $product->name }}">
        <a href="{{ $product->detailPageUrl() }}">

            <!-- Image -->
            <div class="relative rounded-t-xl w-full overflow-hidden border bg-white">
                <img src="{{ $product->first_image }}"
                    class="w-full h-56 transition-all duration-700 object-contain group-hover:scale-[1.03]">

                @if ($product->featured)
                    <div class="absolute top-0 left-0 transition duration-200"
                        :class="hoverOnProduct ? 'opacity-40' : 'opacity-100'">
                        <h6
                            class="text-center font-semibold py-2 tracking-wider px-3 rounded-br-xl bg-red-400 text-white text-xs">
                            Destacado
                        </h6>
                    </div>
                @endif

                <div x-cloak x-show="hoverOnProduct" x-cloak x-transition
                    class="p-0.5 absolute top-1 right-1 flex flex-col gap-2">
                    <x-icon @click.prevent="alert('Algo pasa')" code="favorite" x-tooltip.raw="Añadir a favoritos"
                        class="transition duration-300 cursor-pointer p-2 text-red-400 bg-white shadow-md rounded-full"
                        style="font-size: 20px" />

                    <x-icon @click.prevent="detailPanelOpen = true" code="visibility" x-tooltip.raw="Vistazo rápido"
                        class="transition duration-300 cursor-pointer p-2 text-gray-800 bg-white shadow-md rounded-full"
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

        <div x-cloak x-show="detailPanelOpen" class="relative z-10" role="dialog" aria-modal="true">

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

                                    <h2 class="text-xl font-medium text-gray-900 sm:pr-12">{{ $product->name }}</h2>

                                    <section aria-labelledby="information-heading" class="mt-1">

                                        <h3 id="information-heading" class="sr-only">Product information</h3>

                                        <div class="flex flex-col sm:flex-row sm:items-center mt-4">

                                            <h6 class="font-manrope font-semibold text-2xl leading-9 text-gray-900 pr-5 
                                            sm:border-r border-gray-200 mr-5">
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

                                        <p class="text-gray-700 text-sm mt-4 line-clamp-4">
                                            {{ !empty($product->description) ? $product->description : 'Sin descripción' }}
                                        </p>
                                    </section>

                                    <section aria-labelledby="options-heading" class="mt-8">
                                        <div>
                                            <button type="submit"
                                                class="mt-8 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add
                                                to bag</button>

                                            <p class="absolute left-4 top-4 text-center sm:static sm:mt-8">
                                                <a href="#"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">View full
                                                    details</a>
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

    </article>
</div>
