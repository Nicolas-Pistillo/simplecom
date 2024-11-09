@extends('layouts.ecommerce')

@section('title', 'Proceso de compra - ' . tenant('ecommerce_name'))

@section('content')

    <div class="pt-10 pb-4 mb-6">
      <h1 class="text-3xl text-center font-bold tracking-tight text-gray-900">
        Finalizá tu compra</h1>
    </div>

    <main class="lg:flex lg:min-h-full lg:flex-row-reverse lg:overflow-hidden">

        <!-- Order summary -->
        <div aria-labelledby="summary-heading" class="mx-auto lg:mr-10 flex w-full max-w-md flex-col bg-gray-50">

          <div class="flex items-center justify-between">

            <h2 class="text-lg font-medium text-gray-900">Resumen</h2>

            <x-button :href="route('ecommerce.products')" type="soft" class="flex items-center">
              Seguir comprando
              <x-icon code="shopping_cart" class="ml-1"/>
            </x-button>
          </div>

          <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
                <h3 class="sr-only">Items in your cart</h3>
                <ul role="list" class="divide-y divide-gray-200 overflow-y-auto max-h-[350px]">
                    <li class="flex px-4 py-6 sm:px-6">
                        <div class="shrink-0">
                            <img src="https://tailwindui.com/plus/img/ecommerce-images/checkout-page-02-product-01.jpg"
                                alt="Front of men's Basic Tee in black." class="w-20 rounded-md">
                        </div>

                        <div class="ml-6 flex flex-1 flex-col">
                            <div class="flex">
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm">
                                        <a href="#" class="font-medium text-gray-700 hover:text-gray-800">Basic
                                            Tee</a>
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-500">Black</p>
                                    <p class="mt-1 text-sm text-gray-500">Large</p>
                                </div>

                                <div class="ml-4 flow-root shrink-0">
                                    <button type="button"
                                        class="-m-2.5 flex items-center justify-center bg-white p-2.5 text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Remove</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                                            data-slot="icon">
                                            <path fill-rule="evenodd"
                                                d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-1 items-end justify-between pt-2">
                                <p class="mt-1 text-sm font-medium text-gray-900">$32.00</p>

                                <div class="ml-4">
                                    <label for="quantity" class="sr-only">Quantity</label>
                                    <select id="quantity" name="quantity"
                                        class="rounded-md border border-gray-300 text-left text-base font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="flex px-4 py-6 sm:px-6">
                        <div class="shrink-0">
                            <img src="https://tailwindui.com/plus/img/ecommerce-images/checkout-page-02-product-02.jpg"
                                alt="Front of men's Basic Tee in sienna." class="w-20 rounded-md">
                        </div>

                        <div class="ml-6 flex flex-1 flex-col">
                            <div class="flex">
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm">
                                        <a href="#" class="font-medium text-gray-700 hover:text-gray-800">Basic
                                            Tee</a>
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-500">Sienna</p>
                                    <p class="mt-1 text-sm text-gray-500">Large</p>
                                </div>

                                <div class="ml-4 flow-root shrink-0">
                                    <button type="button"
                                        class="-m-2.5 flex items-center justify-center bg-white p-2.5 text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Remove</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                                            data-slot="icon">
                                            <path fill-rule="evenodd"
                                                d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-1 items-end justify-between pt-2">
                                <p class="mt-1 text-sm font-medium text-gray-900">$32.00</p>

                                <div class="ml-4">
                                    <label for="quantity" class="sr-only">Quantity</label>
                                    <select id="quantity" name="quantity"
                                        class="rounded-md border border-gray-300 text-left text-base font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="flex px-4 py-6 sm:px-6">
                      <div class="shrink-0">
                          <img src="https://tailwindui.com/plus/img/ecommerce-images/checkout-page-02-product-02.jpg"
                              alt="Front of men's Basic Tee in sienna." class="w-20 rounded-md">
                      </div>

                      <div class="ml-6 flex flex-1 flex-col">
                          <div class="flex">
                              <div class="min-w-0 flex-1">
                                  <h4 class="text-sm">
                                      <a href="#" class="font-medium text-gray-700 hover:text-gray-800">Basic
                                          Tee</a>
                                  </h4>
                                  <p class="mt-1 text-sm text-gray-500">Sienna</p>
                                  <p class="mt-1 text-sm text-gray-500">Large</p>
                              </div>

                              <div class="ml-4 flow-root shrink-0">
                                  <button type="button"
                                      class="-m-2.5 flex items-center justify-center bg-white p-2.5 text-gray-400 hover:text-gray-500">
                                      <span class="sr-only">Remove</span>
                                      <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                                          data-slot="icon">
                                          <path fill-rule="evenodd"
                                              d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                              clip-rule="evenodd"></path>
                                      </svg>
                                  </button>
                              </div>
                          </div>

                          <div class="flex flex-1 items-end justify-between pt-2">
                              <p class="mt-1 text-sm font-medium text-gray-900">$32.00</p>

                              <div class="ml-4">
                                  <label for="quantity" class="sr-only">Quantity</label>
                                  <select id="quantity" name="quantity"
                                      class="rounded-md border border-gray-300 text-left text-base font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                    </li>
                </ul>
                <dl class="space-y-6 border-t border-gray-200 px-4 py-6 sm:px-6">
                    <div class="flex items-center justify-between">
                        <dt class="text-sm">Subtotal</dt>
                        <dd class="text-sm font-medium text-gray-900">$64.00</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-sm">Shipping</dt>
                        <dd class="text-sm font-medium text-gray-900">$5.00</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-sm">Taxes</dt>
                        <dd class="text-sm font-medium text-gray-900">$5.52</dd>
                    </div>
                    <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                        <dt class="text-base font-semibold">Total</dt>
                        <dd class="text-base font-semibold text-gray-900">$75.52</dd>
                    </div>
                </dl>
          </div>
        </div>

        <!-- Checkout form -->
        <section aria-labelledby="payment-heading"
        class="flex-auto overflow-y-auto px-4 pb-16 pt-12 sm:px-6 sm:pt-16 lg:px-8 lg:pb-24 lg:pt-0">

          <div class="mx-auto max-w-lg">
              <h2 class="text-lg font-medium text-gray-900">Tus datos</h2>
                <form class="mt-6">
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
                            <label for="name-on-card" class="block text-sm font-medium text-gray-700">Name on card</label>
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
                            <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>
                            <div class="mt-1">
                                <input type="text" id="region" name="region" autocomplete="address-level1"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="col-span-full sm:col-span-6">
                            <label for="postal-code" class="block text-sm font-medium text-gray-700">Postal code</label>
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
                    </p>
                </form>
          </div>
        </section>
    </main>

@endsection
