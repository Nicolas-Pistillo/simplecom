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
    {{-- Slider (Images size recommended: 1920x800) --}}
    @include('ecommerce.partials.slider')

    {{-- Categories presentation --}}
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <div class="sm:flex sm:items-baseline sm:justify-between">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Shop by Category</h2>
            <a href="#" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">
                Browse all categories
                <span aria-hidden="true"> &rarr;</span>
            </a>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:grid-rows-2 sm:gap-x-6 lg:gap-8">
            <div class="group aspect-h-1 aspect-w-2 overflow-hidden rounded-lg sm:aspect-h-1 sm:aspect-w-1 sm:row-span-2">
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

    {{-- Featured products section --}}
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-8">Featured Products</h2>
        <div class="flex items-center justify-center flex-wrap gap-8">

            @for ($i = 0; $i < 2; $i++)
                <x-product-card image="https://picsum.photos/200/300" />
            @endfor

        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <div class="flex items-center justify-center w-full h-full py-24 sm:py-8 px-4">
            <div class="w-full relative flex items-center justify-center">
                <button aria-label="slide backward"
                    class="mr-6 left-0 ml-10 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 cursor-pointer"
                    id="prev">
                    <svg class="dark:text-gray-900" width="8" height="14" viewBox="0 0 8 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <div class="w-full h-full mx-auto overflow-x-hidden p-4">
                    <div id="slider"
                        class="h-full grid grid-flow-col lg:gap-8 md:gap-6 gap-14 items-center transition ease-out duration-700">
                        @foreach ([1, 2, 3, 4, 5, 6, 7, 8] as $item)
                            <x-product-card />
                        @endforeach
                    </div>
                </div>
                <button aria-label="slide forward"
                    class="ml-6 right-0 mr-10 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
                    id="next">
                    <svg class="dark:text-gray-900" width="8" height="14" viewBox="0 0 8 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        let defaultTransform = 0;

        function goNext() {
            defaultTransform = defaultTransform - 398;
            var slider = document.getElementById("slider");
            if (Math.abs(defaultTransform) >= slider.scrollWidth / 1.7) defaultTransform = 0;
            slider.style.transform = "translateX(" + defaultTransform + "px)";
        }
        next.addEventListener("click", goNext);

        function goPrev() {
            var slider = document.getElementById("slider");
            if (Math.abs(defaultTransform) === 0) defaultTransform = 0;
            else defaultTransform = defaultTransform + 398;
            slider.style.transform = "translateX(" + defaultTransform + "px)";
        }
        prev.addEventListener("click", goPrev);
    </script>

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
