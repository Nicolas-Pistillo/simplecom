<div x-data="{ openProviderConfig: false }" class="w-full flex justify-center gap-4 flex-wrap"
    x-on:close-provider-config.window="openProviderConfig = false"
    x-on:open-provider-config.window="openProviderConfig = true">

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    Proveedores de envíos
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    Simplecom cuenta con soporte para múltiples proveedores logísticos según tus
                    necesidades. Al elegir uno, deberás registrarte como cliente en su plataforma
                    correspondiente y cargar tus credenciales API obtenidas
                    para comenzar a operar con el servicio en tu tienda.
                </p>
            </div>
        </div>

        <div class="w-full my-6">

            @if (!$origin_point)
                <x-alert class="mx-auto" color="yellow" icon="warning" title="Sin puntos de origen activos">
                    Necesitas crear o asignar un
                    <span @click="current = 'Puntos de origen'" class="text-blue-600 hover:underline cursor-pointer">
                        punto de origen
                    </span>
                    para indicarle al proveedor desde donde cotizar y retirar tus pedidos
                </x-alert>
            @else
                <x-alert class="mx-auto" color="blue" icon="where_to_vote">
                    <x-slot name="title">
                        Las cotizaciones y despachos se están realizando
                        desde <b>{{ $origin_point->name }}</b>
                    </x-slot>
                </x-alert>
            @endif
        </div>

        <div class="flex items-center justify-center sm:justify-start flex-wrap gap-4">
            @foreach ($providers as $provider)
                <div wire:key='{{ $provider->id }}' x-data="{ expanded: false }"
                class="relative max-w-2xs border border-solid border-gray-200 
                rounded-2xl transition duration-300 h-max hover:shadow-lg">

                    <div class="block overflow-hidden border-b">
                        <img src="{{ Storage::url("providers/$provider->code.png") }}"
                            class="w-full h-32 object-cover rounded-t-2xl" />
                    </div>

                    <div class="p-4">

                        <div class="flex items-center justify-between mb-1.5">
                            <a href="{{ $provider->page_url }}" target="_blank"
                                class="text-base font-semibold text-gray-900 inline-block
                            cursor-pointer transition hover:text-blue-600"
                                x-tooltip.raw="Visitar página">
                                {{ $provider->name }}
                            </a>

                            @if ($provider->service()->isConfigurated())
                                <x-switch :checked="$provider->active" wireChange="toggleProviderActive({{ $provider->id }})" />
                            @else
                                <x-badge class="no-select !rounded-full" style="font-size: 11px">No
                                    configurado</x-badge>
                            @endif
                        </div>

                        <p class="text-xs font-normal text-gray-600 transition-all duration-500 leading-5 mb-2"
                            :class="expanded ? 'line-clamp-none' : 'line-clamp-3'" x-transition>
                            {{ $provider->description }}
                        </p>

                        <small class="no-select block hover:underline text-blue-500 cursor-pointer mb-4"
                            x-text="expanded ? 'Ver menos' : 'Ver mas'" @click="expanded = !expanded"></small>

                        <div class="flex items-center gap-x-2">

                            @if ($provider->service()->isConfigurated())
                                <x-button class="!rounded-full w-full">
                                    Promociones
                                </x-button>
                            @endif

                            <x-button wire:click='configProvider({{ $provider->id }})' :type="$provider->service()->isConfigurated() ? 'secondary' : 'primary'"
                                class="!rounded-full w-full">
                                Configurar
                            </x-button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @include('admin.delivery-methods.partials.provider-config')
    </div>

</div>
