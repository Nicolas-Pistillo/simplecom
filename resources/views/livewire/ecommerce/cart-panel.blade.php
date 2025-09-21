<div>
    <x-drawer ref="cartMenuOpen" containerClasses="!p-0 relative z-50">
        <div class="flex h-full flex-col overflow-y-auto bg-white shadow-xl">

            <div class="flex items-center justify-between border-b px-4 sm:px-6 pt-6 pb-2">
                <h2 class="text-lg font-medium text-gray-900">
                    Productos en el carrito
                </h2>

                @if (Cart::count() > 0)
                    <span class="inline-flex items-center 
                    justify-center w-5 h-5 text-xs font-semibold 
                    text-white bg-green-600 rounded-full ring-1 ring-white">
                        {{ Cart::count() }}
                    </span>
                @endif
            </div>

            <div class="flex-1 {{ Cart::count() > 0 ? 'overflow-y-auto' : 'overflow-y-hidden' }} 
                overflow-x-hidden px-4 py-6 sm:px-6 scroll-mx-16" scrollbar-thin>

                @if (Cart::count() > 0)

                    <div class="flow-root">
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                            @foreach (Cart::content() as $product)
                                <li wire:key='{{ $product->rowId }}'>
                                    <div class="py-6 @error("product-$product->rowId-selection") pb-3 @enderror">
                                        <div class="flex">
                                            <div class="h-20 w-20 transition duration-200 flex-shrink-0 overflow-hidden 
                                                rounded-md border border-gray-200 hover:border-gray-300">
                                                <a href="{{ $product->model->detailPageUrl() }}">
                                                    <img src="{{ $product->options->image_url }}" alt="product-img"
                                                    class="h-full w-full object-contain object-center">
                                                </a>
                                            </div>

                                            <div class="ml-4 flex flex-1 flex-col">
                                                <div>
                                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                                        <h3 class="text-sm" title="{{ $product->name }}">

                                                            <a href="{{ $product->model->detailPageUrl() }}"
                                                                class="line-clamp-2 transition duration-200 
                                                                hover:text-blue-600 text-gray-600 font-semibold">
                                                                {{ $product->name }}
                                                            </a>

                                                            @if (count($product->options->variant_values))
                                                                <div class="my-2 flex flex-col text-xs">
                                                                    @foreach ($product->options->variant_values as $name => $value)
                                                                        <span class="text-gray-700">{{ $name }}:
                                                                            {{ $value }}</span>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </h3>
                                                        <p class="ml-4">${{ priceFormat($product->price) }}</p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-1 items-end justify-between text-sm">

                                                    <div class="no-select flex items-center gap-3">
                                                        <div wire:click="changeQty('subtract' ,'{{ $product->rowId }}')"
                                                            class="w-5 h-5 flex items-center justify-center cursor-pointer
                                                            border rounded-full transition duration-200 hover:bg-gray-100">
                                                            <x-icon code="remove" class="text-sm" />
                                                        </div>

                                                        <p class="text-gray-500">{{ $product->qty }}</p>

                                                        <div wire:click="changeQty('add','{{ $product->rowId }}')"
                                                            class="w-5 h-5 flex items-center justify-center cursor-pointer
                                                            border rounded-full transition duration-200 hover:bg-gray-100">
                                                            <x-icon code="add" class="text-sm" />
                                                        </div>
                                                    </div>

                                                    <div class="flex">
                                                        <button type="button"
                                                            wire:click="removeItem('{{ $product->rowId }}')"
                                                            class="font-medium text-red-600 hover:text-red-500">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @error("product-$product->rowId-selection")
                                            <span class="inline-flex mt-3 text-red-500 text-xs">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="mt-32 flex items-center justify-center">
                        <div class="text-center animate__animated animate__backInUp">
                            <img src="{{ URL::to('img/illustrations/empty_cart.svg') }}" class="h-48 mb-3 mx-auto"
                                alt="empty-cart-img">

                            <h4 class="text-lg text-gray-700 font-semibold">Carrito vacío</h4>

                            <p class="text-sm text-gray-500">
                                Explorá y agrega los productos que estés buscando en {{ tenant('ecommerce_name') }}
                            </p>

                            <x-button :href="route('ecommerce.products')" 
                            class="inline-block mt-3" type="soft">
                                Ver productos
                            </x-button>
                        </div>
                    </div>
                @endif

            </div>

            @if (Cart::count() > 0)
                <div class="border-t border-gray-200 px-4 py-6 sm:px-6">

                    <div class="flex justify-between text-base font-medium text-gray-900">
                        <p>Subtotal</p>
                        <p>${{ priceFormat(Cart::subtotal()) }} </p>
                    </div>

                    {{-- <p class="mt-1 text-xs text-gray-500">
                        Las tarifas de envío o impuestos se calcularán durante el proceso de compra.
                    </p> --}}

                    <x-button :href="route('ecommerce.checkout')" size="big"
                    class="inline-block w-full text-center mt-6">
                        Finalizar compra
                    </x-button>

                    <div class="mt-3 flex justify-center text-center text-sm text-gray-500">
                        <div class="flex items-center">
                            <a href="{{ route('ecommerce.products') }}" class="font-medium text-blue-600 hover:text-blue-500 flex items-center cursor-pointer">
                                continuar comprando
                                <x-icon code="arrow_forward" class="ml-1" />
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </x-drawer>
</div>
