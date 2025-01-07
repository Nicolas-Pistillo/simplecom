<div>
    <div x-data="{ openProviderConfig: false }" x-on:close-provider-config.window="openProviderConfig = false"
        x-on:open-provider-config.window="openProviderConfig = true">

        <x-tabs tabs="['Proveedores', 'Envios propios', 'Puntos de retiro']"
            current="{{ request('tab') ?? 'Proveedores' }}">

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
                                    y cargar tus credenciales API obtenidas para comenzar a operar con el servicio,
                                    para ello preparamos un instructivo de integración por cada proveedor en particular
                                    para
                                    guiarte en cada paso.
                                </p>
                            </div>

                            <div class="w-full flex justify-center gap-4 flex-wrap">
                                @foreach ($providers as $provider)
                                    <div wire:key='{{ $provider->id }}' x-data="{ expanded: false }"
                                        class="relative max-w-2xs border border-solid border-gray-200 
                                            rounded-2xl transition-all duration-500 h-max">
                                        <div class="block overflow-hidden border-b">
                                            <img src="{{ URL::to("img/providers/$provider->code.png") }}"
                                                class="w-full h-32 object-cover rounded-t-2xl" />
                                        </div>
                                        <div class="p-4">

                                            <div class="flex items-center justify-between mb-1.5">
                                                <a href="{{ $provider->page_url }}" target="_blank"
                                                    class="text-base font-semibold text-gray-900 inline-block cursor-pointer
                                                    transition hover:underline hover:text-blue-700"
                                                    x-tooltip.raw="Visitar página">
                                                    {{ $provider->name }}
                                                </a>

                                                @if ($provider->service()->isConfigurated())

                                                    <x-switch 
                                                    :checked="$provider->active" 
                                                    wireChange="toggleProviderActive({{ $provider->id }})" />
                                                @else
                                                    
                                                    <x-badge class="no-select">No configurado</x-badge>
                                                @endif
                                            </div>

                                            <p class="text-xs font-normal text-gray-600 transition-all duration-500 leading-5 mb-2"
                                                :class="expanded ? 'line-clamp-none' : 'line-clamp-3'" x-transition>
                                                {{ $provider->description }}
                                            </p>

                                            <small class="no-select block hover:underline text-blue-500 cursor-pointer mb-4"
                                                x-text="expanded ? 'Ver menos' : 'Ver mas'"
                                                @click="expanded = !expanded"></small>

                                            <x-button wire:click='configProvider({{ $provider->id }})'
                                                class="!rounded-full w-full">Configurar</x-button>
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

        <div x-show="openProviderConfig" x-cloak class="relative z-40">
            <div x-show="openProviderConfig" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-700 bg-opacity-60"></div>

            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                        <div x-show="openProviderConfig"
                            x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                            x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                            x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                            @click.away="openProviderConfig = false" class="w-screen max-w-2xl">

                            @if ($configuring_provider)
                                <form wire:submit='saveProviderConfig'
                                    class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                                    <div class="flex-1">

                                        <!-- Header -->
                                        <div class="bg-white px-4 py-6 sm:px-6 border-b">
                                            <div class="flex items-center justify-between space-x-3">

                                                <h2 class="text-base font-semibold text-gray-900">
                                                    Configurar {{ $configuring_provider->name }}
                                                </h2>

                                                <div class="flex h-7 items-center gap-x-3">

                                                    <img class="hidden sm:block h-12 w-28 sm:w-36 bg-white object-cover rounded-md"
                                                        src="{{ URL::to("img/providers/$configuring_provider->code.png") }}"
                                                        alt="provider img">

                                                    <x-icon code="close" style="font-size: 18px"
                                                        @click="openProviderConfig = false"
                                                        x-tooltip.raw.placement.left="Cerrar panel"
                                                        class="text-gray-500 bg-white hover:text-red-500 
                                                        p-2 rounded-full border cursor-pointer hover:border-gray-300 
                                                        transition duration-200" />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0">

                                            @foreach ($configuring_provider_keys as $key => $field)
                                                @if ($field['input_type'] === 'text')
                                                    <div wire:key='{{ $field['id'] }}'
                                                        class="space-y-2 
                                                    px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 
                                                    sm:px-6 sm:py-5">

                                                        <div>
                                                            <div class="flex items-center justify-between">

                                                                <label for="{{ $field['key'] }}"
                                                                    class="block text-sm/6 font-medium text-gray-900">

                                                                    {{ $field['display_name'] }}

                                                                    @if ($field['required'])
                                                                        <sup class="text-red-500">*</sup>
                                                                    @endif
                                                                </label>

                                                                @if (!empty($field['helper']))
                                                                    <x-icon code="help"
                                                                        class="text-blue-600 cursor-help"
                                                                        style="font-size: 18px"
                                                                        x-tooltip.raw.placement.bottom="{{ $field['helper'] }}" />
                                                                @endif
                                                            </div>

                                                            @error($field['key'])
                                                                <small class="text-red-500">{{ $message }}</small>
                                                            @else
                                                                <small
                                                                    class="text-gray-500">{{ $field['description'] }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="sm:col-span-2">
                                                            <input type="text" id="{{ $field['key'] }}"
                                                                value="{{ $field['value'] }}"
                                                                wire:model.blur="configuring_provider_keys.{{ $key }}.value"
                                                                autocomplete="off"
                                                                class="block w-full rounded-md bg-white px-3 py-1.5 
                                                              text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 
                                                              placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 
                                                              focus:outline-blue-600 text-sm/6">
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($field['input_type'] === 'textarea')
                                                    <div wire:key='{{ $field['id'] }}'
                                                        class="space-y-2 px-4 sm:grid 
                                                    sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">

                                                        <div>
                                                            <div class="flex items-center justify-between">

                                                                <label for="{{ $field['key'] }}"
                                                                    class="block text-sm/6 font-medium text-gray-900">

                                                                    {{ $field['display_name'] }}

                                                                    @if ($field['required'])
                                                                        <sup class="text-red-500">*</sup>
                                                                    @endif
                                                                </label>

                                                                @if (!empty($field['helper']))
                                                                    <x-icon code="help"
                                                                        class="text-blue-600 cursor-help"
                                                                        style="font-size: 18px"
                                                                        x-tooltip.raw.placement.bottom="{{ $field['helper'] }}" />
                                                                @endif
                                                            </div>

                                                            @error($field['key'])
                                                                <small class="text-red-500">{{ $message }}</small>
                                                            @else
                                                                <small
                                                                    class="text-gray-500">{{ $field['description'] }}</small>
                                                            @enderror

                                                        </div>

                                                        <div class="sm:col-span-2">
                                                            <textarea rows="3" id="{{ $field['key'] }}"
                                                                class="block w-full rounded-md bg-white px-3 
                                                            py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 
                                                            focus:outline focus:outline-2 focus:-outline-offset-2 
                                                            focus:outline-indigo-600 sm:text-sm/6">{{ $field['value'] }}</textarea>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Action buttons -->
                                    <div class="shrink-0 border-t border-gray-200 px-4 py-5 sm:px-6">
                                        <div class="flex justify-end space-x-3">
                                            <x-button @click="openProviderConfig = false" size="large"
                                                type="secondary">Cancelar</x-button>
                                            <x-button submit size="large">Guardar</x-button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
