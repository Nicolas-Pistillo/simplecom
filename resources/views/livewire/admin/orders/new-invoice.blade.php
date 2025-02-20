<div>
    <div id="invoice-header" class="bg-blue-600 px-4 py-6 sm:px-6">
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

    <div id="invoice-form-panel" class="flex flex-col justify-between h-[89vh]"
    x-on:service-errors-received.window="document.getElementById('invoice-header').scrollIntoView({ behavior: 'smooth' })">

        @error('service_errors')
            <x-alert color="red" icon="error" title="Error al generar la factura"
            class="max-w-none rounded-none sm:rounded-md sm:m-6" dismissible>

                <span class="text-xs">El servicio respondió lo siguiente:</span>

                <ul class="mt-3 text-xs text-red-500">
                    @foreach($errors->get('service_errors') as $error)
                        <li>
                            <span class="inline-block w-2 h-2 rounded-full bg-red-500"></span> 
                            <span>{{ $error }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-alert>
        @enderror

        <div class="px-4 py-6 sm:px-6 grid gap-4 sm:grid-cols-3 sm:gap-6">

            {{-- Invoice Parameters --}}
            @include('admin.orders.partials.invoice-form.parameters')

            {{-- Customer Data --}}
            @include('admin.orders.partials.invoice-form.customer')

            {{-- Invoice Items --}}
            @include('admin.orders.partials.invoice-form.items')
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
                        wire:model.live='form.bonification'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
                        rounded-lg ps-8 p-2.5 focus:ring-blue-500 focus:border-blue-500 
                        block w-full sm:w-[200px]">
                    </div>
    
                    @error("form.bonification")
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="w-full space-y-4 sm:space-y-6">
                <div class="w-full p-6 border border-gray-200 flex-col justify-start 
                items-start gap-4 flex rounded-xl">

                    <div class="w-full pb-6 border-b border-gray-200 flex-col 
                    justify-start items-start gap-3 flex">
                        <div class="w-full justify-between items-start gap-6 inline-flex">
                            <h5 class="text-gray-600 leading-8">Subtotal</h5>
                            <h4 class="text-right text-gray-900 font-semibold leading-loose">
                                ${{ priceFormat($this->subtotal) }}
                            </h4>
                        </div>
                        <div class="w-full justify-between items-start gap-6 inline-flex">
                            <h5 class="text-gray-600 leading-8">Descuentos</h5>
                            <h4 class="text-right text-gray-900 font-semibold leading-loose">
                                @if ($this->discounts > 0)
                                    -$ {{ priceFormat($this->discounts) }}
                                @else
                                    -
                                @endif
                            </h4>
                        </div>
                        <div class="w-full justify-between items-start gap-6 inline-flex">
                            <h5 class="text-gray-600 leading-8">IVA</h5>
                            <h4 class="text-right text-gray-900 font-semibold leading-loose">
                                @if ($this->total_iva > 0)
                                    ${{ priceFormat($this->total_iva) }}
                                @else
                                    -
                                @endif
                            </h4>
                        </div>
                        <div class="w-full justify-between items-start gap-6 inline-flex">
                            <h5 class="text-gray-600 leading-8">Bonif. General</h5>
                            <h4 class="text-right text-gray-900 font-semibold leading-loose">
                                @if ($form->bonification > 0)
                                    -$ {{ priceFormat($form->bonification) }}
                                @else
                                    -
                                @endif
                            </h4>
                        </div>
                    </div>

                    <div class="w-full justify-between items-start gap-6 inline-flex">
                        <h4 class="text-gray-900 text-lg font-semibold leading-loose">Total</h4>
                        <h4 class="text-right text-gray-900 text-lg font-semibold leading-loose">
                            ${{ priceFormat($this->total) }}
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
                <x-button size="large" @click="showNewInvoice = false" 
                wire:loading.remove wire:target='save' type="secondary">Cancelar</x-button>

                <x-button wire:click='save' size="large"
                wire:loading.remove wire:target='save'>
                    Confirmar y facturar
                </x-button>

                <div wire:loading wire:target='save'>
                    <div class="flex items-center gap-3 mr-2 sm:mr-4">
                        <span class="font-semibold">Procesando</span>
                        <x-spinner />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
