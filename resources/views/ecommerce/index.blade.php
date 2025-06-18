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

    {{-- Promotional Message --}}
    @config('promotional_message')
        <div class="w-full bg-black text-white overflow-hidden">
            <div class="text-center py-1 sm:py-2">
                <div class="w-full animate-infinite-scroll inline-flex flex-nowrap 
                items-center justify-center gap-x-6">
                    @for ($i = 0; $i < 15; $i++)
                        <h4 class="whitespace-nowrap text-xs sm:text-base">{{ $value }}</h4>
                    @endfor
                </div>
            </div>
        </div>
    @endconfig

    {{-- Principal Categories --}}
    @include('ecommerce.partials.principal-categories-section')

    {{-- New arrivals presentation --}}
    @include('ecommerce.partials.collections-section')

    {{-- Featured products section --}}
    @if ($featuredProducts->isNotEmpty())
        @include('ecommerce.partials.featured-products-section')
    @endif

    <!-- Advicements/Features -->
    <!-- <div class="bg-gray-50">
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
    </div> -->

    <!-- <div class="bg-gray-50">
        <h2 class="sr-only">Our perks</h2>
        <div class="mx-auto max-w-7xl py-24 sm:px-2 sm:py-32 lg:px-4">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 px-4 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                <div class="sm:flex">
                    <div class="sm:flex-shrink-0">
                        <div class="flow-root">
                            <img class="h-24 w-28" src="https://tailwindui.com/plus/img/ecommerce/icons/icon-delivery-light.svg"
                                alt="">
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
                            <img class="h-24 w-28" src="https://tailwindui.com/plus/img/ecommerce/icons/icon-warranty-light.svg"
                                alt="">
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
                            <img class="h-24 w-28" src="https://tailwindui.com/plus/img/ecommerce/icons/icon-returns-light.svg"
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
                            <img class="h-24 w-28" src="https://tailwindui.com/plus/img/ecommerce/icons/icon-planet-light.svg"
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
    </div> -->

    <!-- @if ($banners->isEmpty())
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
    @endif -->
@endsection
