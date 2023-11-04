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
      <div class="mx-auto max-w-7xl sm:px-2 py-16 lg:px-4">
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10 px-4 lg:max-w-none lg:grid-cols-3">
          <div class="text-center sm:flex sm:text-left lg:block lg:text-center">
            <div class="sm:flex-shrink-0">
              <div class="flow-root">
                <img class="mx-auto h-24 w-28" src="https://tailwindui.com/img/ecommerce/icons/icon-delivery-light.svg" alt="">
              </div>
            </div>
            <div class="mt-3 sm:ml-3 sm:mt-0 lg:ml-0 lg:mt-3">
              <h3 class="text-sm font-medium text-gray-900">Free Shipping</h3>
              <p class="mt-2 text-sm text-gray-500">It&#039;s not actually free we just price it into the products. Someone&#039;s paying for it, and it&#039;s not us.</p>
            </div>
          </div>
          <div class="text-center sm:flex sm:text-left lg:block lg:text-center">
            <div class="sm:flex-shrink-0">
              <div class="flow-root">
                <img class="mx-auto h-24 w-28" src="https://tailwindui.com/img/ecommerce/icons/icon-chat-light.svg" alt="">
              </div>
            </div>
            <div class="mt-3 sm:ml-3 sm:mt-0 lg:ml-0 lg:mt-3">
              <h3 class="text-sm font-medium text-gray-900">24/7 Customer Support</h3>
              <p class="mt-2 text-sm text-gray-500">Our AI chat widget is powered by a naive series of if/else statements. Guaranteed to irritate.</p>
            </div>
          </div>
          <div class="text-center sm:flex sm:text-left lg:block lg:text-center">
            <div class="sm:flex-shrink-0">
              <div class="flow-root">
                <img class="mx-auto h-24 w-28" src="https://tailwindui.com/img/ecommerce/icons/icon-fast-checkout-light.svg" alt="">
              </div>
            </div>
            <div class="mt-3 sm:ml-3 sm:mt-0 lg:ml-0 lg:mt-3">
              <h3 class="text-sm font-medium text-gray-900">Fast Shopping Cart</h3>
              <p class="mt-2 text-sm text-gray-500">Look how fast that cart is going. What does this mean for the actual experience? I don&#039;t know.</p>
            </div>
          </div>
        </div>
      </div>
    </div> 

    <div class="relative bg-white">
        <!-- Background image and overlap -->
        <div aria-hidden="true" class="absolute inset-0 hidden sm:flex sm:flex-col">
            <div class="relative w-full flex-1 bg-gray-800">
                <div class="absolute inset-0 overflow-hidden">
                    <img src="https://tailwindui.com/img/ecommerce-images/home-page-04-hero-full-width.jpg" alt=""
                        class="h-full w-full object-cover object-center">
                </div>
                <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
            </div>
            <div class="h-32 w-full bg-white md:h-40 lg:h-48"></div>
        </div>

        <div class="relative mx-auto max-w-3xl px-4 pb-96 text-center sm:px-6 sm:pb-0 lg:px-8">
            <!-- Background image and overlap -->
            <div aria-hidden="true" class="absolute inset-0 flex flex-col sm:hidden">
                <div class="relative w-full flex-1 bg-gray-800">
                    <div class="absolute inset-0 overflow-hidden">
                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-04-hero-full-width.jpg"
                            alt="" class="h-full w-full object-cover object-center">
                    </div>
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                </div>
                <div class="h-48 w-full bg-white"></div>
            </div>
            <div class="relative py-32">
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl md:text-6xl">Mid-Season Sale</h1>
                <div class="mt-4 sm:mt-6">
                    <a href="#"
                        class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3 font-medium text-white hover:bg-indigo-700">Shop
                        Collection</a>
                </div>
            </div>
        </div>

        <section aria-labelledby="collection-heading" class="relative -mt-96 sm:mt-0">
            <h2 id="collection-heading" class="sr-only">Collections</h2>
            <div
                class="mx-auto grid max-w-md grid-cols-1 gap-y-6 px-4 sm:max-w-7xl sm:grid-cols-3 sm:gap-x-6 sm:gap-y-0 sm:px-6 lg:gap-x-8 lg:px-8">
                <div class="group relative h-96 rounded-lg bg-white shadow-xl sm:aspect-h-5 sm:aspect-w-4 sm:h-auto">
                    <div>
                        <div aria-hidden="true" class="absolute inset-0 overflow-hidden rounded-lg">
                            <div class="absolute inset-0 overflow-hidden group-hover:opacity-75">
                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-04-collection-01.jpg"
                                    alt="Woman wearing an off-white cotton t-shirt."
                                    class="h-full w-full object-cover object-center">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 flex items-end rounded-lg p-6">
                            <div>
                                <p aria-hidden="true" class="text-sm text-white">Shop the collection</p>
                                <h3 class="mt-1 font-semibold text-white">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        Women&#039;s
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group relative h-96 rounded-lg bg-white shadow-xl sm:aspect-h-5 sm:aspect-w-4 sm:h-auto">
                    <div>
                        <div aria-hidden="true" class="absolute inset-0 overflow-hidden rounded-lg">
                            <div class="absolute inset-0 overflow-hidden group-hover:opacity-75">
                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-04-collection-02.jpg"
                                    alt="Man wearing a charcoal gray cotton t-shirt."
                                    class="h-full w-full object-cover object-center">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 flex items-end rounded-lg p-6">
                            <div>
                                <p aria-hidden="true" class="text-sm text-white">Shop the collection</p>
                                <h3 class="mt-1 font-semibold text-white">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        Men&#039;s
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group relative h-96 rounded-lg bg-white shadow-xl sm:aspect-h-5 sm:aspect-w-4 sm:h-auto">
                    <div>
                        <div aria-hidden="true" class="absolute inset-0 overflow-hidden rounded-lg">
                            <div class="absolute inset-0 overflow-hidden group-hover:opacity-75">
                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-04-collection-03.jpg"
                                    alt="Person sitting at a wooden desk with paper note organizer, pencil and tablet."
                                    class="h-full w-full object-cover object-center">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 flex items-end rounded-lg p-6">
                            <div>
                                <p aria-hidden="true" class="text-sm text-white">Shop the collection</p>
                                <h3 class="mt-1 font-semibold text-white">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        Desk Accessories
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

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
