@extends('layouts.ecommerce')

@section('head')
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <style>
        .flickity-page-dots {
            bottom: -35px;
        }
    </style>
@endsection

@section('content')
    <!-- Slider (Images size recommended: 1920x800) -->
    <div class="mb-16 shadow-md" style="height: 420px" 
    data-flickity='{ "wrapAround": true, "prevNextButtons": false, "autoPlay": 5000 }'>
        <div class="w-full h-full">
            <img class="w-full h-full object-cover"
                src="https://http2.mlstatic.com/D_NQ_609473-MLA75157155755_032024-OO.webp">
        </div>
        <div class="w-full h-full">
            <img class="w-full h-full object-cover"
                src="https://http2.mlstatic.com/D_NQ_846284-MLA75236489991_032024-OO.webp">
        </div>
        <div class="w-full h-full">
            <img class="w-full h-full object-cover"
                src="https://img.freepik.com/vector-gratis/plantilla-banner-venta-plano-horizontal-foto_23-2149000923.jpg?w=740&t=st=1713967568~exp=1713968168~hmac=daa49d6bef4f74952dec05b39880a840effd5824cd3f8fe5559dc95c466cf00e">
        </div>
        <div class="w-full h-full">
            <img class="w-full h-full object-cover"
                src="https://www.munishop.com.ar/webfiles/marketplace/slider/66/1_1920x800.jpg">
        </div>
        <div class="w-full h-full">
            <img class="w-full h-full object-cover"
                src="https://http2.mlstatic.com/D_NQ_938619-MLA75215011957_032024-OO.webp">
        </div>
    </div>

    <!-- Categories overview -->
    <div class="bg-gray-50">
        <div class="mx-auto max-w-7xl px-4 pb-16 lg:px-8">
            <div class="sm:flex sm:items-baseline sm:justify-between">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Shop by Category</h2>
                <a href="#" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
                    Browse all categories
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:grid-rows-2 sm:gap-x-6 lg:gap-8">
                <div
                    class="group aspect-h-1 aspect-w-2 overflow-hidden rounded-lg sm:aspect-h-1 sm:aspect-w-1 sm:row-span-2">
                    <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-featured-category.jpg"
                        alt="Two models wearing women's black cotton crewneck tee and off-white cotton crewneck tee."
                        class="object-cover object-center group-hover:opacity-75">
                    <div aria-hidden="true" class="bg-gradient-to-b from-transparent to-black opacity-50"></div>
                    <div class="flex items-end p-6">
                        <div>
                            <h3 class="font-semibold text-white">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    New Arrivals
                                </a>
                            </h3>
                            <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
                        </div>
                    </div>
                </div>
                <div class="group aspect-h-1 aspect-w-2 overflow-hidden rounded-lg sm:aspect-none sm:relative sm:h-full">
                    <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-category-01.jpg"
                        alt="Wooden shelf with gray and olive drab green baseball caps, next to wooden clothes hanger with sweaters."
                        class="object-cover object-center group-hover:opacity-75 sm:absolute sm:inset-0 sm:h-full sm:w-full">
                    <div aria-hidden="true"
                        class="bg-gradient-to-b from-transparent to-black opacity-50 sm:absolute sm:inset-0"></div>
                    <div class="flex items-end p-6 sm:absolute sm:inset-0">
                        <div>
                            <h3 class="font-semibold text-white">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    Accessories
                                </a>
                            </h3>
                            <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
                        </div>
                    </div>
                </div>
                <div class="group aspect-h-1 aspect-w-2 overflow-hidden rounded-lg sm:aspect-none sm:relative sm:h-full">
                    <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-category-02.jpg"
                        alt="Walnut desk organizer set with white modular trays, next to porcelain mug on wooden desk."
                        class="object-cover object-center group-hover:opacity-75 sm:absolute sm:inset-0 sm:h-full sm:w-full">
                    <div aria-hidden="true"
                        class="bg-gradient-to-b from-transparent to-black opacity-50 sm:absolute sm:inset-0"></div>
                    <div class="flex items-end p-6 sm:absolute sm:inset-0">
                        <div>
                            <h3 class="font-semibold text-white">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    Workspace
                                </a>
                            </h3>
                            <p aria-hidden="true" class="mt-1 text-sm text-white">Shop now</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 sm:hidden">
                <a href="#" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                    Browse all categories
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 pb-16 lg:px-8 flex flex-wrap items-center justify-center">
        <article
            class="relative m-3 isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
            <img src="https://images.unsplash.com/photo-1547586696-ea22b4d4235d?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=3270&amp;q=80"
                alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
            <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
            <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>

            <div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm leading-6 text-gray-300">
                <time datetime="2020-03-10" class="mr-8">Mar 10, 2020</time>
                <div class="-ml-4 flex items-center gap-x-4">
                    <svg viewBox="0 0 2 2" class="-ml-0.5 h-0.5 w-0.5 flex-none fill-white/50">
                        <circle cx="1" cy="1" r="1"></circle>
                    </svg>
                    <div class="flex gap-x-2.5">
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                            alt="" class="h-6 w-6 flex-none rounded-full bg-white/10">
                        Lindsay Walton
                    </div>
                </div>
            </div>
            <h3 class="mt-3 text-lg font-semibold leading-6 text-white">
                <a href="#">
                    <span class="absolute inset-0"></span>
                    Libero quisquam voluptatibus nam iusto qui dolor
                </a>
            </h3>
        </article>
        <article
            class="relative m-3 isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
            <img src="https://images.unsplash.com/photo-1547586696-ea22b4d4235d?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=3270&amp;q=80"
                alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
            <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
            <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>

            <div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm leading-6 text-gray-300">
                <time datetime="2020-03-10" class="mr-8">Mar 10, 2020</time>
                <div class="-ml-4 flex items-center gap-x-4">
                    <svg viewBox="0 0 2 2" class="-ml-0.5 h-0.5 w-0.5 flex-none fill-white/50">
                        <circle cx="1" cy="1" r="1"></circle>
                    </svg>
                    <div class="flex gap-x-2.5">
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                            alt="" class="h-6 w-6 flex-none rounded-full bg-white/10">
                        Lindsay Walton
                    </div>
                </div>
            </div>
            <h3 class="mt-3 text-lg font-semibold leading-6 text-white">
                <a href="#">
                    <span class="absolute inset-0"></span>
                    Libero quisquam voluptatibus nam iusto qui dolor
                </a>
            </h3>
        </article>
        <article
            class="relative m-3 isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
            <img src="https://images.unsplash.com/photo-1547586696-ea22b4d4235d?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=3270&amp;q=80"
                alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
            <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
            <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>

            <div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm leading-6 text-gray-300">
                <time datetime="2020-03-10" class="mr-8">Mar 10, 2020</time>
                <div class="-ml-4 flex items-center gap-x-4">
                    <svg viewBox="0 0 2 2" class="-ml-0.5 h-0.5 w-0.5 flex-none fill-white/50">
                        <circle cx="1" cy="1" r="1"></circle>
                    </svg>
                    <div class="flex gap-x-2.5">
                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                            alt="" class="h-6 w-6 flex-none rounded-full bg-white/10">
                        Lindsay Walton
                    </div>
                </div>
            </div>
            <h3 class="mt-3 text-lg font-semibold leading-6 text-white">
                <a href="#">
                    <span class="absolute inset-0"></span>
                    Libero quisquam voluptatibus nam iusto qui dolor
                </a>
            </h3>
        </article>
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
                    <x-button type="soft" class="font-extrabold w-full mt-6">Agregar al carrito</x-button>
                </div>
                <!-- More products... -->
            </div>
        </div>
    </div>

    <!-- Advicements/Features -->
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
                            <img class="mx-auto h-24 w-28"
                                src="https://tailwindui.com/img/ecommerce/icons/icon-delivery-light.svg" alt="">
                        </div>
                    </div>
                    <div class="mt-3 sm:ml-3 sm:mt-0 lg:ml-0 lg:mt-3">
                        <h3 class="text-sm font-medium text-gray-900">Free Shipping</h3>
                        <p class="mt-2 text-sm text-gray-500">It&#039;s not actually free we just price it into the
                            products. Someone&#039;s paying for it, and it&#039;s not us.</p>
                    </div>
                </div>
                <div class="text-center sm:flex sm:text-left lg:block lg:text-center">
                    <div class="sm:flex-shrink-0">
                        <div class="flow-root">
                            <img class="mx-auto h-24 w-28"
                                src="https://tailwindui.com/img/ecommerce/icons/icon-chat-light.svg" alt="">
                        </div>
                    </div>
                    <div class="mt-3 sm:ml-3 sm:mt-0 lg:ml-0 lg:mt-3">
                        <h3 class="text-sm font-medium text-gray-900">24/7 Customer Support</h3>
                        <p class="mt-2 text-sm text-gray-500">Our AI chat widget is powered by a naive series of if/else
                            statements. Guaranteed to irritate.</p>
                    </div>
                </div>
                <div class="text-center sm:flex sm:text-left lg:block lg:text-center">
                    <div class="sm:flex-shrink-0">
                        <div class="flow-root">
                            <img class="mx-auto h-24 w-28"
                                src="https://tailwindui.com/img/ecommerce/icons/icon-fast-checkout-light.svg"
                                alt="">
                        </div>
                    </div>
                    <div class="mt-3 sm:ml-3 sm:mt-0 lg:ml-0 lg:mt-3">
                        <h3 class="text-sm font-medium text-gray-900">Fast Shopping Cart</h3>
                        <p class="mt-2 text-sm text-gray-500">Look how fast that cart is going. What does this mean for the
                            actual experience? I don&#039;t know.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-y-12 pb-16 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 lg:gap-x-8 lg:gap-y-0">

            <div class="text-center md:flex md:items-start md:text-left lg:block lg:text-center">
                <div class="md:flex-shrink-0">
                    <div class="flow-root">
                        <img class="-my-1 mx-auto h-24 w-auto"
                            src="https://tailwindui.com/img/ecommerce/icons/icon-returns-light.svg" alt="">
                    </div>
                </div>
                <div class="mt-6 md:ml-4 md:mt-0 lg:ml-0 lg:mt-6">
                    <h3 class="text-base font-medium text-gray-900">Free returns</h3>
                    <p class="mt-3 text-sm text-gray-500">Not what you expected? Place it back in the parcel and attach the
                        pre-paid postage stamp.</p>
                </div>
            </div>

            <div class="text-center md:flex md:items-start md:text-left lg:block lg:text-center">
                <div class="md:flex-shrink-0">
                    <div class="flow-root">
                        <img class="-my-1 mx-auto h-24 w-auto"
                            src="https://tailwindui.com/img/ecommerce/icons/icon-calendar-light.svg" alt="">
                    </div>
                </div>
                <div class="mt-6 md:ml-4 md:mt-0 lg:ml-0 lg:mt-6">
                    <h3 class="text-base font-medium text-gray-900">Same day delivery</h3>
                    <p class="mt-3 text-sm text-gray-500">We offer a delivery service that has never been done before.
                        Checkout today and receive your products within hours.</p>
                </div>
            </div>

            <div class="text-center md:flex md:items-start md:text-left lg:block lg:text-center">
                <div class="md:flex-shrink-0">
                    <div class="flow-root">
                        <img class="-my-1 mx-auto h-24 w-auto"
                            src="https://tailwindui.com/img/ecommerce/icons/icon-gift-card-light.svg" alt="">
                    </div>
                </div>
                <div class="mt-6 md:ml-4 md:mt-0 lg:ml-0 lg:mt-6">
                    <h3 class="text-base font-medium text-gray-900">All year discount</h3>
                    <p class="mt-3 text-sm text-gray-500">Looking for a deal? You can use the code "ALLYEAR" at checkout
                        and get money off all year round.</p>
                </div>
            </div>

            <div class="text-center md:flex md:items-start md:text-left lg:block lg:text-center">
                <div class="md:flex-shrink-0">
                    <div class="flow-root">
                        <img class="-my-1 mx-auto h-24 w-auto"
                            src="https://tailwindui.com/img/ecommerce/icons/icon-planet-light.svg" alt="">
                    </div>
                </div>
                <div class="mt-6 md:ml-4 md:mt-0 lg:ml-0 lg:mt-6">
                    <h3 class="text-base font-medium text-gray-900">For the planet</h3>
                    <p class="mt-3 text-sm text-gray-500">We’ve pledged 1% of sales to the preservation and restoration of
                        the natural environment.</p>
                </div>
            </div>

        </div>
    </div>
@endsection
