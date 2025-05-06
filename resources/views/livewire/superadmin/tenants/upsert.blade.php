<div>

    <div class="flex flex-col items-start sm:flex-row sm:items-center gap-y-4 gap-x-6 mb-12">
        <x-button :href="route('superadmin.tenants.index')" type="secondary" class="flex items-center gap-1.5">
            <x-icon code="arrow_back" />
            Ir al listado
        </x-button>
        <h2 class="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            {{ $tenant ? 'Editar Comercio' : 'Nuevo Comercio' }}
        </h2>
    </div>


    <form wire:submit='save'>
        <div class="space-y-12">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base/7 font-semibold text-gray-900">
                        Datos de facturación
                    </h2>
                    <p class="mt-1 text-sm/6 text-gray-600">
                        Información de la empresa o persona a la cual se le facturará el servicio
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    <x-form-input model="form.social_reason" class="sm:col-span-3" label="Razón social" />

                    <div class="sm:col-span-3">
                        <label for="tax_condition" class="inline-block text-sm/6 font-medium 
                        text-gray-900">Condición fiscal</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="tax_condition" wire:model.blur='form.tax_condition'
                            class="col-start-1 row-start-1 w-full 
                            border-gray-300 focus:ring-0  appearance-none rounded-md 
                            bg-transparent py-1.5 pl-3 pr-8 shadow-sm 
                            text-gray-900 focus:border-transparent 
                            focus:outline-blue-600 text-sm truncate">
                                <option value="">Seleccionar</option>
                                @foreach (TaxCondition::cases() as $taxCondition)
                                    <option value="{{ $taxCondition }}">{{ $taxCondition->name() }}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('form.tax_condition')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <x-form-input model="form.invoice_document" type="number" 
                    class="sm:col-span-3" label="CUIT - CUIL" />

                    <x-form-input model="form.invoice_address" class="sm:col-span-3" 
                    label="Domicilio fiscal" />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base/7 font-semibold text-gray-900">
                        Datos del comercio
                    </h2>
                    <p class="mt-1 text-sm/6 text-gray-600">
                        Información principal y de contacto para el comercio
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    <x-form-input model="form.ecommerce_name" class="sm:col-span-3" label="Nombre del comercio" />

                    @if (!$tenant)
                        <x-form-input model="form.operator_name" class="sm:col-span-3"
                        label="Nombre del administrador" helper="Administrador principal del panel de comercio" />
                    @endif

                    <x-form-input model="form.code" class="sm:col-span-3" label="Código único" 
                    helper="sin espacios ni guiones" :readonly="$tenant" />

                    <x-form-input model="form.domain" class="sm:col-span-3" label="Dominio"
                    helper="sin espacios ni puntos al final" />

                    <div class="sm:col-span-3">
                        <label for="sector" class="inline-block text-sm/6 font-medium 
                        text-gray-900">Rubro</label>

                        <div class="mt-2 grid grid-cols-1">
                            <select wire:model.blur='form.sector' id="sector"
                            class="col-start-1 row-start-1 w-full 
                            border-gray-300 focus:ring-0  appearance-none rounded-md 
                            bg-transparent py-1.5 pl-3 pr-8 text-base shadow-sm 
                            text-gray-900 focus:border-transparent 
                            focus:outline-blue-600 sm:text-sm/6 truncate">
                                <option value="">Seleccionar rubro</option>
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

                    <x-form-input model="form.email" class="sm:col-span-3" label="Email" 
                    helper="se usara para contacto interno y facturación" />
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <x-button wire:loading.remove wire:target='save' size="large" submit>Guardar</x-button>
            <div wire:loading wire:target='save'>
                <div class="flex items-center gap-3">
                    <b>Guardando...</b>
                    <x-spinner />
                </div>
            </div>
        </div>
    </form>
</div>
