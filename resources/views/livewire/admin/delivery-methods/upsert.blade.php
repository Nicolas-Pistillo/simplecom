<div>

    <x-tabs tabs="['Proveedores', 'Envios propios', 'Puntos de retiro']" 
    current="{{ request('tab') ?? 'Proveedores' }}">

        <div x-cloak x-show="current === 'Proveedores'" class="animate__animated animate__fadeIn">

            <section class="py-4 relative">
                <div class="w-full max-w-7xl sm:px-4 mx-auto">
                    <div class="w-full flex-col justify-start items-start gap-8 inline-flex">
                        <div class="w-full flex-col justify-start items-start gap-2.5 flex">
                            <h2 class="w-full text-center text-gray-900 text-lg sm:text-3xl font-bold 
                            font-manrope leading-normal">
                                Proveedores Integrados
                            </h2>
                            <p class="w-full max-w-4xl mx-auto text-center text-gray-500 
                            text-xs sm:text-sm font-normal">
                                Simplecom cuenta con soporte para múltiples proveedores logísticos según tus
                                necesidades. Al elegir uno, deberás registrarte como cliente en su plataforma correspondiente 
                                y cargar tus credenciales API obtenidas para comenzar a operar con el servicio, 
                                para ello preparamos un instructivo de integración por cada proveedor en particular para guiarte en cada paso.
                            </p>
                        </div>

                        <div class="w-full flex justify-center gap-4 flex-wrap">
                            @foreach ($shipping_providers as $provider)
                                <div wire:key='{{ $provider->id }}' x-data="{expanded: false}" 
                                class="relative max-w-2xs border border-solid border-gray-200 
                                rounded-2xl transition-all duration-500 h-max">
                                    <div class="block overflow-hidden border-b">
                                        <img src="{{ URL::to("img/providers/$provider->code.png") }}" 
                                        class="w-full h-32 object-cover rounded-t-2xl" />
                                    </div>
                                    <div class="p-4">

                                        <a href="{{ $provider->page_url }}" target="_blank" 
                                        class="text-base font-semibold text-gray-900 inline-block cursor-pointer
                                        transition mb-1 hover:underline hover:text-blue-700" x-tooltip.raw="Visitar página">
                                            {{ $provider->name }}
                                        </a>

                                        <p class="text-xs font-normal text-gray-600 transition-all duration-500 leading-5 mb-2"
                                        :class="expanded ? 'line-clamp-none' : 'line-clamp-3'" x-transition> 
                                            {{ $provider->description }} 
                                        </p>

                                        <small class="no-select block hover:underline text-blue-500 cursor-pointer mb-4"
                                        x-text="expanded ? 'Ver menos' : 'Ver mas'" @click="expanded = !expanded"></small>

                                        <x-button class="!rounded-full w-full">Integrar</x-button>
                                    </div>
                                </div>
                            @endforeach
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
