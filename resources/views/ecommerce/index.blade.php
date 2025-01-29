@extends('layouts.ecommerce')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection

@section('content')
    {{-- Main Slider --}}
    @if ($banners->isNotEmpty())
        @include('ecommerce.partials.banner-slider')
    @endif

    {{-- Categories overview - model 1 --}}
    {{-- <section class="mx-auto max-w-7xl py-16 lg:px-4">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">

                <h4 class="text-2xl font-bold tracking-tight text-gray-900">
                    Shop by category
                </h4>

                <a href="#" title=""
                    class="flex items-center text-base font-medium text-primary-700 hover:underline dark:text-primary-500">
                    See more categories
                    <svg class="ms-1 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                </a>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                @for ($i = 0; $i < 15; $i++)
                    <a href="#" class="flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50">
                        <x-icon code="category" class="text-sm shrink-0 text-gray-900" />
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Collectibles &amp; Toys</span>
                    </a>
                @endfor
            </div>
        </div>
    </section> --}}

    {{-- Categories overview - model 2 --}}
    

    {{-- Categories presentation --}}
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8 mb-14">
            <div class="flex flex-col lg:flex-row items-center justify-between w-full  max-lg:gap-6 mb-14">
                <h1 class="font-manrope max-lg:text-center font-medium text-4xl sm:text-5xl sm:leading-snug text-black">
                    Sophistication Finds Its Pinnacle <br> in Simplicity.
                </h1>
                <div class="flex items-center justify-end lg:justify-end gap-5">
                    <button type="button"
                        class="py-3.5 pl-8 pr-6 text-lg max-h-max bg-gray-900 text-white rounded-full cursor-pointer font-semibold text-center flex items-center gap-2 shadow-xs transition-all duration-500 hover:bg-gray-700">
                        Shop Now
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                            fill="none">
                            <path d="M8.25324 5.49609L13.7535 10.9963L8.25 16.4998" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg></button>

                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-md mx-auto md:max-w-3xl lg:max-w-full">
                <div class="flex flex-col gap-8">
                    <div class="rounded-2xl p-8 bg-emerald-100 ">
                        <h6 class="text-xl font-semibold leading-8 text-gray-900 mb-2.5">
                            Elevate your holiday joy with a festive 20% discount using code xzTnm
                        </h6>
                        <button type="button"
                            class="ml-auto flex w-max py-2 border border-gray-500 px-6 text-sm max-h-max bg-emerald-100 text-gray-900 rounded-full cursor-pointer font-medium text-center shadow-xs transition-all duration-500 hover:bg-black hover:text-white">
                            Special Offer
                        </button>
                    </div>
                    <a href="javascript:;" class="rounded-2xl relative group overflow-hidden cursor-pointer">
                        <img src="https://pagedone.io/asset/uploads/1710392347.png" alt="men with t-shirt"
                            class="relative w-full h-full transition-all duration-1000 group-hover:scale-110 group-hover:rotate-3 rounded-2xl object-cover">
                        <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end">
                            <div class="block">
                                <h4 class="font-medium text-4xl leading-snug text-white mb-1.5">
                                    Man’s Shirt
                                </h4>
                                <p class="text-lg font-normal text-white">
                                    Elevate your look with our stylish men's shirts, perfect for any occasion
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div
                    class="grid grid-cols-1 md:col-span-2 lg:col-span-1 md:grid-cols-2 lg:grid-cols-1 gap-8 md:order-last lg:order-none">
                    <a href="javascript:;" class="rounded-2xl relative group overflow-hidden">
                        <img src="https://pagedone.io/asset/uploads/1710392359.png" alt="men with t-shirt"
                            class="relative w-full h-full transition-all duration-1000 group-hover:scale-110 group-hover:rotate-3  rounded-2xl object-cover">
                        <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end">
                            <div class="block">
                                <h4 class="font-medium text-4xl leading-snug text-white ">
                                    Men <br>
                                    Collection
                                </h4>

                            </div>
                        </div>
                    </a>
                    <a href="javascript:;" class="rounded-2xl relative group overflow-hidden">
                        <img src="https://pagedone.io/asset/uploads/1710392370.png" alt="men with t-shirt"
                            class="relative w-full h-full transition-all duration-1000 group-hover:scale-110 group-hover:rotate-3 rounded-2xl object-cover">
                        <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end">
                            <div class="block">
                                <h4 class="font-manrope font-medium text-4xl leading-snug text-white ">
                                    Women <br>
                                    Collection
                                </h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="rounded-2xl relative overflow-hidden group">
                    <img src="https://pagedone.io/asset/uploads/1710392382.png" alt="men with t-shirt"
                        class="relative w-full h-full transition-all duration-1000 group-hover:scale-110 group-hover:rotate-3 rounded-2xl object-cover">
                    <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end">
                        <div class="block">
                            <h4 class="font-manrope font-medium text-4xl leading-snug text-white mb-2">
                                Girl’s Top
                            </h4>
                            <p class="text-lg font-normal text-white leading-relaxed mb-2">
                                Everyday allure, wrapped in mystery
                            </p>
                            <button type="button"
                                class="w-max py-2 bg-white hover:bg-gray-100 px-5 text-black text-sm leading-6 font-medium max-h-max rounded-full cursor-pointer font-medium text-center shadow-xs transition-all duration-500">
                                Shop Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Featured products section --}}
    @if ($featuredProducts->isNotEmpty())
        @include('ecommerce.partials.featured-section')
    @endif

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
                        <img src="https://picsum.photos/1200/600" alt=""
                            class="object-cover object-center shadow-md">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50">
        <h2 class="sr-only">Our perks</h2>
        <div class="mx-auto max-w-7xl py-24 sm:px-2 sm:py-32 lg:px-4">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 px-4 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                <div class="sm:flex">
                    <div class="sm:flex-shrink-0">
                        <div class="flow-root">
                            <img class="h-24 w-28"
                                src="https://tailwindui.com/img/ecommerce/icons/icon-delivery-light.svg" alt="">
                        </div>
                    </div>
                    <div class="mt-3 sm:ml-3 sm:mt-0">
                        <h3 class="text-sm font-medium text-gray-900">Free delivery</h3>
                        <p class="mt-2 text-sm text-gray-500">Order now and you&#039;ll get delivery absolutely free. Well,
                            it&#039;s not actually free, we just price it into the products. Someone&#039;s paying for it,
                            and it&#039;s not us.</p>
                    </div>
                </div>
                <div class="sm:flex">
                    <div class="sm:flex-shrink-0">
                        <div class="flow-root">
                            <img class="h-24 w-28"
                                src="https://tailwindui.com/img/ecommerce/icons/icon-warranty-light.svg" alt="">
                        </div>
                    </div>
                    <div class="mt-3 sm:ml-3 sm:mt-0">
                        <h3 class="text-sm font-medium text-gray-900">10-year warranty</h3>
                        <p class="mt-2 text-sm text-gray-500">We have a 10 year warranty with every product that you
                            purchase, whether thats a new pen or organizer, you can be sure we&#039;ll stand behind it.</p>
                    </div>
                </div>
                <div class="sm:flex">
                    <div class="sm:flex-shrink-0">
                        <div class="flow-root">
                            <img class="h-24 w-28" src="https://tailwindui.com/img/ecommerce/icons/icon-returns-light.svg"
                                alt="">
                        </div>
                    </div>
                    <div class="mt-3 sm:ml-3 sm:mt-0">
                        <h3 class="text-sm font-medium text-gray-900">Exchanges</h3>
                        <p class="mt-2 text-sm text-gray-500">We understand that when your product arrives you might not
                            particularly like it, or you ordered the wrong thing. Conditions apply here.</p>
                    </div>
                </div>
                <div class="sm:flex">
                    <div class="sm:flex-shrink-0">
                        <div class="flow-root">
                            <img class="h-24 w-28" src="https://tailwindui.com/img/ecommerce/icons/icon-planet-light.svg"
                                alt="">
                        </div>
                    </div>
                    <div class="mt-3 sm:ml-3 sm:mt-0">
                        <h3 class="text-sm font-medium text-gray-900">For the planet</h3>
                        <p class="mt-2 text-sm text-gray-500">Like you, we love the planet, and so we&#039;ve pledged 1% of
                            all sales to the preservation and restoration of the natural environment.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($banners->isEmpty())
        <div class="bg-white">
            <h2 class="sr-only">Our perks</h2>
            <div
                class="mx-auto max-w-7xl divide-y divide-gray-200 lg:flex lg:justify-center lg:divide-x lg:divide-y-0 lg:py-8">
                <div class="py-8 lg:w-1/3 lg:flex-none lg:py-0">
                    <div class="mx-auto flex max-w-xs items-center px-4 lg:max-w-none lg:px-8">
                        <x-icon code="calendar_today" class="text-{{ tenant('color') }}-600 text-3xl" />
                        <div class="ml-4 flex flex-auto flex-col-reverse">
                            <h3 class="font-medium text-gray-900">10-year all-inclusive warranty</h3>
                            <p class="text-sm text-gray-500">We’ll replace it with a new one</p>
                        </div>
                    </div>
                </div>
                <div class="py-8 lg:w-1/3 lg:flex-none lg:py-0">
                    <div class="mx-auto flex max-w-xs items-center px-4 lg:max-w-none lg:px-8">
                        <x-icon code="sync" class="text-{{ tenant('color') }}-600 text-3xl" />
                        <div class="ml-4 flex flex-auto flex-col-reverse">
                            <h3 class="font-medium text-gray-900">Free shipping on returns</h3>
                            <p class="text-sm text-gray-500">Send it back for free</p>
                        </div>
                    </div>
                </div>
                <div class="py-8 lg:w-1/3 lg:flex-none lg:py-0">
                    <div class="mx-auto flex max-w-xs items-center px-4 lg:max-w-none lg:px-8">
                        <x-icon code="local_shipping" class="text-{{ tenant('color') }}-600 text-3xl" />
                        <div class="ml-4 flex flex-auto flex-col-reverse">
                            <h3 class="font-medium text-gray-900">Free, contactless delivery</h3>
                            <p class="text-sm text-gray-500">The shipping is on us</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
