<div>
    <div class="bg-white">

        @include('ecommerce.partials.products.mobile-filter')

        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @include('ecommerce.partials.products.header')

            <section aria-labelledby="products-heading" class="pb-24 pt-6">

                <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">

                    @if ($products->isNotEmpty())
                        
                        @include('ecommerce.partials.products.desktop-filter')

                        <!-- Products grid -->
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
                    @else
                        <section x-init="window.scrollTo({ top: 0, behavior: 'smooth' })" class="col-span-full">
                            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                                <div class="w-full flex-col justify-start items-center inline-flex">

                                    <img src="{{ URL::to('img/illustrations/web_search.svg') }}" 
                                    class="w-72 h-72" alt="empty products">

                                    <div class="w-full flex-col justify-start items-center lg:gap-11 md:gap-8 gap-6 flex">
                                        <div class="w-full flex-col justify-start items-center gap-4 flex">

                                            <h2 class="text-center text-blue-600 text-3xl font-bold font-manrope leading-tight">
                                                Sin resultados
                                            </h2>

                                            <p class="lg:max-w-2xl w-full text-center text-gray-600 text-base font-medium leading-relaxed">
                                                No te preocupes, muy pronto estarán llegando nuevos artículos y novedades
                                            </p>

                                            <x-button :href="route('ecommerce.products')" type="soft"
                                            class="flex items-center gap-x-0.5">
                                                Ver todos los productos
                                                <x-icon code="arrow_forward" />
                                            </x-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>                                          
                    @endif
                </div>
            </section>
        </main>
    </div>
</div>
