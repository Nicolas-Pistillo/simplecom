<div>

    {{-- @dump($payment_methods) --}}

    <div class="px-4 sm:px-6 lg:px-8" x-data="{ openCredentialsDrawer: false }" x-on:close-drawer.window="openCredentialsDrawer = false"
        x-on:open-drawer.window="openCredentialsDrawer = true">

        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Formas de pago</h1>
                <p class="mt-2 text-sm text-gray-700">
                    En esta sección podras gestionar, configurar y activar las diferentes pasarelas
                    de pago que Simplecom ofrece para tu comercio, recordá descargar y leer los instructivos
                    de cada forma de pago para comenzar a operarla.
                </p>
            </div>
        </div>

        <ul class="flex items-start justify-center lg:justify-start gap-8 my-4 flex-wrap">
            @foreach ($payment_methods as $method)
                <li wire:key='{{ $method->id }}' x-data="{ open: false, expanded: false }"
                class="relative rounded-xl border border-gray-200 
                w-full sm:w-96 transition-shadow duration-300 hover:shadow-md">

                    <div class="flex rounded-t-xl items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-4">

                        <img src='{{ Storage::url("providers/$method->code") }}.png' alt="{{ $method->display_name }}"
                        class="h-12 w-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10">

                        <div class="flex flex-col">

                            <h6 class="text-sm mb-1 font-semibold leading-6 text-gray-900">
                                @if ($method->page_url)
                                    <a href="{{ $method->page_url }}" target="_blank"
                                    class="transition duration-300 hover:text-blue-600"
                                    x-tooltip.raw.placement.top="Visitar página">
                                        {{ $method->display_name }}
                                    </a>
                                @else
                                    {{ $method->display_name }}
                                @endif
                            </h6>

                            @if (!$method->needs_configuration || $method->service()->isConfigurated())
                                <x-switch :checked="$method->active" wireChange="toggleActivated({{ $method->id }})" />
                            @else
                                <x-badge class="w-max !rounded-full">No configurado</x-badge>
                            @endif

                        </div>

                        <div class="relative ml-auto">

                            <button @click="open = !open" @click.away="open = false" type="button"
                            class="w-9 h-9 flex items-center justify-center text-gray-400 hover:text-gray-500 
                            bg-white transition-colors duration-300 border rounded-full hover:border-gray-300">
                                <x-icon code="more_horiz" style="font-size: 20px" />
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 z-10 mt-0.5 w-max origin-top-right 
                                rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 
                                focus:outline-none"
                                role="menu" aria-orientation="vertical">

                                @if (!empty($method->support_url))
                                    <a href="{{ $method->support_url }}" target="_blank"
                                        class="block w-full text-left px-3 py-1 hover:bg-gray-100 text-sm leading-6 
                                        text-gray-800 transition-colors duration-200"
                                        role="menuitem">
                                        Ir a la página de soporte
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="relative -my-3 mb-0.5 px-6 pt-6 pb-3 text-sm leading-6">
                        <p class="text-ellipsis text-gray-700 text-xs sm:text-sm"
                            :class="expanded ? 'line-clamp-none' : 'line-clamp-3'" x-transition>
                            {{ $method->description }}
                        </p>

                        <small class="no-select block hover:underline text-blue-400 cursor-pointer"
                            x-text="expanded ? 'Ver menos' : 'Ver mas'" @click="expanded = !expanded"></small>
                    </div>

                    <div class="-mt-px flex divide-x divide-gray-200 border-t">
                        <div class="flex w-0 flex-1 transition-colors duration-300 hover:bg-gray-50 rounded-bl-xl">
                            <button
                                class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 
                                rounded-bl-lg border border-transparent py-2 md:py-4 text-xs sm:text-sm font-semibold text-gray-900">
                                <x-icon code="article" class="text-gray-400" />
                                Instructivo
                            </button>
                        </div>
                        <div
                            class="-ml-px flex w-0 flex-1 transition-colors duration-300 hover:bg-gray-50 rounded-br-xl">
                            <button wire:click='openConfiguration({{ $method->id }})'
                                class="relative inline-flex w-0 flex-1 items-center justify-center 
                                gap-x-3 rounded-br-lg border border-transparent py-2 md:py-4 text-xs sm:text-sm font-semibold text-gray-900">
                                <x-icon code="edit" class="text-gray-400" />
                                Configurar
                            </button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        {{-- Credentials configuration drawer --}}
        <x-drawer ref="openCredentialsDrawer">
            @if ($method_editing && $configurable_fields)
                <div class="h-full">
                    <form wire:submit='save' class="h-full flex flex-col justify-between">

                        <div class="mb-3">

                            <div class="mb-3 flex items-center gap-x-3">
                                <img src="{{ Storage::url("providers/$method_editing->code.png") }}" 
                                class="w-10 h-10 rounded-lg object-cover" alt="Provider logo">
                                <h3 class="text-lg text-gray-700 font-semibold">
                                    {{ $drawerTitle }}
                                </h3>
                            </div>

                            <hr class="mb-6">

                            <div class="mb-4">

                                <label class="flex items-center gap-x-2 text-sm font-semibold leading-6 text-gray-500"
                                for="checkout_name">
                                    Nombre público <sup class="text-red-500 -ml-1">*</sup> 
                                    <x-icon code="help" class="text-blue-600 cursor-help" 
                                    x-tooltip.raw.placement.bottom="Es el nombre que verá el comprador en el listado de métodos de pago del checkout" 
                                    style="font-size: 20px" />
                                </label>

                                <div class="mt-2">
                                    <input type="text" value="{{ $method_editing->checkout_name }}"
                                    id="checkout_name" 
                                    wire:model='checkout_name' autocomplete="off"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                                    shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                                    focus:ring-2 focus:ring-inset transition duration-300 
                                    focus:ring-blue-600  sm:text-sm sm:leading-6">
                                </div>

                                @error('checkout_name')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror

                            </div>

                            @foreach ($configurable_fields as $key => $field)
                                <div wire:key='{{ $field['id'] }}' class="mb-4">

                                    <label class="block text-sm font-semibold leading-6 text-gray-500"
                                    for="{{ $field['key'] }}">
                                        {{ $field['display_name'] }}
                                        @if ($field['required'])
                                            <sup class="text-red-500">*</sup> 
                                        @endif
                                    </label>

                                    <div class="mt-2">
                                        <input type="text" value="{{ $field['value'] }}" id="{{ $field['key'] }}"
                                        wire:model.blur="configurable_fields.{{ $key }}.value" autocomplete="off"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                                        shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2
                                        placeholder:text-gray-400 focus:ring-inset sm:text-sm
                                        transition duration-300 focus:ring-blue-600 sm:leading-6">
                                    </div>

                                    @if ($field['helper'] && !$errors->has($field['key']))
                                        <small class="text-gray-500">{{ $field['helper'] }}</small>
                                    @endif

                                    @error($field['key'])
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <div class="flex items-center mt-auto pb-3 pt-6">

                            <x-button submit wire:loading.remove wire:target='save' size="large"
                                class="w-full mr-4">Guardar</x-button>

                            <x-spinner wire:loading wire:target='save' class="w-full" />

                            <x-button wire:loading.remove wire:target='save' wire:click='cancel' size="large"
                                class="w-full" type="secondary">
                                Cancelar
                            </x-button>
                        </div>
                    </form>
                </div>
            @endif
        </x-drawer>
    </div>
</div>
