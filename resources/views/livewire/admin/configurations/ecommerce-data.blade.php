<div>

    <div class="space-y-12 sm:space-y-16">

        {{-- @dump($configurations) --}}

        <div>
            <h2 class="text-base font-semibold leading-7 text-gray-900">
                {{ config('config_topics.ecommerce_data.title') }}
            </h2>

            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-600">
                {{ config('config_topics.ecommerce_data.description') }}
            </p>

            <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">

                {{-- Ecommerce logo --}}
                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">

                    <label for="ecommerce_logo" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">
                        Logo
                        <h5 class="text-xs text-gray-500">Medidas recomendadas: 270 x 100</h5>
                    </label>

                    <div class="mt-2 sm:col-span-2 sm:mt-0">

                        <div class="flex items-center">
                            <img src="{{ Storage::url(tenant('logo_url')) }}" alt="ecommerce logo"
                            class="h-16 w-56 object-contain">

                            <x-button wire:model='ecommerce_logo' type="secondary" class="ml-3" 
                            file onlyImages name="ecommerce_logo">
                                Cambiar
                            </x-button>
                        </div>

                        @error('ecommerce_logo')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror

                    </div>
                </div>

                {{-- Whatsapp Phone --}}
                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:pt-6 sm:pb-3">
                    <label for="whatsapp" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">
                        Número de whatsapp
                        <h5 class="text-xs text-gray-500">Whatsapp para consultas directas de clientes</h5>
                    </label>

                    <div class="mt-2 sm:col-span-2 sm:mt-0">

                        <div class="flex items-center gap-3 flex-wrap">
                            <input id="whatsapp"
                            wire:model.blur="contact_whatsapp"
                            type="number" 
                            autocomplete="off"
                            class="block w-[320px] rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset placeholder:text-gray-400
                            focus:ring-2 focus:ring-inset focus:ring-blue-600 
                            sm:text-sm sm:leading-6 sm:max-w-md ring-gray-300">      
                            
                            <x-button type="secondary" class="flex items-center" blank
                            href="https://api.whatsapp.com/send?phone={{ $contact_whatsapp }}">
                                <x-icon code="link" class="mr-1" />
                                Probar link
                            </x-button>
                        </div>

                        @error('contact_whatsapp')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @else
                            <small class="text-gray-500 text-xs">Tal cual como figura en WhatsApp, no agregues el "+".</small>
                        @enderror
                    </div>
                </div>

                @foreach ($configurations as $config)
                    <div wire:key='{{ $config->id }}' class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4 sm:py-6">
                        <label for="{{ $config->key }}" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">
                            {{ $config->display_name }} 
                            @if ($config->required) <sup class="text-red-500">*</sup> @endif
                            <h5 class="text-xs text-gray-500">{{ $config->description }}</h5>
                        </label>

                        <div class="relative mt-2 sm:col-span-2 sm:mt-0">
                            @if (in_array($config->input_type, ['text', 'url', 'number', 'email']))
                                <input 
                                id="{{ $config->key }}"
                                wire:model.blur="{{ $config->key }}"
                                value="{{ $config->value }}"
                                type="{{ $config->input_type }}" 
                                autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                                shadow-sm ring-1 ring-inset placeholder:text-gray-400
                                focus:ring-2 focus:ring-inset focus:ring-blue-600 
                                sm:text-sm sm:leading-6 sm:max-w-md ring-gray-300">

                                @error($config->key)
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            @endif

                            @if ($config->input_type == 'boolean')
                                <x-switch wireModel="{{ $config->key }}" :checked="$config->value" />
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-6 mb-8 flex items-center justify-start gap-x-6">
        <x-button size="large" wire:click='save'>Guardar cambios</x-button>
    </div>

</div>
