<x-drawer ref="showConfirmInvoice" withoutClose panelClass="w-[50rem]" containerClasses="!p-0">

    <div class="bg-blue-600 px-4 py-6 sm:px-6">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-semibold text-white" id="slide-over-title">
                Nueva factura
            </h2>
            <div class="ml-3 flex h-7 items-center">
                <x-icon @click="showConfirmInvoice = false" code="close" class="text-white cursor-pointer"
                    x-tooltip.raw="Cerrar" />
            </div>
        </div>
        <div class="mt-1">
            <p class="text-sm text-white">
                Se generará una nueva factura asociada al pedido #{{ $order->id }}
            </p>
        </div>
    </div>

    <div class="flex flex-col justify-between h-[89vh]">

        {{-- <x-alert color="red" icon="error" class="max-w-none rounded-none sm:rounded-md sm:m-6" 
        title="Error al generar la factura">
            <ul class="mt-3 text-xs text-red-500">
                <li>
                    <span class="inline-block w-2 h-2 rounded-full bg-red-500"></span> 
                    <span>Ejemplo de un item de error</span>
                </li>
                <li>
                    <span class="inline-block w-2 h-2 rounded-full bg-red-500"></span> 
                    <span>Ejemplo de un item de error</span>
                </li>
                <li>
                    <span class="inline-block w-2 h-2 rounded-full bg-red-500"></span> 
                    <span>Ejemplo de un item de error</span>
                </li>
            </ul>
        </x-alert> --}}

        {{-- @dump($invoiceForm->all()) --}}

        <div class="px-4 py-6 sm:px-6 grid gap-4 sm:grid-cols-3 sm:gap-6">

            {{-- Invoice Data --}}
            <div class="space-y-4 sm:col-span-2 sm:space-y-6">

                <h4 class="font-semibold">Facturar a</h4>

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    <div class="w-full">
                        <label for="invoice_social_reason" class="block mb-2 text-sm 
                        font-medium text-gray-900">
                            Razón Social
                        </label>
                        <input type="text" id="invoice_social_reason"
                        wire:model.blur='invoiceForm.social_reason' 
                        class="bg-gray-50 border border-gray-300 
                        text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                        focus:border-primary-600 block w-full p-2.5" placeholder="Ej. Fulanito Díaz">

                        @error('invoiceForm.social_reason')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="invoice_document" class="block mb-2 text-sm font-medium text-gray-900">
                            DNI/CUIT
                        </label>
                        <input type="text" id="invoice_document" 
                        wire:model.blur='invoiceForm.document'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                        focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">

                        @error('invoiceForm.document')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="invoice_tax_condition" class="block mb-2 text-sm 
                        font-medium text-gray-900">
                            Condición Fiscal
                        </label>

                        <select id="invoice_tax_condition" 
                        wire:model.blur='invoiceForm.tax_condition'
                        class="block w-full p-2.5 bg-gray-50 border border-gray-300 
                        text-gray-900 text-sm rounded-lg focus:ring-primary-500 
                        focus:border-primary-500">
                            @foreach (TaxCondition::cases() as $taxCondition)
                                <option value="{{ $taxCondition }}">{{ $taxCondition->name() }}</option>
                            @endforeach
                        </select>

                        @error('invoiceForm.tax_condition')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="invoice_address" class="block mb-2 text-sm font-medium text-gray-900">
                            Domicilio Fiscal
                        </label>

                        <input id="invoice_address" type="text" 
                        wire:model.blur='invoiceForm.address'
                        class="bg-gray-50 border 
                        border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                        focus:border-primary-600 block w-full p-2.5" placeholder="Ej. Cabildo 300">

                        @error('invoiceForm.address')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="invoice_phone" class="block mb-2 text-sm font-medium text-gray-900">
                            Teléfono
                        </label>

                        <input id="invoice_phone" type="text" 
                        wire:model.blur='invoiceForm.phone'
                        class="bg-gray-50 border border-gray-300 
                        text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                        focus:border-primary-600 block w-full p-2.5" placeholder="112345678">

                        @error('invoiceForm.phone')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="invoice_email" class="block mb-2 text-sm font-medium text-gray-900">
                            Email
                        </label>

                        <input id="invoice_email" type="text" 
                        wire:model.blur='invoiceForm.email'
                        class="bg-gray-50 border border-gray-300 
                        text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                        focus:border-primary-600 block w-full p-2.5" placeholder="Ej. fulanito@gmail.com">

                        @error('invoiceForm.email')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-span-full">

                        <label class="flex items-center mb-2 text-sm 
                        font-medium text-gray-900 gap-1">
                            Enviar comprobante al cliente
                            <x-icon code="help" class="text-blue-600 cursor-help" 
                            x-tooltip.raw="Se enviara el comprobante de factura al email 
                            del cliente una vez que se procese y se emita" 
                            style="font-size: 20px"
                            />
                        </label>

                        <x-switch wireModel="invoiceForm.send_to_client" />
                    </div>
                </div>

                <h4 class="font-semibold">Detalle</h4>

                <ul role="list" class="divide-y divide-gray-200 border-t border-gray-200 text-sm font-medium text-gray-500">
                    @foreach ($order->items as $item)
                        <li wire:key='{{ $item->id }}' class="flex space-x-3 py-6 
                        items-center text-xs">
            
                            <img src="{{ $item->product->first_image }}" alt="Imagen producto"
                            class="hidden md:block h-10 w-10 flex-none rounded-md bg-gray-100 object-contain">
            
                            <div class="flex-auto space-y-1">
            
                                <h3 class="text-gray-900 line-clamp-2">
                                    {{ $item->product->name }} 
                                </h3>

                                @if ($item->variant && isset($item->variant->options))
                                    @foreach ($item->variant->options as $variantOption)
                                        <p class="text-gray-700">
                                            {{ $variantOption->attribute->name }}:
                                            {{ $variantOption->attributeValue->name }}
                                        </p>
                                    @endforeach
                                @endif
            
                                <p class="text-gray-700">
                                    Cantidad: {{ $item->quantity }}
                                </p>

                                <p class="text-gray-700">
                                    Unitario sin IVA: $491563.79
                                </p>

                                <p class="text-gray-700">
                                    Total: $798456.36
                                </p>
                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-gray-900">
                                    Alicuota
                                </label>
                                <select class="bg-gray-50 border border-gray-300 
                                text-gray-900 rounded-lg focus:ring-primary-500 
                                focus:border-primary-500 block w-max text-xs p-2.5">
                                    <option value="27">27%</option>
                                    <option value="21" selected>21%</option>
                                    <option value="10.5">10.5%</option>
                                    <option value="0">0%</option>
                                    <option value="-1">Exento</option>
                                </select>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Invoice Parameters --}}
            <div class="row-start-1 sm:row-start-auto space-y-4 sm:space-y-6">

                <h4 class="font-semibold">Parámetros</h4>

                <div>
                    <label for="invoice_internal_code"
                    class="block mb-2 text-sm font-medium text-gray-900">
                        Código interno
                    </label>

                    <input type="text" id="invoice_internal_code"
                    wire:model.blur='invoiceForm.internal_code'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="Ej. 789">

                    @error('invoiceForm.internal_code')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="invoice_type" class="block mb-2 text-sm font-medium text-gray-900 
                    dark:text-white">Tipo de factura</label>

                    <select id="invoice_type" 
                    wire:model.blur='invoiceForm.invoice_type'
                    class="bg-gray-50 border border-gray-300 
                    text-gray-900 text-sm rounded-lg focus:ring-primary-500 
                    focus:border-primary-500 block w-full p-2.5">
                        <option>Factura A</option>
                        <option>Factura B</option>
                        <option>Factura C</option>
                    </select>

                    @error('invoiceForm.invoice_type')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="invoice_pay_condition" class="block mb-2 text-sm font-medium text-gray-900">
                        Condición de pago
                    </label>

                    <select id="invoice_pay_condition" 
                    wire:model.blur='invoiceForm.pay_condition'
                    class="bg-gray-50 border border-gray-300 
                    text-gray-900 text-sm rounded-lg focus:ring-primary-500 
                    focus:border-primary-500 block w-full p-2.5">
                        <option>Contado</option>
                        <option>Cuenta corriente</option>
                        <option>Transferencia Bancaria</option>
                        <option>Tarjeta de crédito</option>
                        <option>Tarjeta de débito</option>
                        <option>Otros</option>
                    </select>

                    @error('invoiceForm.pay_condition')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="invoice_sector" class="block mb-2 text-sm font-medium text-gray-900">
                        Rubro
                    </label>

                    <input id="invoice_sector" type="text" 
                    wire:model.blur='invoiceForm.sector'
                    class="bg-gray-50 border border-gray-300 
                    text-gray-900 text-sm rounded-lg focus:ring-primary-500 
                    focus:border-primary-500 block w-full p-2.5"
                    placeholder="Ej. Indumentaria y Calzado">

                    @error('invoiceForm.sector')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex border-t justify-end gap-4 px-4 py-4">
            <x-button size="large" @click="showConfirmInvoice = false" type="secondary">Cancelar</x-button>
            <x-button wire:click='createInvoice' size="large">Confirmar y facturar</x-button>
        </div>
    </div>
</x-drawer>
