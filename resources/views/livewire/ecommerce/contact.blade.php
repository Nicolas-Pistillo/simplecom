<div>
    <div class="relative isolate overflow-x-hidden">
        <div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
            <div class="relative px-6 py-16 sm:py-28 lg:static lg:px-8 bg-gray-50">
                <div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
                    <h2 class="text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
                        Contactanos
                    </h2>
                    <p class="mt-6 sm:text-lg/8 text-gray-600">Proin volutpat consequat porttitor cras nullam gravida at. Orci
                        molestie a eu arcu. Sed ut tincidunt integer elementum id sem. Arcu sed malesuada et magna.</p>
                    <dl class="mt-10 space-y-4 text-base/7 text-gray-600">
                        <div class="flex gap-x-4 items-center">
                            <dt class="flex-none">
                                <img class="w-7 h-7" src="{{ URL::to('img/whatsapp-icon.svg') }}" alt="whatsapp logo">
                            </dt>
                            <dd><a class="hover:text-gray-900" href="tel:+1 (555) 234-5678">+1 (555) 234-5678</a></dd>
                        </div>
                        <div class="flex items-center gap-x-4">
                            <x-icon code="mail" />
                            <dd>
                                {{ tenant()->configValue('contact_email') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <section x-data method="POST" class="px-6 py-16 sm:py-28 bg-white lg:px-8 shadow-xl">
                <div class="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">

                    <h2 class="mb-8 text-xl font-semibold">Dejanos tu consulta</h2>

                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">

                        <x-form-input model="sender_name" label="Nombre Completo" />

                        <x-form-input model="sender_phone" type="number" label="Teléfono" />

                        <x-form-input model="sender_email" label="Email" class="sm:col-span-full" />
                        
                        <x-form-input model="subject" label="Asunto" class="sm:col-span-full" placeholder="¿Sobre qué trata tu consulta?" />

                        <div class="sm:col-span-full">
                            <label for="message" class="block mb-2 text-sm 
                            font-medium text-gray-900">
                                Consulta
                            </label>
                            <div class="w-full border rounded-lg bg-gray-50 border-gray-200">
                                <div class="p-3 bg-white rounded-lg">
                                    <textarea wire:model="message" id="message" rows="5"
                                    class="block w-full p-0 text-sm text-gray-800
                                    bg-white border-0 focus:ring-0" scrollbar-thin 
                                    placeholder="Escribe aquí tu consulta..."></textarea>
                                </div>
                            </div>

                            @error('message')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end">
                        <x-button size="large" wire:click='save' 
                        wire:loading.remove wire:target='save'>
                            Enviar consulta
                        </x-button>

                        <div wire:loading wire:target='save'>
                            <x-button size="large" 
                            disabled class="flex items-center gap-x-3">
                                <x-spinner spinnerclass="!w-4 !h-4" />
                                Enviando...
                            </x-button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
