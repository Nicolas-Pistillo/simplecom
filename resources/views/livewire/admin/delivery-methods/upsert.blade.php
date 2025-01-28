<div>
    <div x-data="{ openProviderConfig: false }" x-on:close-provider-config.window="openProviderConfig = false"
        x-on:open-provider-config.window="openProviderConfig = true">

        <x-tabs tabs="['Retiros', 'Proveedores', 'Envios propios']"
            current="{{ request('tab') ?? 'Retiros' }}">

            <div x-cloak x-show="current === 'Proveedores'" class="animate__animated animate__fadeIn">
                <section class="py-4 relative">
                    <div class="w-full max-w-7xl sm:px-4 mx-auto">
                        <div class="w-full flex-col justify-start items-start gap-8 inline-flex">

                            <div class="w-full flex-col justify-start items-start gap-2.5 flex">

                                <h2 class="w-full text-center text-gray-900 text-lg sm:text-3xl 
                                font-bold font-manrope leading-normal">
                                    Proveedores Integrados
                                </h2>

                                <p class="w-full max-w-4xl mx-auto text-center text-gray-500 
                                text-xs sm:text-sm font-normal">
                                    Simplecom cuenta con soporte para múltiples proveedores logísticos según tus
                                    necesidades. Al elegir uno, deberás registrarte como cliente en su plataforma
                                    correspondiente
                                    y cargar tus credenciales API obtenidas para comenzar a operar con el servicio.
                                </p>
                            </div>

                            @include('admin.delivery-methods.partials.providers')

                        </div>
                    </div>
                </section>
            </div>

            <div x-cloak x-show="current === 'Envios propios'" class="animate__animated animate__fadeIn">
                <h4>Tab de envios propios</h4>
            </div>

            <div x-cloak x-show="current === 'Retiros'" class="animate__animated animate__fadeIn">
                <section class="py-4 relative">
                    <div class="w-full max-w-7xl sm:px-4 mx-auto">
                        <div class="w-full flex-col justify-start items-start gap-8 inline-flex">

                            <div class="w-full flex-col justify-start items-start gap-2.5 flex">

                                <h2 class="w-full text-center text-gray-900 text-lg sm:text-3xl 
                                font-bold font-manrope leading-normal">
                                    Retiros en tienda
                                </h2>

                                <p class="w-full max-w-4xl mx-auto text-center text-gray-500 
                                text-xs sm:text-sm font-normal">
                                    En esta sección podrás configurar los puntos de retiro o direcciones 
                                    donde tus compradores van a ir a buscar personalmente los pedidos que realicen en tu tienda.
                                </p>

                            </div>

                            @include('admin.delivery-methods.partials.store-pickups')

                        </div>
                    </div>
                </section>
            </div>

        </x-tabs>

        @include('admin.delivery-methods.partials.provider-config')

        @livewire('admin.new-store-pickup-point')
    </div>
</div>