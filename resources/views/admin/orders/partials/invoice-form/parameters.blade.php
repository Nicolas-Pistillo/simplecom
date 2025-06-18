<div class="sm:col-span-3 space-y-4 sm:space-y-6">

    <h4 class="font-semibold">Parámetros</h4>

    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

        <div>
            <label for="invoice_type" class="block mb-2 text-sm font-medium text-gray-900">
                Tipo de factura
            </label>

            <select id="invoice_type" 
            wire:model.live='form.invoice_type'
            class="bg-gray-50 border border-gray-300 
            text-gray-900 text-sm rounded-lg focus:ring-primary-500 
            focus:border-primary-500 block w-full p-2.5">
                @foreach (InvoiceType::cases() as $invoiceType)
                    <option value="{{ $invoiceType }}">{{ $invoiceType->name() }}</option>
                @endforeach
            </select>

            @error('form.invoice_type')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div class="self-center">

            <label class="flex items-center mb-2 text-sm 
            font-medium text-gray-900 gap-1">

                Facturar en segundo plano

                <x-icon code="help" class="text-blue-600 cursor-help" 
                x-tooltip.raw="Se enviará la factura a la cola de facturación del proveedor
                y serás notificado cuando se haya procesado y emitido" 
                style="font-size: 20px"
                />
            </label>

            <x-switch wireModel="form.invoice_queued" />
        </div>

        <div>
            <label for="invoice_pay_condition" class="block mb-2 text-sm font-medium text-gray-900">
                Condición de pago
            </label>

            <select id="invoice_pay_condition" 
            wire:model.blur='form.pay_condition'
            class="bg-gray-50 border border-gray-300 
            text-gray-900 text-sm rounded-lg focus:ring-primary-500 
            focus:border-primary-500 block w-full p-2.5">
                @foreach (InvoicePayCondition::cases() as $payCondition)
                    <option value="{{ $payCondition->value }}">{{ $payCondition->name() }}</option>    
                @endforeach
            </select>

            @error('form.pay_condition')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <div>
            <label for="invoice_sector" class="block mb-2 text-sm font-medium text-gray-900">
                Rubro
            </label>

            <input id="invoice_sector" type="text" 
            wire:model.blur='form.sector'
            class="bg-gray-50 border border-gray-300 
            text-gray-900 text-sm rounded-lg focus:ring-primary-500 
            focus:border-primary-500 block w-full p-2.5"
            placeholder="Ej. Indumentaria y Calzado">

            @error('form.sector')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>