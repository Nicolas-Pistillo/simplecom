<div x-data="{ openProviderConfig: false }" 
class="w-full flex justify-center gap-4 flex-wrap"
x-on:close-provider-config.window="openProviderConfig = false"
x-on:open-provider-config.window="openProviderConfig = true">

    <div class="w-full">

        @if (!$collection_point)
            <x-alert class="mb-3" color="yellow" icon="warning" title="Sin puntos de colecta activos">
                Necesitas crear o asignar un 
                <span @click="current = 'Puntos de colecta'" 
                class="text-blue-600 hover:underline cursor-pointer">
                    punto de colecta
                </span> 
                para indicarle al proveedor donde pasar a retirar tus pedidos
            </x-alert>
        @else
            <x-alert class="mb-3" icon="location_on">
                <x-slot name="title">
                    Las cotizaciones y colectas se están realizando 
                    desde <b>{{ $collection_point->name }}</b>
                </x-slot>
            </x-alert>
        @endif
    </div>

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
                        <x-badge class="no-select !rounded-full" style="font-size: 11px">No configurado</x-badge>
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

    @include('admin.delivery-methods.partials.provider-config')

</div>
