<div>
    <div class="bg-blue-600 px-4 py-6 sm:px-6">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-semibold text-white" id="slide-over-title">
                Nueva factura
            </h2>
            <div class="ml-3 flex h-7 items-center">
                <x-icon @click="showNewInvoice = false" code="close" class="text-white cursor-pointer"
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
                        wire:model.blur='form.tax_condition'
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
                            Enviar comprobante al cliente
                            <x-icon code="help" class="text-blue-600 cursor-help" 
                            x-tooltip.raw="Se enviara el comprobante de factura al email 
                            del cliente una vez que se procese y se emita" 
                            style="font-size: 20px"
                            />
                        </label>

                        <x-switch wireModel="form.send_to_client" />
                    </div>
                </div>
            </div>

            {{-- Invoice Parameters --}}
            <div class="row-start-1 sm:row-start-auto space-y-4 sm:space-y-6">

                <h4 class="font-semibold">Parámetros</h4>

                <div>
                    <label for="invoice_internal_code"
                    class="block mb-2 text-sm font-medium text-gray-900">
                        Cod. de factura interno
                    </label>

                    <input type="text" id="invoice_internal_code"
                    wire:model.blur='form.internal_code'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="Ej. 789">

                    @error('form.internal_code')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="invoice_type" class="block mb-2 text-sm font-medium text-gray-900">
                        Tipo de factura
                    </label>

                    <select id="invoice_type" 
                    wire:model.blur='form.invoice_type'
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

            {{-- Invoice Items --}}
            <div class="col-span-full">

                <h4 class="font-semibold">Detalle</h4>

                @error('form.items')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror

                <ul role="list" class="font-medium text-gray-500">
                    
                    @foreach ($form->items as $key => $item)
                        <li wire:key='items.{{ $key }}'>

                            <div class="col-span-full relative my-2 py-3">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                    <div class="w-full mx-auto border-t border-gray-200"></div>
                                </div>
                            </div>

                            <div class="flex gap-4 py-2 text-xs flex-wrap">

                                <div class="w-full sm:w-auto">
                                    <label for="invoice_item.{{ $key }}.code"
                                    class="block mb-2 text-xs font-medium text-gray-900">
                                        Código
                                    </label>
                
                                    <input type="text" id="invoice_item.{{ $key }}.code"
                                    wire:model.blur='form.items.{{ $key }}.code'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg 
                                    focus:ring-primary-500 focus:border-primary-500 block w-full sm:w-[80px] p-2.5">
                
                                    @error("form.items.$key.code")
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="w-full sm:w-auto">
                                    <label for="invoice_item.{{ $key }}.description"
                                    class="block mb-2 text-xs font-medium text-gray-900">
                                        Descripción
                                    </label>
                
                                    <input type="text" id="invoice_item.{{ $key }}.description"
                                    wire:model.blur='form.items.{{ $key }}.description'
                                    class="bg-gray-50 border border-gray-300 text-gray-900  text-xs rounded-lg 
                                    focus:ring-primary-500 focus:border-primary-500 block w-full sm:w-[340px] p-2.5">
                
                                    @error("form.items.$key.description")
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="w-full sm:w-auto">
                                    <label for="invoice_item.{{ $key }}.quantity"
                                    class="block mb-2 text-xs font-medium text-gray-900">
                                        Cantidad
                                    </label>
                
                                    <input type="number" id="invoice_item.{{ $key }}.quantity"
                                    wire:model.blur='form.items.{{ $key }}.quantity'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg 
                                    focus:ring-primary-500 focus:border-primary-500 block w-full sm:w-[80px] p-2.5">
                
                                    @error("form.items.$key.quantity")
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="w-full sm:w-auto">
                                    <label for="invoice_item.{{ $key }}.unit_price"
                                    class="block mb-2  text-xs font-medium text-gray-900">
                                        Precio unitario
                                    </label>
                
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 
                                        pointer-events-none text-gray-800">
                                            $
                                        </div>

                                        <input type="number" id="invoice_item.{{ $key }}.unit_price"
                                        wire:model.blur='form.items.{{ $key }}.unit_price'
                                        class="bg-gray-50 border border-gray-300 text-gray-900  text-xs rounded-lg 
                                        focus:ring-primary-500 focus:border-primary-500 block w-full ps-6 p-2.5">
                                    </div>
                                
                
                                    @error("form.items.$key.unit_price")
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="w-full sm:w-auto">
                                    <label class="block mb-2 text-xs font-medium text-gray-900"
                                    for="invoice_item.{{ $key }}.aliquot">
                                        IVA
                                    </label>
                
                                    <select wire:model.blur='form.items.{{ $key }}.aliquot'
                                    id="invoice_item.{{ $key }}.aliquot"
                                    class="bg-gray-50 border border-gray-300 
                                    text-gray-900 rounded-lg text-xs focus:ring-primary-500 
                                    focus:border-primary-500 block w-full p-2.5">
                                        @foreach (InvoiceItemAliquot::cases() as $aliquot)
                                            <option value="{{ $aliquot->value }}">{{ $aliquot->name() }}</option>
                                        @endforeach
                                    </select>
                
                                    @error("form.items.$key.aliquot")
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="w-full sm:w-auto">
                                    <label for="invoice_item.{{ $key }}.discount"
                                    class="block mb-2  text-xs font-medium text-gray-900">
                                        % Descuento
                                    </label>
                
                                    <input type="number" id="invoice_item.{{ $key }}.discount"
                                    wire:model.blur='form.items.{{ $key }}.discount'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg 
                                    focus:ring-primary-500 focus:border-primary-500 block w-full sm:w-[80px] p-2.5">
                
                                    @error("form.items.$key.discount")
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>

                                <x-icon code="delete" wire:click='removeItem({{ $key }})' 
                                class="text-red-500 mt-auto cursor-pointer" 
                                x-tooltip.raw="Eliminar item"
                                />

                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="flex items-end mt-3 mb-6">
                    <div wire:click='addItem' class="flex items-center text-blue-500 text-sm 
                    cursor-pointer transition duration-300 hover:shadow py-1 px-2 rounded-full border">
                        <x-icon code="add_circle" class="mr-1" />
                        Agregar item
                    </div>
                </div>
            </div>
        </div>

        <div class="px-4 pb-6 sm:px-6 flex flex-wrap sm:flex-nowrap gap-6">

            <div class="w-full sm:w-auto space-y-4 sm:space-y-6">

                <div class="w-full sm:w-auto">

                    <label for="bonification"
                    class="block mb-2  text-xs font-medium text-gray-900">
                        Bonificación general
                    </label>
    
                    <div class="relative">
    
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            $
                        </div>
    
                        <input type="number" id="bonification" 
                        wire:model.blur='form.bonification'
                        class="bg-gray-50 border 
                        border-gray-300 text-gray-900 text-sm rounded-lg ps-8 p-2.5
                        focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-[200px]">
                    </div>
    
                    @error("form.items.$key.bonification")
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="w-full space-y-4 sm:space-y-6">
                <div class="w-full p-6 border border-gray-200 flex-col justify-start 
                items-start gap-4 flex rounded-lg">

                    <div class="w-full pb-6 border-b border-gray-200 flex-col 
                    justify-start items-start gap-3 flex">
                        <div class="w-full justify-between items-start gap-6 inline-flex">
                            <h5 class="text-gray-600 leading-8">Subtotal</h5>
                            <h4 class="text-right text-gray-900 font-semibold leading-loose">
                                ${{ $this->subtotal }}
                            </h4>
                        </div>
                        <div class="w-full justify-between items-start gap-6 inline-flex">
                            <h5 class="text-gray-600 leading-8">IVA</h5>
                            <h4 class="text-right text-gray-900 font-semibold leading-loose">
                                ${{ $this->totalIva }}
                            </h4>
                        </div>
                        <div class="w-full justify-between items-start gap-6 inline-flex">
                            <h5 class="text-gray-600 leading-8">Descuentos</h5>
                            <h4 class="text-right text-gray-900 font-semibold leading-loose">
                                -$500.75
                            </h4>
                        </div>
                        <div class="w-full justify-between items-start gap-6 inline-flex">
                            <h5 class="text-gray-600 leading-8">Bon. General</h5>
                            <h4 class="text-right text-gray-900 font-semibold leading-loose">
                                -$80.00
                            </h4>
                        </div>
                    </div>

                    <div class="w-full justify-between items-start gap-6 inline-flex">
                        <h4 class="text-gray-900 text-lg font-semibold leading-loose">Total</h4>
                        <h4 class="text-right text-gray-900 text-lg font-semibold leading-loose">
                            ${{ $this->total }}
                        </h4>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex border-t justify-between gap-4 px-4 py-4 flex-wrap">
            <div>
                <span class="text-red-500 text-xs flex items-center">
                    @if ($errors->any())
                        <x-icon code="error" class="mr-1" /> Por favor revise los errores
                    @endif
                </span>
            </div>
            <div class="flex gap-4">
                <x-button size="large" @click="showNewInvoice = false" type="secondary">Cancelar</x-button>
                <x-button wire:click='save' size="large">Confirmar y facturar</x-button>
            </div>
        </div>
    </div>
</div>
