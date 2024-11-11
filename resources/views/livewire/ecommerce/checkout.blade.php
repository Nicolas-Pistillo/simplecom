<div>

    @if (Cart::count() > 0)
        <div class="pt-10 pb-4 mb-6">
            <h1 class="text-3xl text-center font-bold tracking-tight text-gray-900">
                Finalizá tu compra</h1>
        </div>

        <main class="lg:flex lg:min-h-full lg:flex-row-reverse lg:overflow-hidden pb-16">

            <!-- Order summary -->
            <div aria-labelledby="summary-heading" class="mx-auto lg:mr-10 flex w-full max-w-md flex-col bg-gray-50">

                <div class="flex items-center justify-between px-3 sm:px-0">

                    <h2 class="text-lg font-medium text-gray-900">Resumen</h2>

                    <x-button :href="route('ecommerce.products')" type="soft" class="flex items-center">
                        Seguir comprando
                        <x-icon code="shopping_cart" class="ml-1" />
                    </x-button>
                </div>

                <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
                    <ul role="list" class="divide-y divide-gray-200 overflow-y-auto sm:max-h-[350px]" scrollbar-thin>

                        @foreach (Cart::content() as $product)
                            <li wire:key='{{ $product->rowId }}'
                                class="flex px-4 py-6 sm:px-6 transition-colors duration-300 hover:bg-gray-50">

                                <div class="shrink-0">
                                    <img src="{{ $product->options->image_url }}" alt="{{ $product->name }}"
                                        class="w-20 rounded-md">
                                </div>

                                <div class="ml-6 flex flex-1 flex-col">
                                    <div class="flex">
                                        <div class="min-w-0 flex-1">
                                            <h4 class="text-sm">
                                                <a href="{{ $product->model->detailPageUrl() }}"
                                                    class="font-medium text-gray-700 hover:text-blue-600
                                                transition-colors duration-300">
                                                    {{ $product->name }}
                                                </a>
                                            </h4>
                                            @if (count($product->options->variant_attribute_names))
                                                <div class="flex flex-col text-xs">
                                                    @foreach ($product->options->variant_attribute_names as $name => $value)
                                                        <span class="mt-1 text-gray-500">
                                                            {{ $name }}: {{ $value }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <div class="ml-4 flow-root shrink-0">
                                            <button wire:click="removeItem('{{ $product->rowId }}')" 
                                            x-tooltip.raw.placement.left="Quitar del carrito" type="button"
                                            class="-m-2.5 flex items-center transition
                                            duration-300 justify-center bg-inherit p-2.5 bg-inherit text-gray-400 
                                            hover:text-red-500">
                                                <x-icon code="delete" />
                                            </button>
                                        </div>
                                    </div>

                                    <div class="flex flex-1 items-end justify-between pt-2">

                                        <p class="mt-1 text-sm font-medium text-gray-900">
                                            ${{ priceFormat($product->price) }}
                                        </p>

                                        <div class="flex items-center gap-2">
                                            <button wire:click="changeQty('subtract' ,'{{ $product->rowId }}')"
                                                class="group rounded-full border border-gray-200 shadow-sm shadow-transparent 
                                            p-2 flex items-center justify-center bg-white transition-all duration-500 hover:shadow-gray-200 
                                            hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                                                <x-icon code="remove" style="font-size: 16px" />
                                            </button>

                                            <input type="text" readonly
                                                class="border border-gray-200 rounded-full w-10
                                            aspect-square outline-none text-gray-900 font-semibold 
                                            text-sm py-1.5 px-3 bg-gray-100  text-center"
                                                placeholder="{{ $product->qty }}">

                                            <button wire:click="changeQty('add' ,'{{ $product->rowId }}')"
                                                class="group rounded-full border border-gray-200 shadow-sm shadow-transparent 
                                            p-2 flex items-center justify-center bg-white transition-all duration-500 hover:shadow-gray-200 
                                            hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                                                <x-icon code="add" style="font-size: 16px" />
                                            </button>
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
                    <dl class="space-y-6 border-t border-gray-200 px-4 py-6 sm:px-6">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">
                                ${{ priceFormat(Cart::subtotal()) }}
                            </dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-sm">Impuestos</dt>
                            <dd class="text-sm font-medium text-gray-900">
                                ${{ priceFormat(Cart::tax()) }}
                            </dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-sm">Envío</dt>
                            <dd class="text-sm font-medium text-gray-900">
                                @if ($shippingOption)
                                    
                                @else
                                    No calculado
                                @endif
                            </dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                            <dt class="text-base font-semibold">Total</dt>
                            <dd class="text-base font-semibold text-gray-900">
                                ${{ priceFormat(Cart::total()) }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Checkout form -->
            <section aria-labelledby="payment-heading"
                class="flex-auto overflow-y-auto px-4 pb-16 pt-12 sm:px-6 sm:pt-16 lg:px-8 lg:pb-24 lg:pt-0">

                <div class="mx-auto max-w-lg">
                    <h2 class="text-lg font-medium text-gray-900">Inicia sesión o registrate</h2>
                    <div class="mt-6">

                        <div class="grid grid-cols-12 gap-x-4 gap-y-6">

                            <div class="col-span-full sm:col-span-6">
                                <label for="email-address" class="block text-sm font-medium text-gray-700">
                                    Email
                                </label>
                                <div class="mt-1">
                                    <input type="email" id="email-address" name="email-address" autocomplete="email"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="col-span-full sm:col-span-6">
                                <label for="" class="block text-sm font-medium text-gray-700">Contraseña</label>
                                <div class="mt-1">
                                    <input type="password" name="" id=""
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <x-button wire:click="checkUser" size="large" class="mt-3">Continuar</x-button>

                        {{-- 
                            Form example
                        <div class="grid grid-cols-12 gap-x-4 gap-y-6">

                            <div class="col-span-full">
                                <label for="email-address" class="block text-sm font-medium text-gray-700">Email
                                    address</label>
                                <div class="mt-1">
                                    <input type="email" id="email-address" name="email-address" autocomplete="email"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="name-on-card" class="block text-sm font-medium text-gray-700">Name on
                                    card</label>
                                <div class="mt-1">
                                    <input type="text" id="name-on-card" name="name-on-card" autocomplete="cc-name"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="card-number" class="block text-sm font-medium text-gray-700">Card number</label>
                                <div class="mt-1">
                                    <input type="text" id="card-number" name="card-number" autocomplete="cc-number"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="col-span-8 sm:col-span-9">
                                <label for="expiration-date" class="block text-sm font-medium text-gray-700">Expiration date
                                    (MM/YY)</label>
                                <div class="mt-1">
                                    <input type="text" name="expiration-date" id="expiration-date" autocomplete="cc-exp"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="col-span-4 sm:col-span-3">
                                <label for="cvc" class="block text-sm font-medium text-gray-700">CVC</label>
                                <div class="mt-1">
                                    <input type="text" name="cvc" id="cvc" autocomplete="csc"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="col-span-full sm:col-span-7">
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <div class="mt-1">
                                    <input type="text" id="address" name="address" autocomplete="street-address"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="col-span-full sm:col-span-5">
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <div class="mt-1">
                                    <input type="text" id="city" name="city" autocomplete="address-level2"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="col-span-full sm:col-span-6">
                                <label for="region" class="block text-sm font-medium text-gray-700">State /
                                    Province</label>
                                <div class="mt-1">
                                    <input type="text" id="region" name="region" autocomplete="address-level1"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="col-span-full sm:col-span-6">
                                <label for="postal-code" class="block text-sm font-medium text-gray-700">Postal
                                    code</label>
                                <div class="mt-1">
                                    <input type="text" id="postal-code" name="postal-code" autocomplete="postal-code"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="my-6 flex space-x-2">
                            <div class="flex h-5 items-center">
                                <input id="same-as-shipping" name="same-as-shipping" type="checkbox" checked
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            </div>
                            <label for="same-as-shipping" class="text-sm font-medium text-gray-900">Billing address is the
                                same as shipping address</label>
                        </div>

                        <x-button size="big" class="w-full my-2">
                            Confirmar
                        </x-button>

                        <p class="mt-1 flex justify-center text-sm font-medium text-gray-500">
                            <svg class="mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Payment details stored in plain text
                        </p> --}}
                    </div>
                </div>
            </section>
        </main>
    @else
        <div class="py-16 sm:py-36 flex flex-col items-center">

            <div class="w-48 h-48 sm:w-64 sm:h-64 animate__animated animate__bounceIn">
                <img src="{{ URL::to('img/illustrations/empty_cart.svg') }}" alt="Carrito vacío">
            </div>

            <h4 class="text-xl mb-2 font-semibold text-gray-900">Carrito vacío</h4>
            <p class="text-sm mb-3">Agrega productos para completar tu próxima compra</p>
            <x-button :href="route('ecommerce.products')" type="secondary">Explorar productos</x-button>

        </div>
    @endif
</div>
