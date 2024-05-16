<div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Featured Products</h2>
    <div class="flex items-center justify-center w-full h-full py-8 px-4">
        <div class="relative w-full">

            @if ($featuredProducts->count() > 3)
                
                {{-- Swiffy Slider for more than 3 featured products --}}

                <div class="swiffy-slider slider-item-show3 slider-nav-autopause
                slider-nav-round slider-nav-page slider-nav-outside slider-nav-autoplay	">

                    <ul class="slider-container" style="padding: 0.75rem 0px">
                        @foreach ($featuredProducts as $product)
                            <li class="flex justify-center">
                                <x-ecommerce.product-card :product="$product" />
                            </li>
                        @endforeach
                    </ul>
                
                    <button type="button" class="slider-nav" aria-label="Go left"></button>
                    <button type="button" class="slider-nav slider-nav-next" aria-label="Go left"></button>
                </div>

            @else 

                <div class="flex items-center justify-center flex-wrap gap-6">
                    @foreach ($featuredProducts as $product)
                        <x-ecommerce.product-card :product="$product" />
                    @endforeach
                </div>

            @endif
        </div>
    </div>
</div>