@extends('layouts.ecommerce')

@section('content')
    <!-- Pre-Content / Advicements -->
    <div class="bg-gray-50">
        <div class="mx-auto max-w-7xl py-16 lg:px-4">
            <div class="mx-auto max-w-2xl px-4 lg:max-w-none">
                <div class="grid grid-cols-1 items-center gap-x-16 gap-y-10 lg:grid-cols-2">
                    <div>
                        <h2 class="text-4xl font-bold tracking-tight text-gray-900">We built our business on great customer
                            service</h2>
                        <p class="mt-4 text-gray-500">At the beginning at least, but then we realized we could make a lot
                            more money if we kinda stopped caring about that. Our new strategy is to write a bunch of things
                            that look really good in the headlines, then clarify in the small print but hope people don't
                            actually read it.</p>
                    </div>
                    <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg bg-gray-100">
                        <img src="https://tailwindui.com/img/ecommerce-images/incentives-07-hero.jpg" alt=""
                            class="object-cover object-center">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50">
        <div class="mx-auto max-w-2xl px-4 py-16 lg:max-w-7xl lg:px-8">
            <div class="grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 lg:gap-x-8">
                <div>
                    <img src="https://tailwindui.com/img/ecommerce/icons/icon-delivery-light.svg" alt=""
                        class="h-24 w-auto">
                    <h3 class="mt-6 text-sm font-medium text-gray-900">Free Shipping</h3>
                    <p class="mt-2 text-sm text-gray-500">It&#039;s not actually free we just price it into the products.
                        Someone&#039;s paying for it, and it&#039;s not us.</p>
                </div>
                <div>
                    <img src="https://tailwindui.com/img/ecommerce/icons/icon-chat-light.svg" alt=""
                        class="h-24 w-auto">
                    <h3 class="mt-6 text-sm font-medium text-gray-900">24/7 Customer Support</h3>
                    <p class="mt-2 text-sm text-gray-500">Our AI chat widget is powered by a naive series of if/else
                        statements. Guaranteed to irritate.</p>
                </div>
                <div>
                    <img src="https://tailwindui.com/img/ecommerce/icons/icon-fast-checkout-light.svg" alt=""
                        class="h-24 w-auto">
                    <h3 class="mt-6 text-sm font-medium text-gray-900">Fast Shopping Cart</h3>
                    <p class="mt-2 text-sm text-gray-500">Look how fast that cart is going. What does this mean for the
                        actual experience? I don&#039;t know.</p>
                </div>
                <div>
                    <img src="https://tailwindui.com/img/ecommerce/icons/icon-gift-card-light.svg" alt=""
                        class="h-24 w-auto">
                    <h3 class="mt-6 text-sm font-medium text-gray-900">Gift Cards</h3>
                    <p class="mt-2 text-sm text-gray-500">Buy them for your friends, especially if they don&#039;t like our
                        store. Free money for us, it&#039;s great.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Page main content -->
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-xl font-bold text-gray-900">Customers also bought</h2>

            <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                <div>
                    <div class="relative">
                        <div class="relative h-72 w-full overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-01.jpg"
                                alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls."
                                class="h-full w-full object-cover object-center">
                        </div>
                        <div class="relative mt-4">
                            <h3 class="text-sm font-medium text-gray-900">Zip Tote Basket</h3>
                            <p class="mt-1 text-sm text-gray-500">White and black</p>
                        </div>
                        <div
                            class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                            <div aria-hidden="true"
                                class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                            <p class="relative text-lg font-semibold text-white">$140</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="#"
                            class="relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add
                            to bag<span class="sr-only">, Zip Tote Basket</span></a>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <div class="relative h-72 w-full overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-01.jpg"
                                alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls."
                                class="h-full w-full object-cover object-center">
                        </div>
                        <div class="relative mt-4">
                            <h3 class="text-sm font-medium text-gray-900">Zip Tote Basket</h3>
                            <p class="mt-1 text-sm text-gray-500">White and black</p>
                        </div>
                        <div
                            class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                            <div aria-hidden="true"
                                class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                            <p class="relative text-lg font-semibold text-white">$140</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="#"
                            class="relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add
                            to bag<span class="sr-only">, Zip Tote Basket</span></a>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <div class="relative h-72 w-full overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-01.jpg"
                                alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls."
                                class="h-full w-full object-cover object-center">
                        </div>
                        <div class="relative mt-4">
                            <h3 class="text-sm font-medium text-gray-900">Zip Tote Basket</h3>
                            <p class="mt-1 text-sm text-gray-500">White and black</p>
                        </div>
                        <div
                            class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                            <div aria-hidden="true"
                                class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                            <p class="relative text-lg font-semibold text-white">$140</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="#"
                            class="relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add
                            to bag<span class="sr-only">, Zip Tote Basket</span></a>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <div class="relative h-72 w-full overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-01.jpg"
                                alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls."
                                class="h-full w-full object-cover object-center">
                        </div>
                        <div class="relative mt-4">
                            <h3 class="text-sm font-medium text-gray-900">Zip Tote Basket</h3>
                            <p class="mt-1 text-sm text-gray-500">White and black</p>
                        </div>
                        <div
                            class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                            <div aria-hidden="true"
                                class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                            <p class="relative text-lg font-semibold text-white">$140</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="#"
                            class="relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add
                            to bag<span class="sr-only">, Zip Tote Basket</span></a>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <div class="relative h-72 w-full overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-01.jpg"
                                alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls."
                                class="h-full w-full object-cover object-center">
                        </div>
                        <div class="relative mt-4">
                            <h3 class="text-sm font-medium text-gray-900">Zip Tote Basket</h3>
                            <p class="mt-1 text-sm text-gray-500">White and black</p>
                        </div>
                        <div
                            class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                            <div aria-hidden="true"
                                class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                            <p class="relative text-lg font-semibold text-white">$140</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="#"
                            class="relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add
                            to bag<span class="sr-only">, Zip Tote Basket</span></a>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <div class="relative h-72 w-full overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-01.jpg"
                                alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls."
                                class="h-full w-full object-cover object-center">
                        </div>
                        <div class="relative mt-4">
                            <h3 class="text-sm font-medium text-gray-900">Zip Tote Basket</h3>
                            <p class="mt-1 text-sm text-gray-500">White and black</p>
                        </div>
                        <div
                            class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                            <div aria-hidden="true"
                                class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                            <p class="relative text-lg font-semibold text-white">$140</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="#"
                            class="relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add
                            to bag<span class="sr-only">, Zip Tote Basket</span></a>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <div class="relative h-72 w-full overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-01.jpg"
                                alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls."
                                class="h-full w-full object-cover object-center">
                        </div>
                        <div class="relative mt-4">
                            <h3 class="text-sm font-medium text-gray-900">Zip Tote Basket</h3>
                            <p class="mt-1 text-sm text-gray-500">White and black</p>
                        </div>
                        <div
                            class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                            <div aria-hidden="true"
                                class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                            <p class="relative text-lg font-semibold text-white">$140</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="#"
                            class="relative flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Add
                            to bag<span class="sr-only">, Zip Tote Basket</span></a>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <div class="relative h-72 w-full overflow-hidden rounded-lg">
                            <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-01.jpg"
                                alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls."
                                class="h-full w-full object-cover object-center">
                        </div>
                        <div class="relative mt-4">
                            <h3 class="text-sm font-medium text-gray-900">Zip Tote Basket</h3>
                            <p class="mt-1 text-sm text-gray-500">White and black</p>
                        </div>
                        <div
                            class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                            <div aria-hidden="true"
                                class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                            <p class="relative text-lg font-semibold text-white">$140</p>
                        </div>
                    </div>
                    <x-button type="soft" class="font-extrabold w-full mt-6">Agregar al carrito</x-button>
                </div>
                <!-- More products... -->
            </div>
        </div>
    </div>
@endsection
