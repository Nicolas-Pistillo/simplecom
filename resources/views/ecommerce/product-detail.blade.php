@extends('layouts.ecommerce')

@section('content')
    <section x-data class="py-14 relative ">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">

                {{-- Product images block --}}
                <div class="w-full flex md:block flex-col justify-center order-last 
                max-lg:max-w-[608px] max-lg:mx-auto">
                    <div class="w-full mx-auto relative mb-6">
                        <img src="{{ $product->first_image }}" alt="product-image"
                            class="w-[500px] h-[450px] rounded-lg shadow object-cover">
                    </div>
                    <div class="flex items-center gap-3 flex-wrap">
                        <div class="bg-gray-200 w-20 h-20"></div>
                        <div class="bg-gray-200 w-20 h-20"></div>
                        <div class="bg-gray-200 w-20 h-20"></div>
                    </div>
                </div>

                {{-- Product info block --}}
                <div class="pro-detail w-full flex flex-col justify-center order-last max-lg:max-w-[608px] max-lg:mx-auto">

                    {{-- Category & Brand --}}
                    <div class="flex items-center mb-4">
                        <p class="font-medium text-{{ tenant('color') }}-600"> {{ $product->category->name }} </p>
                        @if ($product->brand)
                            <span
                                class="ml-3 inline-flex items-center bg-white pl-1 pr-3 shadow rounded-full
                            transition duration-300 hover:shadow-lg cursor-pointer"
                                x-tooltip.raw.placement.right="Ver más productos de esta marca">
                                <img src="{{ $product->brand->image_url }}" class="w-8 h-8 rounded-full" alt="brand-logo">
                                <small class="ml-1 text-gray-700 font-semibold">{{ $product->brand->name }}</small>
                            </span>
                        @endif
                    </div>

                    {{-- Product name --}}
                    <h2 class="mb-2 font-manrope font-bold text-3xl leading-10 text-gray-900">
                        {{ $product->name }}
                    </h2>

                    {{-- Price & Reviews --}}
                    <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                        <h6
                            class="font-manrope font-semibold text-2xl leading-9 text-gray-900 pr-5 
                        sm:border-r border-gray-200 mr-5">
                            @if ($product->hasDiscount())
                                <div class="flex items-center">
                                    <del class="block text-xs text-gray-500">${{ priceFormat($product->price) }}</del>
                                    <span class="text-green-500 text-xs ml-1.5">%{{ $product->discount_percent }} OFF</span>
                                </div>
                                ${{ priceFormat($product->calculateDiscount()) }}
                            @else
                                ${{ priceFormat($product->price) }}
                            @endif
                        </h6>
                        <div class="flex items-center gap-2">
                            <div class="flex items-center gap-1">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_12029_1640)">
                                        <path
                                            d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_12029_1640">
                                            <rect width="20" height="20" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_12029_1640)">
                                        <path
                                            d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_12029_1640">
                                            <rect width="20" height="20" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_12029_1640)">
                                        <path
                                            d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_12029_1640">
                                            <rect width="20" height="20" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_12029_1640)">
                                        <path
                                            d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                            fill="#FBBF24" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_12029_1640">
                                            <rect width="20" height="20" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_8480_66029)">
                                        <path
                                            d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                            fill="#F3F4F6" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_8480_66029">
                                            <rect width="20" height="20" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </div>
                            <span class="pl-2 font-normal leading-7 text-gray-500 text-sm ">1624 review</span>
                        </div>
                    </div>

                    {{-- Description --}}
                    <p class="text-gray-500 text-base font-normal mb-8 ">
                        {{ $product->description ?? 'Sin descripción' }}
                    </p>

                    {{-- Variants --}}
                    <div class="block w-full">
                        <p class="font-medium text-lg leading-8 text-gray-900 mb-4">Bag Color</p>
                        <div class="text">

                            <div class="flex items-center justify-start gap-3 md:gap-6 relative mb-6 ">
                                <button data-ui="checked active"
                                    class="p-2.5 border border-gray-200 rounded-full transition-all duration-300 hover:border-emerald-500 :border-emerald-500">
                                    <svg width="20" height="20" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="20" cy="20" r="20" fill="#10B981" />
                                    </svg>
                                </button>
                                <button
                                    class="p-2.5 border border-gray-200 rounded-full transition-all duration-300 hover:border-amber-400 focus-within:border-amber-400">
                                    <svg width="20" height="20" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="20" cy="20" r="20" fill="#FBBF24" />
                                    </svg>

                                </button>
                                <button
                                    class="p-2.5 border border-gray-200 rounded-full transition-all duration-300 hover:border-red-500 focus-within:border-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 40 40" fill="none">
                                        <circle cx="20" cy="20" r="20" fill="#F43F5E" />
                                    </svg>
                                </button>
                                <button
                                    class="p-2.5 border border-gray-200 rounded-full  transition-all duration-300 hover:border-blue-400 focus-within:border-blue-400">
                                    <svg width="20" height="20" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="20" cy="20" r="20" fill="#2563EB" />
                                    </svg>
                                </button>

                            </div>

                            {{-- Tailwind UI sizes block --}}
                            <div class="my-8">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-sm font-medium text-gray-900">Size</h2>
                                    <a href="#"
                                        class="text-sm font-medium text-indigo-600 hover:text-indigo-500">See sizing
                                        chart</a>
                                </div>

                                <fieldset class="mt-2">
                                    <legend class="sr-only">Choose a size</legend>
                                    <div class="grid grid-cols-3 gap-3 sm:grid-cols-6">
                                        <!--
                                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                                        -->
                                        <label
                                            class="flex items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                                            <input type="radio" name="size-choice" value="XXS" class="sr-only"
                                                aria-labelledby="size-choice-0-label">
                                            <span id="size-choice-0-label">XXS</span>
                                        </label>
                                        <!--
                                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                                        -->
                                        <label
                                            class="flex items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                                            <input type="radio" name="size-choice" value="XS" class="sr-only"
                                                aria-labelledby="size-choice-1-label">
                                            <span id="size-choice-1-label">XS</span>
                                        </label>
                                        <!--
                                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                                        -->
                                        <label
                                            class="flex items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                                            <input type="radio" name="size-choice" value="S" class="sr-only"
                                                aria-labelledby="size-choice-2-label">
                                            <span id="size-choice-2-label">S</span>
                                        </label>
                                        <!--
                                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                                        -->
                                        <label
                                            class="flex items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                                            <input type="radio" name="size-choice" value="M" class="sr-only"
                                                aria-labelledby="size-choice-3-label">
                                            <span id="size-choice-3-label">M</span>
                                        </label>
                                        <!--
                                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                                        -->
                                        <label
                                            class="flex items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none">
                                            <input type="radio" name="size-choice" value="L" class="sr-only"
                                                aria-labelledby="size-choice-4-label">
                                            <span id="size-choice-4-label">L</span>
                                        </label>
                                        <!--
                                          In Stock: "cursor-pointer", Out of Stock: "opacity-25 cursor-not-allowed"
                                          Active: "ring-2 ring-indigo-500 ring-offset-2"
                                          Checked: "border-transparent bg-indigo-600 text-white hover:bg-indigo-700", Not Checked: "border-gray-200 bg-white text-gray-900 hover:bg-gray-50"
                                        -->
                                        <label
                                            class="flex items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase sm:flex-1 cursor-not-allowed opacity-25">
                                            <input type="radio" name="size-choice" value="XL" disabled
                                                class="sr-only" aria-labelledby="size-choice-5-label">
                                            <span id="size-choice-5-label">XL</span>
                                        </label>
                                    </div>
                                </fieldset>
                            </div>

                            {{-- Quantity & Add to cart --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">
                                <div class="flex items-center justify-center w-full">
                                    <button
                                        class="group py-4 px-6 border border-gray-400 rounded-l-full shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
                                        <svg class="stroke-gray-700 transition-all duration-500 group-hover:stroke-black"
                                            width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                stroke-linecap="round" />
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                                stroke-linecap="round" />
                                            <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                    <input type="text"
                                        class="font-semibold text-gray-900 text-lg py-[13px] px-6 
                                        w-full lg:max-w-[118px] border-y border-gray-400 bg-transparent 
                                        placeholder:text-gray-900 text-center hover:bg-gray-50 focus-within:bg-gray-50 outline-0"
                                        placeholder="1">
                                    <button
                                        class="group py-4 px-6 border border-gray-400 rounded-r-full shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-300 hover:bg-gray-50">
                                        <svg class="stroke-gray-700 transition-all duration-500 group-hover:stroke-black"
                                            width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                stroke-linecap="round" />
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                stroke-width="1.6" stroke-linecap="round" />
                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-opacity="0.2"
                                                stroke-width="1.6" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>
                                <x-button type="soft" class="flex justify-center items-center !rounded-full">
                                    <x-icon code="shopping_cart" class="mr-2" />
                                    Agregar al carrito
                                </x-button>
                            </div>

                            {{-- Buy now --}}
                            <div class="flex items-center gap-3">
                                <x-button size="big" class="!rounded-full w-full !p-3.5 text-lg">
                                    Comprar ahora
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @dump($product)
@endsection
