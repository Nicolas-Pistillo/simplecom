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
                        wire:model.live='form.items.{{ $key }}.quantity'
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
                            wire:model.live='form.items.{{ $key }}.unit_price'
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
    
                        <select wire:model.live='form.items.{{ $key }}.aliquot'
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
                        wire:model.live='form.items.{{ $key }}.discount'
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