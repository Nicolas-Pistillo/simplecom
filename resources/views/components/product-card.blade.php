<div x-data="{hoverOnProduct: false}" @mouseenter="hoverOnProduct = true" @mouseleave="hoverOnProduct = false"
    class="w-72 group cursor-pointer">
    <div class="relative rounded-t-xl w-full overflow-hidden">
        <img src="{{ $image ?? URL::to('img/no-image.png') }}"
        class="w-full h-56 transition-all duration-700 group-hover:scale-[1.05]">

        <div class="absolute top-3 left-0">
            <h6 class="text-center py-1 px-2 rounded-r-full bg-red-400 text-white text-xs">Destacado</h6>
        </div>

        <div x-show="hoverOnProduct" x-cloak x-transition class="p-0.5 absolute top-1 right-1">
            <x-icon code="favorite" class="transition duration-300 cursor-pointer p-2 text-red-400 bg-white shadow-md rounded-full"
            style="font-size: 20px" />
        </div>
    </div>
    <div class="border border-t-0 border-gray-200 w-full rounded-b-xl pb-5 pt-2 px-3 shadow-transparent 
        transition duration-500 group-hover:shadow-gray-300 group-hover:bg-gray-50 group-hover:border-gray-300"
        :class="hoverOnProduct ? '!shadow-lg' : '!shadow-sm'">
        <h5 class="font-medium text-lg leading-8 text-gray-700 mb-2 whitespace-nowrap overflow-hidden text-ellipsis">Trendy Whites</h5>
        <div class="flex min-[400px]:items-center justify-between gap-2 flex-col min-[400px]:flex-row">
            <div class="flex items-center gap-2">
                <h6 class="font-semibold text-xl leading-8 text-black">$74.99</h6>
            </div>
            <div class="flex items-center gap-2">
                <p class="font-medium text-sm text-black">2.4K</p>
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
</div>
