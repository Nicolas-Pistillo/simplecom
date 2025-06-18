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

                                            <img class="hidden sm:block h-14 w-28 sm:w-36 bg-white object-cover rounded-md"
                                                src="{{ Storage::url("providers/$configuring_provider->code.png") }}"
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
                                        @if (in_array($field['input_type'], ['text', 'password']))
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
                                                    <input type="{{ $field['input_type'] }}" id="{{ $field['key'] }}"
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