<div>
    <section id="form" class="py-24">

        @if (!$sended)
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div
                    class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-5">
                    <div class="col-span-2">
                        <h2 class="text-base/7 font-semibold text-blue-600">
                            Abrir tienda
                        </h2>
                        <p class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900">
                            Empezá hoy
                        </p>
                        <p class="mt-6 text-base/7 text-gray-700">
                            Completá los datos de tu comercio y de la persona que la administrará para comenzar
                            a gestionar tu alta.

                            <br> <br>

                            Tambien podes 
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=5491169755391&text=¡Hola!, quisiera saber mas acerca de su plataforma de e-commerce"
                            class="text-blue-600 underline">
                                enviarnos un mensaje
                            </a> para asesorarte mejor.
                        </p>
                    </div>
                    <div class="col-span-3 grid grid-cols-1 gap-x-8 gap-y-10 text-base/7 text-gray-600 lg:gap-y-16">
                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                            <x-form-input model="form.ecommerce_name" label="Nombre del comercio" class="sm:col-span-3" />

                            <x-form-input model="form.social_reason" label="Razón social" class="sm:col-span-3" />

                            <x-form-input model="form.invoice_document" label="CUIT - CUIL" class="sm:col-span-3" />

                            <div class="sm:col-span-3">
                                <label for="tax_condition" class="inline-block text-sm/6 font-medium text-gray-900">
                                    Condición fiscal
                                </label>

                                <div class="mt-2 grid grid-cols-1">
                                    <select id="tax_condition" wire:model.live='form.tax_condition'
                                    class="col-start-1 row-start-1 w-full 
                                    border-gray-300 focus:ring-0  appearance-none rounded-md 
                                    bg-transparent py-1.5 pl-3 pr-8 shadow-sm 
                                    text-gray-900 focus:border-transparent 
                                    focus:outline-blue-600 text-sm truncate">
                                        <option value="">Seleccionar opción</option>
                                        @foreach (TaxCondition::cases() as $taxCondition)
                                            <option value="{{ $taxCondition->value }}">
                                                {{ $taxCondition->name() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('form.tax_condition')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="sm:col-span-3">
                                <label for="sector" class="inline-block text-sm/6 font-medium 
                                text-gray-900">Rubro</label>
                                <div class="mt-2 grid grid-cols-1">
                                    <select id="sector" wire:model.live='form.sector'
                                    class="col-start-1 row-start-1 w-full 
                                    border-gray-300 focus:ring-0  appearance-none rounded-md 
                                    bg-transparent py-1.5 pl-3 pr-8 shadow-sm 
                                    text-gray-900 focus:border-transparent 
                                    focus:outline-blue-600 text-sm truncate">
                                        <option value="">Seleccionar opción</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{ $sector->id }}">
                                                {{ $sector->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('form.sector')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>

                            <x-form-input model="form.invoice_address" label="Domicilio fiscal" class="sm:col-span-3" />

                            <x-form-input model="form.operator_name" label="Nombre del administrador" class="sm:col-span-3"
                                helper="Administrador principal del panel de comercio" />

                            <x-form-input type="email" model="form.operator_email" label="Email del administrador" class="sm:col-span-3"
                                helper="Administrador principal del panel de comercio" />

                            <x-form-input type="number" model="form.operator_phone" label="Teléfono de contacto" class="sm:col-span-3" />

                            <div class="col-span-full">
                                <x-button wire:loading.remove wire:target='save' 
                                wire:click='save' size="large">Confirmar datos</x-button>

                                <div wire:loading wire:target='save'>
                                    <div class="flex items-center gap-x-3">
                                        <b>Espere...</b>
                                        <x-spinner />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div>
                <div class="block max-w-sm mx-auto p-6 border rounded-base shadow-md rounded-lg text-center">
                    <x-icon class="text-green-600 text-[36px]" code="check_circle" />
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-heading">
                        Recibimos tus datos
                    </h5>
                    <p class="mb-3 text-sm">
                        Muchas gracias por querer comenzar a vender con Simplecom, nos contactaremos a la brevedad
                        para gestionar el alta de tu tienda.
                    </p>
                </div>
            </div>
        @endif

    </section>
</div>
