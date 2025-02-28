@extends('layouts.dashboards.admin')

@section('title', 'Formas de entrega - Listado')

@section('content')

    <x-tabs tabs="['Retiros', 'Proveedores', 'Envios propios']" current="{{ request('tab') ?? 'Retiros' }}">

        <div x-cloak x-show="current === 'Retiros'" x-transition>
            <section class="relative">
                <div class="w-full max-w-7xl sm:px-4 mx-auto">

                    <div class="w-full flex-col justify-start items-start gap-2.5 flex mb-8">

                        <h2 class="w-full text-center text-gray-900 text-lg sm:text-3xl 
                        font-bold font-manrope leading-normal">
                            Retiros en tienda
                        </h2>

                        <p class="w-full max-w-4xl mx-auto text-center text-gray-500 
                        text-xs sm:text-sm font-normal">
                            En esta sección podrás configurar las ubicaciónes o sucursales
                            donde tus clientes van a ir a retirar los pedidos que realicen en tu tienda.
                        </p>

                    </div>

                    @livewire('admin.delivery-methods.store-pickups')

                </div>
            </section>
        </div>

        <div x-cloak x-show="current === 'Proveedores'" x-transition>
            <section class="relative">
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
                                correspondiente y cargar tus credenciales API obtenidas 
                                para comenzar a operar con el servicio en tu tienda.
                            </p>
                        </div>

                        <x-tabs simple tabs="['Integraciones', 'Puntos de origen']"
                        current="{{ request('providers-tab') ?? 'Integraciones' }}" class="w-full">

                            <section x-cloak x-show="current === 'Integraciones'" x-transition>
                                @livewire('admin.delivery-methods.providers')
                            </section>

                            <section x-cloak x-show="current === 'Puntos de origen'" x-transition>
                                @livewire('admin.delivery-methods.origin-points')
                            </section>

                        </x-tabs>

                    </div>
                </div>
            </section>
        </div>

        <div x-cloak x-show="current === 'Envios propios'" x-transition>
            <section class="relative">
                <div class="w-full max-w-7xl sm:px-4 mx-auto">
                    <div class="w-full flex-col justify-start items-start gap-8 inline-flex">

                        <div class="w-full flex-col justify-start items-start gap-2.5 flex">

                            <h2
                                class="w-full text-center text-gray-900 text-lg sm:text-3xl 
                                font-bold font-manrope leading-normal">
                                Envíos propios
                            </h2>

                            <p
                                class="w-full max-w-4xl mx-auto text-center text-gray-500 
                                text-xs sm:text-sm font-normal">
                                Aca podrás configurar tus propias formas y condiciones de envío ya sea con un servicio de
                                cadetería o logistica
                                que no este integrado con simplecom o si vas a encargarte vos mismo de la entrega de tus
                                pedidos.
                            </p>

                        </div>

                    </div>
                </div>
            </section>
        </div>

    </x-tabs>

@endsection
