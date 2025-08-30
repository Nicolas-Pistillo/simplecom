<div>
    <div class="bg-white">
        <div class="mx-auto px-4 pt-8 pb-16 sm:px-6 lg:max-w-7xl lg:px-8">

            {{-- Category Bradcrumb --}}
            <div class="mb-3 mx-auto lg:mx-0 max-w-2xl lg:col-span-4 lg:row-end-1 lg:mt-0 lg:max-w-none">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol role="list" class="flex items-center flex-wrap text-sm">

                        {{-- Category Grandfather --}}
                        @if ($product->category->father?->father)
                            <li>
                                <div class="flex items-center">
                                    <a href="{{ $product->category->father->father->pageUrl() }}"
                                        class="text-gray-400 hover:text-blue-600 mr-1">
                                        <span>{{ $product->category->father->father->name }}</span>
                                    </a>
                                    <x-icon code="navigate_next" class="text-gray-400" style="font-size: 20px" />
                                </div>
                            </li>
                        @endif

                        {{-- Category father --}}
                        @if ($product->category->father)
                            <li>
                                <div class="flex items-center">
                                    <a href="{{ $product->category->father->pageUrl() }}"
                                        class="text-gray-400 hover:text-blue-600 mr-1">
                                        <span>{{ $product->category->father->name }}</span>
                                    </a>
                                    <x-icon code="navigate_next" class="text-gray-400" style="font-size: 20px" />
                                </div>
                            </li>
                        @endif

                        <li>
                            <div class="flex items-center">
                                <a href="{{ $product->category->pageUrl() }}"
                                    class="text-gray-400 hover:text-blue-600 mr-1">
                                    <span>{{ $product->category->name }}</span>
                                </a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            {{-- - Product --}}
            <div class="lg:grid lg:grid-cols-7 lg:grid-rows-1 lg:gap-x-8 lg:gap-y-10 xl:gap-x-16">

                {{-- Product Images --}}
                @include('ecommerce.partials.product-detail.images')

                {{-- Product Details --}}
                @include('ecommerce.partials.product-detail.main-info')

                {{-- Additional info tabs --}}
                @include('ecommerce.partials.product-detail.additional-info-tabs')
            </div>
        </div>
    </div>
</div>