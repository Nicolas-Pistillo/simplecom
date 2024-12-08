<div>

    @if (Cart::count() > 0)

        <div class="pt-10 pb-4 mb-6">
            <h1 class="text-3xl text-center font-bold tracking-tight text-gray-900">
                Finalizá tu compra
            </h1>
        </div>

        <div class="flex flex-col lg:flex-row-reverse min-h-full overflow-hidden pb-8">

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
                                <div
                                    class="font-semibold p-2 w-8 h-8 flex justify-center items-center shrink-0 rounded-full shadow
                                    @if ($current_step === 1) bg-{{ tenant('color') }}-600 text-white @endif
                                    @if ($current_step > 1) bg-green-600 text-white @endif">
                                    @if ($current_step > 1)
                                        <x-icon code="check" wire:click='setStep(1)' class="cursor-pointer" />
                                    @else
                                        1
                                    @endif
                                </div>
                                <div
                                    class="ms-2 block grow md:grow-0 text-sm font-medium @if ($current_step > 1) text-green-600 @else text-gray-800 @endif">
                                    <span
                                        @if ($current_step > 1) class="cursor-pointer" wire:click="setStep(1)" @endif>
                                        Tus datos
                                    </span>
                                </div>
                            </div>
                            <div
                                class="mt-2 w-px h-4 md:mt-0 ms-3.5 md:ms-0 md:w-full md:h-px md:flex-1 group-last:hidden
                            @if ($current_step === 1) bg-gray-200 @else bg-green-600 @endif">
                            </div>
                        </li>

                        <li class="flex flex-col md:flex-row md:items-center gap-x-2 shrink basis-0 flex-1 group">
                            <div class="min-w-7 min-h-7 inline-flex items-center text-xs align-middle grow md:grow-0">
                                <div
                                    class="p-2 w-8 h-8 flex justify-center items-center shrink-0 font-semibold rounded-full shadow
                                    @if ($current_step === 2) bg-{{ tenant('color') }}-600 text-white @endif
                                    @if ($current_step < 2) bg-gray-100 text-gray-800 @endif
                                    @if ($current_step > 2) bg-green-600 text-white @endif">
                                    @if ($current_step > 2)
                                        <x-icon code="check" wire:click="setStep(2)" class="cursor-pointer" />
                                    @else
                                        2
                                    @endif
                                </div>
                                <div
                                    class="ms-2 block grow md:grow-0 text-sm font-medium
                                    @if ($current_step > 2) text-green-600 @else text-gray-800 @endif">
                                    <span
                                        @if ($current_step > 2) class="cursor-pointer" wire:click="setStep(2)" @endif>
                                        Entrega
                                    </span>
                                </div>
                            </div>
                            <div
                                class="mt-2 w-px h-4 md:mt-0 ms-3.5 md:ms-0 md:w-full md:h-px md:flex-1 group-last:hidden
                            @if ($current_step > 2) bg-green-600 @else bg-gray-200 @endif">
                            </div>
                        </li>

                        <li class="flex flex-col md:flex-row md:items-center gap-x-2 shrink basis-0 flex-1 group">
                            <div class="min-w-7 min-h-7 inline-flex items-center text-xs align-middle grow md:grow-0">
                                <span
                                    class="p-2 w-8 h-8 flex justify-center items-center shrink-0 font-semibold rounded-full shadow
                                @if ($current_step === 3) bg-{{ tenant('color') }}-600 text-white @endif
                                @if ($current_step < 3) bg-gray-100 text-gray-800 @endif">
                                    3
                                </span>
                                <span class="ms-2 block grow md:grow-0 text-sm font-medium text-gray-800">
                                    Confirmar
                                </span>
                            </div>
                            <div
                                class="mt-2 w-px h-4 md:mt-0 ms-3.5 md:ms-0 md:w-full md:h-px md:flex-1 bg-gray-200 group-last:hidden">
                            </div>
                        </li>

                    </ul>

                    {{-- Step Content --}}
                    <div class="mt-12">

                        @if ($current_step === 1)
                            @include('ecommerce.partials.checkout.customer')
                        @endif

                        @if ($current_step === 2)
                            @include('ecommerce.partials.checkout.shipping')
                        @endif

                        @if ($current_step === 3)
                            @include('ecommerce.partials.checkout.payment')
                        @endif

                    </div>
                </div>
            </section>

            <section class="relative py-8 sm:p-8">
                <div class="w-full max-w-7xl mx-auto px-4 lg:px-8 xl:px-14 relative">

                    <div class="w-full relative flex justify-center">
                        <div id="modalBox-23"
                            class="pd-overlay w-full h-full fixed top-0 left-0 z-[20] overflow-x-hidden overflow-y-auto">
                            <div class="opacity-1 ease-out sm:max-w-md sm:w-full m-3 relative top-1/2 shadow-xl
                            -translate-y-1/2 sm:mx-auto modal-open:opacity-100 transition-all modal-open:duration-500">
                                <div class="flex items-start bg-white p-6 rounded-lg">
                                    <div class="block w-full">

                                        <div class="flex items-center justify-between mb-5">

                                            <h6 class="text-lg font-bold leading-8 text-gray-900 ">
                                                Nueva dirección
                                            </h6>

                                            <x-icon code="close" class="transition colors duration-300 text-[18px]
                                            cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                          hover:bg-gray-200 focus:outline-none focus:ring" />
                                        </div>

                                        <div class="w-full relative">

                                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                <x-icon code="search" class="text-gray-500" />
                                            </div>

                                            <input type="text" id="simple-search"
                                                class="bg-white border
                                                border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                                focus:border-blue-500 block w-full ps-10 p-2.5"
                                                autocomplete="off"
                                                placeholder="Busca tu dirección y seleccioná un resultado..." />
                                        </div>

                                        <div class="flex flex-col gap-3 pr-2 my-5 max-h-[230px] overflow-y-auto" scrollbar-thin>

                                            @for ($i = 0; $i < 7; $i++)
                                                <div class="flex items-center gap-x-3">
                                                    <x-icon code="location_on" />
                                                    <div class="flex items-center w-full">
                                                        <div class="block w-full">
                                                            <p class="text-sm font-medium text-gray-900">Jessie Mayert
                                                            </p>
                                                            <span class="text-xs font-normal text-gray-500">Until Jan 20,
                                                                2024 at 10:20 AM</span>
                                                        </div>
                                                        <div class="flex items-center gap-3.5">
                                                            <button
                                                                class="text-gray-600 transition-all duration-300 hover:text-gray-900">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                    height="18" viewBox="0 0 18 18" fill="none">
                                                                    <path
                                                                        d="M8.25 2.25H9.75C12.5784 2.25 13.9926 2.25 14.8713 3.12868C15.75 4.00736 15.75 5.42157 15.75 8.25V9.75M7.5 15.75C5.39331 15.75 4.33996 15.75 3.58329 15.2444C3.25572 15.0255 2.97447 14.7443 2.75559 14.4167C2.25 13.66 2.25 12.6067 2.25 10.5C2.25 8.39331 2.25 7.33996 2.75559 6.58329C2.97447 6.25572 3.25572 5.97447 3.58329 5.75559C4.33996 5.25 5.39331 5.25 7.5 5.25C9.60669 5.25 10.66 5.25 11.4167 5.75559C11.7443 5.97447 12.0255 6.25572 12.2444 6.58329C12.75 7.33996 12.75 8.39331 12.75 10.5C12.75 12.6067 12.75 13.66 12.2444 14.4167C12.0255 14.7443 11.7443 15.0255 11.4167 15.2444C10.66 15.75 9.60669 15.75 7.5 15.75Z"
                                                                        stroke="currentColor" stroke-width="1.6"
                                                                        stroke-linecap="round" />
                                                                </svg>
                                                            </button>
                                                            <button
                                                                class="text-gray-600 transition-all duration-300 hover:text-gray-900">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                    height="18" viewBox="0 0 18 18" fill="none">
                                                                    <path
                                                                        d="M5.27065 9.00073H5.23315M9.03091 9.00073H8.99341M12.7912 9.00073H12.7537"
                                                                        stroke="currentColor" stroke-width="2.5"
                                                                        stroke-linecap="round" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            @endfor

                                        </div>

                                        <div class="flex items-center gap-4">
                                            <x-button type="soft" size="large" class="w-full">Guardar</x-button>
                                            {{-- <button class="py-2.5 px-3.5 w-full text-center rounded-lg bg-indigo-600 text-sm font-medium text-white close-modal-button"
                                            data-pd-overlay="#modalBox-23"
                                            data-modal-target="modalBox-23">Save</button> --}}
                                            <x-button size="large" class="w-full">Guardar</x-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="backdrop" class="fixed top-0 left-0 w-full h-full bg-black/50 z-[10]">
                        </div>
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
            <x-button :href="route('ecommerce.products')" type="soft">Explorar productos</x-button>

        </div>
    @endif

</div>
