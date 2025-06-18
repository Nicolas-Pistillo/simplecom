<article class="w-72 rounded-xl border border-gray-200 bg-white shadow-sm 
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
</article>
