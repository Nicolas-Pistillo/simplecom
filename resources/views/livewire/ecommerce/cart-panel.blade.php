<div>
    <x-drawer ref="cartMenuOpen" containerClasses="!p-0">
        <div class="flex h-full flex-col overflow-y-auto bg-white shadow-xl">

            <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                <div class="flex items-start justify-between border-b pb-2">
                    <h2 class="text-lg font-medium text-gray-900">
                        Productos en el carrito
                    </h2>
                </div>
    
                @if (Cart::count() > 0)
                    <div class="mt-8">
                        <div class="flow-root">
                            <ul role="list" class="-my-6 divide-y divide-gray-200">
                                @foreach (Cart::content() as $product)
                                    <li class="flex py-6">

                                        <div class="h-20 w-20 transition duration-200 flex-shrink-0 overflow-hidden 
                                        rounded-md border border-gray-200 hover:border-gray-300">
                                            <a href="{{ $product->model->detailPageUrl() }}">
                                                <img src="{{ $product->options->image_url }}" alt="product-img"
                                                class="h-full w-full object-cover object-center">
                                            </a>
                                        </div>
            
                                        <div class="ml-4 flex flex-1 flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3 class="transition duration-200 hover:text-blue-600 text-sm">
                                                        <a href="{{ $product->model->detailPageUrl() }}">
                                                            {{ $product->name }}
                                                        </a>
                                                    </h3>
                                                    <p class="ml-4">${{ priceFormat($product->price) }}</p>
                                                </div>
                                                {{-- Variant names <p class="mt-1 text-sm text-gray-500">Salmon</p> --}}
                                            </div>
                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                <p class="text-gray-500">Cantidad: {{ $product->qty }}</p>
            
                                                <div class="flex">
                                                    <button type="button"
                                                    class="font-medium text-red-600 hover:text-red-500">Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="mt-32 flex items-center justify-center">
                        <div class="text-center">
                            <img src="{{ URL::to('img/illustrations/empty_cart.svg') }}" 
                            class="h-48 mb-3 mx-auto" alt="empty-cart-img">

                            <h4 class="text-lg text-gray-700 font-semibold">Carrito vacío</h4>

                            <p class="text-sm text-gray-500">Buscá y agrega los productos que estes buscando</p>
                        </div>
                    </div>
                @endif

                @dump(Cart::content())
                <x-button wire:click='removeAll'>Borrar items</x-button>
            </div>
    
            @if (Cart::count() > 0)
                <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                    <div class="flex justify-between text-base font-medium text-gray-900">
                        <p>Subtotal</p>
                        <p>${{ priceFormat(Cart::subtotal()) }} </p>
                    </div>
                    <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                    <x-button class="w-full mt-6" size="big">Finalizar compra</x-button>
                    <div class="mt-5 flex justify-center text-center text-sm text-gray-500">
                        <p>
                            or
                            <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Continue Shopping
                                <span aria-hidden="true"> &rarr;</span>
                            </button>
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </x-drawer>
</div>
