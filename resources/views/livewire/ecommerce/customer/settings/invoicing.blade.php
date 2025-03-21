<div x-on:close-edit-invoicing.window="open = false">
    <h2 class="text-base/7 font-semibold text-gray-900">Facturación</h2>

    <p class="mt-1 text-sm/6 text-gray-500">
        Se emitirán las facturas de tus pedidos con esta información.
    </p>

    <dl class="mt-6 divide-y divide-gray-100 border-t border-gray-200 text-sm/6">
        <div class="py-6 sm:flex">
            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                Condición fiscal
            </dt>
            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                <h6 class="text-gray-900">{{ Auth::user()->tax_condition?->name() }}</h6>
            </dd>
        </div>
        <div class="py-6 sm:flex">
            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                Razón social
            </dt>
            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                <h6 class="text-gray-900">
                    {{ Auth::user()->invoice_social_reason ?? Auth::user()->full_name }}
                </h6>
            </dd>
        </div>
        <div class="py-6 sm:flex">
            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                CUIT/DNI
            </dt>
            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                @if (TaxCondition::needsInvoiceA(!empty($this->tax_condition) ? $this->tax_condition : null))
                    <h6 class="text-gray-900">{{ Auth::user()->invoice_document }}</h6>
                @else
                    <h6 class="text-gray-900">{{ Auth::user()->document }}</h6>
                @endif
            </dd>
        </div>
        <div class="py-6 sm:flex">
            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                Domicilio fiscal
            </dt>
            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                <h6 class="text-gray-900">
                    {{ Auth::user()->invoice_address }}
                </h6>
            </dd>
        </div>
    </dl>

    <div class="mt-6">
        <x-button @click="open = true" size="big">Modificar</x-button>
    </div>

    <x-drawer ref="open">
        <div class="h-full">
            <form wire:submit='save' class="h-full flex flex-col justify-between">

                <div class="mb-3">

                    <h3 class="text-lg text-gray-700 font-semibold mb-3">Editar información</h3>

                    <hr class="mb-6">

                    <div class="mb-6">
                        <label for="tax_condition" class="block text-sm font-semibold 
                        leading-6 text-gray-500">
                            Condición fiscal
                        </label>
                        <div class="mt-2">
                            <select type="number" wire:model.live="tax_condition" 
                            id="tax_condition" class="block w-full rounded-md border-gray-300 shadow-sm
                            focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @foreach (TaxCondition::cases() as $tax_condition)
                                    <option value="{{ $tax_condition->value }}">
                                        {{ $tax_condition->name() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('tax_condition')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="invoice_social_reason" class="block text-sm font-semibold 
                        leading-6 text-gray-500">
                           Razón social
                        </label>
                        <div class="mt-2">
                            <input type="text" id="invoice_social_reason" 
                            wire:model.blur='invoice_social_reason' autocomplete="off"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                            focus:ring-2 focus:ring-inset transition duration-300 
                            focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('invoice_social_reason')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="invoice_address" class="block text-sm font-semibold 
                        leading-6 text-gray-500">
                            Domicilio fiscal
                        </label>
                        <div class="mt-2">
                            <input type="text" id="invoice_address" 
                            wire:model.blur='invoice_address' autocomplete="off"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                            focus:ring-2 focus:ring-inset transition duration-300 
                            focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('invoice_address')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>

                    @if(TaxCondition::needsInvoiceA(!empty($this->tax_condition) ? $this->tax_condition : null))
                        <div class="mb-6">
                            <label for="invoice_document" class="block text-sm font-semibold 
                            leading-6 text-gray-500">
                                CUIT
                            </label>
                            <div class="mt-2">
                                <input type="number" id="invoice_document" 
                                wire:model.blur='invoice_document' autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                                shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                                focus:ring-2 focus:ring-inset transition duration-300 
                                focus:ring-blue-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('invoice_document')
                                <small class="text-red-500"> {{ $message }} </small>
                            @else
                                <small class="text-gray-500">Sin espacios ni guiones</small>
                            @enderror
                        </div>
                    @endif
                </div>

                <div class="flex items-center py-6">

                    <x-button submit wire:loading.remove wire:target='save' size="large"
                    class="w-full mr-4">Guardar</x-button>

                    <x-spinner wire:loading wire:target='save' class="w-full" />

                    <x-button wire:loading.remove wire:target='save' size="large"
                    class="w-full" type="secondary">
                        Cancelar
                    </x-button>
                </div>

            </form>
        </div>
    </x-drawer>
</div>
