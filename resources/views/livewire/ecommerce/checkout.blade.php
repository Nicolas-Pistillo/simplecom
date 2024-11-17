<div>

    @if (Cart::count() > 0)
        <div class="pt-10 pb-4 mb-6">
            <h1 class="text-3xl text-center font-bold tracking-tight text-gray-900">
                Finalizá tu compra
            </h1>
        </div>

        <div class="lg:flex lg:min-h-full lg:flex-row-reverse lg:overflow-hidden pb-16">

            <!-- Order summary -->
            @include('ecommerce.partials.checkout.summary')

            <!-- Checkout form -->
            <section aria-labelledby="payment-heading"
            class="flex-auto overflow-y-auto px-4 pb-16 pt-12 sm:px-6 sm:pt-16 lg:px-8 lg:pb-24 lg:pt-0">

                <div class="mx-auto max-w-xl">

                    {{-- Stepper --}}
                    <ul class="relative flex flex-col md:flex-row gap-2">
                        
                        <li class="flex flex-col md:flex-row md:items-center gap-x-2 shrink basis-0 flex-1 group">
                            <div class="min-w-7 min-h-7 inline-flex items-center text-xs align-middle grow md:grow-0">
                                <span class="p-2 w-8 h-8 flex justify-center items-center shrink-0
                                bg-{{tenant('color')}}-600 text-white font-semibold rounded-full shadow">
                                    <x-icon code="deployed_code" />
                                </span>
                                <span class="ms-2 block grow md:grow-0 text-sm font-medium text-gray-800">
                                    Entrega
                                </span>
                            </div>
                            <div class="mt-2 w-px h-4 md:mt-0 ms-3.5 md:ms-0 md:w-full md:h-px md:flex-1 bg-gray-200 group-last:hidden"></div>
                        </li>

                        <li class="flex flex-col md:flex-row md:items-center gap-x-2 shrink basis-0 flex-1 group">
                            <div class="min-w-7 min-h-7 inline-flex items-center text-xs align-middle grow md:grow-0">
                                <span class="font-semibold bg-gray-100 text-gray-800 p-2 
                                w-8 h-8 flex justify-center items-center shrink-0 rounded-full shadow">
                                    <x-icon code="person_edit" />
                                </span>
                                <span class="ms-2 block grow md:grow-0 text-sm font-medium text-gray-800">
                                    Tus datos
                                </span>
                            </div>
                            <div class="mt-2 w-px h-4 md:mt-0 ms-3.5 md:ms-0 md:w-full md:h-px md:flex-1 bg-gray-200 group-last:hidden"></div>
                        </li>
                    
                        <li class="flex flex-col md:flex-row md:items-center gap-x-2 shrink basis-0 flex-1 group">
                            <div class="min-w-7 min-h-7 inline-flex items-center text-xs align-middle grow md:grow-0">
                                <span class="p-2 w-8 h-8 flex justify-center items-center shrink-0 bg-gray-100 
                                font-medium text-gray-800 rounded-full shadow">
                                    <x-icon code="credit_card" />
                                </span>
                                <span class="ms-2 block grow md:grow-0 text-sm font-medium text-gray-800">
                                    Confirmar
                                </span>
                            </div>
                            <div class="mt-2 w-px h-4 md:mt-0 ms-3.5 md:ms-0 md:w-full md:h-px md:flex-1 bg-gray-200 group-last:hidden"></div>
                        </li>

                    </ul>

                    {{-- Step Content --}}
                    <div class="mt-12">

                        @if ($current_step === 'customer')
                            @include('ecommerce.partials.checkout.customer')
                        @endif

                        @if ($current_step === 'shipping')
                            @include('ecommerce.partials.checkout.shipping')
                        @endif

                        @if ($current_step === 'review')
                            @include('ecommerce.partials.checkout.review')
                        @endif

                    </div>
                </div>
            </section>

        </div>
    @else
        <div class="py-16 sm:py-36 flex flex-col items-center">

            <div class="w-48 h-48 sm:w-64 sm:h-64 animate__animated animate__bounceIn">
                <img src="{{ URL::to('img/illustrations/empty_cart.svg') }}" alt="Carrito vacío">
            </div>

            <h4 class="text-xl mb-2 font-semibold text-gray-900">Carrito vacío</h4>
            <p class="text-sm mb-3">Agrega productos para completar tu próxima compra</p>
            <x-button :href="route('ecommerce.products')" type="secondary">Explorar productos</x-button>

        </div>
    @endif
</div>