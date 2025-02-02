<div>
    <div class="bg-white">

        @include('ecommerce.partials.products.mobile-filter')

        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @include('ecommerce.partials.products.header')

            <section aria-labelledby="products-heading" class="pb-24 pt-6">

                <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">

                    @include('ecommerce.partials.products.desktop-filter')
                    
                    <!-- Product grid -->
                    <div class="lg:col-span-3 flex items-end justify-center md:justify-start 
                    flex-wrap gap-x-4 gap-y-8 h-max">

                        @foreach ($products as $product)
                            <x-ecommerce.product-card wire:key='{{ $product->id }}' 
                            :product="$product" />
                        @endforeach
                        
                        <div class="w-full">
                            <div class="mx-auto w-max">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
