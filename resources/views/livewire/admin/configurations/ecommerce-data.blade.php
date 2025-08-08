<div>

    <div class="space-y-12 sm:space-y-16">
        <div>
            <section>
                <div class="space-y-12 sm:space-y-16">
                    <div>
                        <h2 class="text-base/7 font-semibold text-gray-900">
                            Información general
                        </h2>
                        <p class="mt-1 max-w-2xl text-sm/6 text-gray-600">
                            Datos relacionados a tu perfil de comercio y a tus medios de contacto
                        </p>

                        <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-4 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">

                            <div class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4 sm:py-6">
                                <label for="photo" class="block text-sm/6 font-medium text-gray-900">
                                    Logo <br>
                                    <small class="text-gray-500">
                                        Medidas recomendadas: 220x40
                                    </small>
                                </label>
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <div class="flex items-center gap-x-6">

                                        <img class="w-24 h-12 object-contain" 
                                        src="{{ $form->logo_preview }}" alt="Logo de comercio">

                                        <x-button wire:loading.remove wire:target="form.ecommerce_logo"
                                        wireModel="form.ecommerce_logo" 
                                        file name="ecommerce_logo" type="secondary">Cambiar</x-button>

                                        <div wire:loading wire:target="form.ecommerce_logo">
                                            <div class="flex items-center gap-3 font-semibold">
                                                <x-spinner spinnerclass="!w-5 !h-5" />
                                                Cargando...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-6 sm:items-center sm:gap-4 sm:py-6">
                                <label for="ecommerce_eslogan" class="block text-sm mb-2 sm:mb-0 
                                font-medium text-gray-900 sm:pt-1.5 sm:col-span-2">
                                    Color <br>
                                    <small class="text-gray-500">
                                        Seleccioná el color que identifique tu comercio
                                    </small>
                                </label>
                                <div x-data="{selected: $wire.form.selected_color}" class="flex items-center gap-3 flex-wrap sm:col-span-3">
                                    @foreach ($form->available_colors as $color)
                                        <label @click="selected = '{{ $color }}'" :class="selected === '{{ $color }}' ? 'ring ring-offset-1 ring-{{ $color }}-300' : ''"
                                            class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                            <input type="radio" name="selected_color" 
                                            wire:model.live='form.selected_color' value="{{ $color }}" class="sr-only">
                                            <span class="sr-only"> {{ $color }} </span>
                                            <span aria-hidden="true"
                                                class="h-8 w-8 bg-{{ $color }}-500 rounded-full border border-black border-opacity-10"></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-6 sm:items-center sm:gap-4 sm:py-6">
                                <label for="ecommerce_name" class="block text-sm mb-2 sm:mb-0 
                                font-medium text-gray-900 sm:pt-1.5 sm:col-span-2">Nombre del comercio</label>
                                <x-form-input icon="store" model="form.ecommerce_name" id="ecommerce_name" 
                                class="sm:col-span-4 md:col-span-3" />
                            </div>

                            <div class="sm:grid sm:grid-cols-6 sm:items-center sm:gap-4 sm:py-6">
                                <label for="ecommerce_eslogan" class="block text-sm mb-2 sm:mb-0 
                                font-medium text-gray-900 sm:pt-1.5 sm:col-span-2">
                                    Eslogan <br>
                                    <small class="text-gray-500">
                                        Tu eslogan o frase que te identifica
                                    </small>
                                </label>
                                <x-form-input icon="format_quote" model="form.ecommerce_eslogan" id="ecommerce_eslogan" 
                                class="sm:col-span-4 md:col-span-3" />
                            </div>

                            <div class="sm:grid sm:grid-cols-6 sm:items-center sm:gap-4 sm:py-6">
                                <label for="contact_email" class="block text-sm mb-2 sm:mb-0 
                                font-medium text-gray-900 sm:pt-1.5 sm:col-span-2">
                                    Email de contacto <br>
                                    <small class="text-gray-500">
                                        Usado para recibir consultas directas de clientes.
                                    </small>
                                </label>
                                <x-form-input icon="mail" model="form.contact_email" id="contact_email" 
                                class="sm:col-span-4 md:col-span-3" />
                            </div>

                            <div class="sm:grid sm:grid-cols-6 sm:items-center sm:gap-4 sm:py-6">
                                <label for="contact_whatsapp" class="block text-sm mb-2 sm:mb-0 
                                font-medium text-gray-900 sm:pt-1.5 sm:col-span-2">
                                    Whatsapp de contacto <br>
                                    <small class="text-gray-500">
                                        Usado para recibir consultas directas de clientes.
                                    </small>
                                </label>

                                <x-form-input icon="phone" type="number" model="form.contact_whatsapp" 
                                id="contact_whatsapp" class="sm:col-span-4 md:col-span-3"
                                placeholder="1122334455" />
                            </div>

                            <div class="sm:grid sm:grid-cols-6 sm:items-center sm:gap-4 sm:py-6">
                                <label for="whatsapp_button" class="block text-sm mb-2 sm:mb-0 
                                font-medium text-gray-900 sm:pt-1.5 sm:col-span-2">
                                    Habilitar botón de whatsapp <br>
                                    <small class="text-gray-500">
                                        Se mostrará en tu ecommerce para que tus clientes 
                                        puedan contactarte directamente.
                                    </small>
                                </label>

                                <div class="flex items-center gap-6">
                                    <x-switch wireModel="form.whatsapp_button" />
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-6 sm:items-center sm:gap-4 sm:py-6">
                                <label for="contact_phone" class="block text-sm mb-2 sm:mb-0 
                                font-medium text-gray-900 sm:pt-1.5 sm:col-span-2">
                                    Teléfono fijo de contacto <br>
                                    <small class="text-gray-500">
                                        Usado para recibir llamadas directas de clientes.
                                    </small>
                                </label>

                                <x-form-input icon="phone" type="number" model="form.contact_phone" 
                                id="contact_phone" class="sm:col-span-4 md:col-span-3"
                                placeholder="42909999" />
                            </div>

                            <div class="sm:grid sm:grid-cols-6 sm:items-center sm:gap-4 sm:py-6">
                                <label for="ecommerce_facebook" class="block text-sm mb-2 sm:mb-0 
                                font-medium text-gray-900 sm:pt-1.5 sm:col-span-2">Perfil de Facebook</label>
                                <x-form-input icon="link" type="url" model="form.ecommerce_facebook" 
                                id="ecommerce_facebook" class="sm:col-span-4 md:col-span-3"
                                placeholder="https://www.facebook.com/tuperfil" />
                            </div>

                            <div class="sm:grid sm:grid-cols-6 sm:items-center sm:gap-4 sm:py-6">
                                <label for="ecommerce_instagram" class="block text-sm mb-2 sm:mb-0 
                                font-medium text-gray-900 sm:pt-1.5 sm:col-span-2">Perfil de Instagram</label>
                                <x-form-input icon="link" type="url" model="form.ecommerce_instagram" 
                                id="ecommerce_instagram" class="sm:col-span-4 md:col-span-3"
                                placeholder="https://www.instagram.com/tuperfil" />
                            </div>

                            <div class="sm:grid sm:grid-cols-6 sm:items-center sm:gap-4 sm:py-6">
                                <label for="ecommerce_tiktok" class="block text-sm mb-2 sm:mb-0 
                                font-medium text-gray-900 sm:pt-1.5 sm:col-span-2">Perfil de TikTok</label>
                                <x-form-input icon="link" type="url" model="form.ecommerce_tiktok" 
                                id="ecommerce_tiktok" class="sm:col-span-4 md:col-span-3"
                                placeholder="https://www.tiktok.com/tuperfil" />
                            </div>

                            <div class="sm:grid sm:grid-cols-6 sm:items-center sm:gap-4 sm:py-6">
                                <label for="ecommerce_youtube" class="block text-sm mb-2 sm:mb-0 
                                font-medium text-gray-900 sm:pt-1.5 sm:col-span-2">Canal de Youtube</label>
                                <x-form-input icon="link" type="url" model="form.ecommerce_youtube" 
                                id="ecommerce_youtube" class="sm:col-span-4 md:col-span-3" 
                                placeholder="https://www.youtube.com/tucanal" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="mt-6 mb-8 flex items-center justify-between flex-wrap gap-x-6 gap-y-3">

        <x-button size="large" wire:click='save'
        wire:loading.remove wire:target='save'>
            Guardar cambios
        </x-button>

        @if ($errors->any())
            <div class="flex items-center gap-2 text-red-500 text-xs">
                <x-icon code="error" />
                Por favor, corrige los errores antes de guardar
            </div>
        @endif

        <div wire:loading wire:target='save'>
            <div class="flex items-center gap-3 font-semibold">
                <x-spinner spinnerclass="!w-5 !h-5" />
                Guardando...
            </div>
        </div>
    </div>
</div>
