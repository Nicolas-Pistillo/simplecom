<div class="space-y-4 sm:col-span-3 sm:space-y-6">

    <h4 class="font-semibold">Facturar a</h4>

    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

        <div class="w-full">
            <label for="invoice_social_reason" class="block mb-2 text-sm 
            font-medium text-gray-900">
                Razón Social
            </label>
            <input type="text" id="invoice_social_reason"
            wire:model.blur='form.social_reason' 
            class="bg-gray-50 border border-gray-300 
            text-gray-900 text-sm rounded-lg focus:ring-primary-600 
            focus:border-primary-600 block w-full p-2.5" placeholder="Ej. Fulanito Díaz">

            @error('form.social_reason')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div class="w-full">
            <label for="invoice_document" class="block mb-2 text-sm font-medium text-gray-900">
                DNI/CUIT
            </label>
            <input type="number" id="invoice_document" 
            wire:model.blur='form.document'
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">

            @error('form.document')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="invoice_tax_condition" class="block mb-2 text-sm 
            font-medium text-gray-900">
                Condición Fiscal
            </label>

            <select id="invoice_tax_condition" 
            wire:model.live='form.tax_condition'
            class="block w-full p-2.5 bg-gray-50 border border-gray-300 
            text-gray-900 text-sm rounded-lg focus:ring-primary-500 
            focus:border-primary-500">
                @foreach (TaxCondition::cases() as $taxCondition)
                    <option value="{{ $taxCondition }}">{{ $taxCondition->name() }}</option>
                @endforeach
            </select>

            @error('form.tax_condition')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="invoice_address" class="block mb-2 text-sm font-medium text-gray-900">
                Domicilio Fiscal
            </label>

            <input id="invoice_address" type="text" 
            wire:model.blur='form.address'
            class="bg-gray-50 border 
            border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
            focus:border-primary-600 block w-full p-2.5" placeholder="Ej. Cabildo 300">

            @error('form.address')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div class="w-full">
            <label for="invoice_phone" class="block mb-2 text-sm font-medium text-gray-900">
                Teléfono
            </label>

            <input id="invoice_phone" type="text" 
            wire:model.blur='form.phone'
            class="bg-gray-50 border border-gray-300 
            text-gray-900 text-sm rounded-lg focus:ring-primary-600 
            focus:border-primary-600 block w-full p-2.5" placeholder="112345678">

            @error('form.phone')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div class="w-full">
            <label for="invoice_email" class="block mb-2 text-sm font-medium text-gray-900">
                Email
            </label>

            <input id="invoice_email" type="text" 
            wire:model.blur='form.email'
            class="bg-gray-50 border border-gray-300 
            text-gray-900 text-sm rounded-lg focus:ring-primary-600 
            focus:border-primary-600 block w-full p-2.5" placeholder="Ej. fulanito@gmail.com">

            @error('form.email')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-span-full">

            <label class="flex items-center mb-2 text-sm 
            font-medium text-gray-900 gap-1">
                Enviar comprobante por mail
                <x-icon code="help" class="text-blue-600 cursor-help" 
                x-tooltip.raw="Marcá esta casilla si querés que el cliente reciba
                la factura por email una vez que se emita" 
                style="font-size: 20px"
                />
            </label>

            <x-switch wireModel="form.send_to_client" />
        </div>
    </div>
</div>