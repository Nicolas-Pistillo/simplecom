<div>
    <div class="bg-white">

        @include('ecommerce.partials.products.mobile-filter')

        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @include('ecommerce.partials.products.header')

            <section aria-labelledby="products-heading" class="pb-24 pt-6">

                <div class="grid grid-cols-1  gap-x-8 gap-y-10 lg:grid-cols-4">

                    @if ($products->isNotEmpty())
                        
                        @include('ecommerce.partials.products.desktop-filter')

                        <div wire:loading.flex 
                        class="lg:col-span-3 flex items-center justify-center 
                        sm:justify-start flex-wrap gap-6">
                            @for ($i = 0; $i < 9; $i++)
                                <div role='status'
                                class='w-[264px] h-max border border-gray-300 rounded-lg p-4'>
                                    <div class="animate-pulse w-full bg-gray-300 h-48 rounded-lg mb-5 flex justify-center items-center">
                                        <svg class="w-8 h-8 stroke-gray-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20.5499 15.15L19.8781 14.7863C17.4132 13.4517 16.1808 12.7844 14.9244 13.0211C13.6681 13.2578 12.763 14.3279 10.9528 16.4679L7.49988 20.55M3.89988 17.85L5.53708 16.2384C6.57495 15.2167 7.09388 14.7059 7.73433 14.5134C7.98012 14.4396 8.2352 14.4011 8.49185 14.3993C9.16057 14.3944 9.80701 14.7296 11.0999 15.4M11.9999 21C12.3154 21 12.6509 21 12.9999 21C16.7711 21 18.6567 21 19.8283 19.8284C20.9999 18.6569 20.9999 16.7728 20.9999 13.0046C20.9999 12.6828 20.9999 12.3482 20.9999 12C20.9999 11.6845 20.9999 11.3491 20.9999 11.0002C20.9999 7.22883 20.9999 5.34316 19.8283 4.17158C18.6568 3 16.7711 3 12.9998 3H10.9999C7.22865 3 5.34303 3 4.17145 4.17157C2.99988 5.34315 2.99988 7.22877 2.99988 11C2.99988 11.349 2.99988 11.6845 2.99988 12C2.99988 12.3155 2.99988 12.651 2.99988 13C2.99988 16.7712 2.99988 18.6569 4.17145 19.8284C5.34303 21 7.22921 21 11.0016 21C11.3654 21 11.7021 21 11.9999 21ZM7.01353 8.85C7.01353 9.84411 7.81942 10.65 8.81354 10.65C9.80765 10.65 10.6135 9.84411 10.6135 8.85C10.6135 7.85589 9.80765 7.05 8.81354 7.05C7.81942 7.05 7.01353 7.85589 7.01353 8.85Z" stroke="stroke-current" stroke-width="1.6" stroke-linecap="round"></path>
                                        </svg>
                                    </div>
                                    <div class=' w-full flex justify-between items-start animate-pulse'>
                                        <div class="block">
                                            <h3 class='h-3 bg-gray-300 rounded-full  w-48 mb-4'></h3>
                                            <p class='h-2 bg-gray-300 rounded-full w-32 mb-2.5'></p>
                                        </div>
                                        <span class="h-2 bg-gray-300 rounded-full w-16 "></span>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        {{-- Products Grid --}}
                        <div wire:loading.remove
                        class="lg:col-span-3 flex items-end justify-center 
                        md:justify-start flex-wrap gap-x-4 gap-y-8 h-max">

                            @foreach ($products as $product)
                                <livewire:ecommerce.product :product="$product->id" wire:key="{{ $product->id }}" />
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

                                            <h2 class="text-center text-gray-600 text-3xl font-bold font-manrope leading-tight">
                                                Sin resultados
                                            </h2>

                                            <p class="lg:max-w-2xl w-full text-center text-gray-600 text-base font-medium leading-relaxed">
                                                No te preocupes, muy pronto estarán llegando nuevos artículos y novedades
                                            </p>

                                            @if ($form->category)
                                                <x-button :href="route('ecommerce.products')" type="soft"
                                                class="flex items-center gap-x-0.5">
                                                    Ver todos los productos
                                                    <x-icon code="arrow_forward" />
                                                </x-button>
                                            @endif
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
