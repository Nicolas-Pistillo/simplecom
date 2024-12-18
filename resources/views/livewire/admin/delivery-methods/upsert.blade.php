<div>

    <x-tabs tabs="['Proveedores', 'Envios propios', 'Puntos de retiro']" 
    current="{{ request('tab') ?? 'Proveedores' }}">

        <div x-cloak x-show="current === 'Proveedores'" class="animate__animated animate__fadeIn">

            <section class="py-4 relative">
                <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
                    <div class="w-full flex-col justify-start items-start gap-14 inline-flex">
                        <div class="w-full flex-col justify-start items-start gap-2.5 flex">
                            <h2 class="w-full text-center text-gray-900 text-lg sm:text-3xl font-bold 
                            font-manrope leading-normal">
                                Proveedores Integrados
                            </h2>
                            <p class="w-full max-w-4xl mx-auto text-center text-gray-500 
                            text-xs sm:text-sm font-normal">
                                Integrations refer to the process of combining different software systems or components
                                to work together seamlessly. This involves connecting various applications.
                            </p>
                        </div>

                        <div class="flex items-center justify-center gap-4 flex-wrap">
                            @for ($i = 0; $i < 6; $i++)
                                <div class="relative max-w-2xs border border-solid 
                                border-gray-200 rounded-2xl transition-all duration-500">
                                    <div class="block overflow-hidden border-b">
                                        <img src="{{ URL::to('img/providers/saires.png') }}" 
                                        class="w-full h-32 object-cover rounded-t-2xl" />
                                    </div>
                                    <div class="p-4">
                                        <h4 class="text-base font-semibold text-gray-900 mb-2 capitalize transition-all duration-500 ">Fast Transaction</h4>
                                        <p class="text-xs font-normal text-gray-600 transition-all duration-500 leading-5 mb-5"> Provides faster transaction, so money arrives in realtime </p>
                                        <x-button class="!rounded-full">Integrar</x-button>
                                    </div>
                                </div>
                            @endfor
                        </div>

                    </div>
                </div>
            </section>
        </div>

        <div x-cloak x-show="current === 'Envios propios'" class="animate__animated animate__fadeIn">
            <h4>Tab de envios propios</h4>
        </div>

        <div x-cloak x-show="current === 'Puntos de retiro'" class="animate__animated animate__fadeIn">
            <h4>Puntos de retiro</h4>
        </div>

    </x-tabs>

</div>
