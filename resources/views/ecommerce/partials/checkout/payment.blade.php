<div x-data x-init="window.scrollTo({ top: 0, behavior: 'smooth' })"
class="animate__animated animate__bounceInLeft grid grid-cols-12 gap-x-4 gap-y-3 items-end">

    <div class="col-span-full no-select">
        <legend class="text-sm/6 font-semibold text-gray-900">Medios de pago</legend>
        <p class="mt-1 text-sm/6 text-gray-600">Selecciona un medio de pago de tu preferencia</p>
    </div>

    <fieldset class="col-span-full rounded-lg overflow-hidden border shadow-sm" aria-label="Shipping Rates">
        <div class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
            <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
                <input type="radio" wire:model.live='payment_method' value="transfer" name="payment_method"
                class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                active:ring-offset-2">
                <div class="ml-3 flex items-center justify-between w-full">
                    <div class="flex items-center text-sm">
                        <div class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                            <x-icon code="location_on" class="text-gray-600" />
                        </div>
                        <div>
                            <h5 class="font-medium mb-0.5 text-xs sm:text-sm">Transferencia Bancaria</h5>
                        </div>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-green-700 ml-4"></span>
                    </div>
                </div>
            </label>
        </div>
        <div class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
            <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
                <input type="radio" wire:model.live='payment_method' value="modo" name="payment_method"
                class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                active:ring-offset-2">
                <div class="ml-3 flex items-center justify-between w-full">
                    <div class="flex items-center text-sm">
                        <div class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                            <x-icon code="location_on" class="text-gray-600" />
                        </div>
                        <div>
                            <h5 class="font-medium mb-0.5 text-xs sm:text-sm">MODO</h5>
                        </div>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-green-700 ml-4"></span>
                    </div>
                </div>
            </label>
        </div>
        <div class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
            <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
                <input type="radio" wire:model.live='payment_method' value="uala" name="payment_method"
                class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                active:ring-offset-2">
                <div class="ml-3 flex items-center justify-between w-full">
                    <div class="flex items-center text-sm">
                        <div class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                            <x-icon code="location_on" class="text-gray-600" />
                        </div>
                        <div>
                            <h5 class="font-medium mb-0.5 text-xs sm:text-sm">Ualá</h5>
                        </div>
                    </div>
                    <div>
                        
                    </div>
                </div>
            </label>
        </div>
    </fieldset>

    <h1 class="col-span-full"> {{ $payment_method }} </h1>

    <div class="col-span-full md:col-span-6 p-3 rounded-xl border border-gray-200 flex-col justify-start items-start gap-5 inline-flex mb-6">
        <h3 class="text-gray-900 text-xl font-medium leading-loose">Tus datos</h3>
        <div class="w-full flex-col justify-start items-start gap-3.5 flex">
            <div class="w-full flex-col justify-start items-start gap-3.5 flex">
                <div class="w-full justify-between items-center inline-flex">
                    <h6 class="text-gray-600 font-normal leading-8">Subtotal:</h6>
                    <h6 class="text-right text-gray-900 font-semibold leading-8">₹600.00</h6>
                </div>
                <div class="w-full justify-between items-center gap-6 inline-flex">
                    <h6 class="text-gray-600 font-normal leading-8">Delivery:</h6>
                    <h6 class="text-right text-gray-900 font-semibold leading-8">₹0.00</h6>
                </div>
            </div>
            <div class="w-full flex-col justify-start items-start gap-3.5 pt-3.5 flex border-t border-gray-200">
                <div class="w-full justify-between items-center gap-6 inline-flex">
                    <h6 class="text-gray-600 font-normal leading-8">Total:</h6>
                    <h6 class="text-right text-gray-900 font-semibold leading-8">₹600.00</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-full md:col-span-6 p-3 rounded-xl border border-gray-200 flex-col justify-start items-start gap-5 inline-flex mb-6">
        <h3 class="text-gray-900 text-xl font-medium leading-loose">Tus datos</h3>
        <div class="w-full flex-col justify-start items-start gap-3.5 flex">
            <div class="w-full flex-col justify-start items-start gap-3.5 flex">
                <div class="w-full justify-between items-center inline-flex">
                    <h6 class="text-gray-600 font-normal leading-8">Subtotal:</h6>
                    <h6 class="text-right text-gray-900 font-semibold leading-8">₹600.00</h6>
                </div>
                <div class="w-full justify-between items-center gap-6 inline-flex">
                    <h6 class="text-gray-600 font-normal leading-8">Delivery:</h6>
                    <h6 class="text-right text-gray-900 font-semibold leading-8">₹0.00</h6>
                </div>
            </div>
            <div class="w-full flex-col justify-start items-start gap-3.5 pt-3.5 flex border-t border-gray-200">
                <div class="w-full justify-between items-center gap-6 inline-flex">
                    <h6 class="text-gray-600 font-normal leading-8">Total:</h6>
                    <h6 class="text-right text-gray-900 font-semibold leading-8">₹600.00</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-full flex items-center gap-3">
        <x-button wire:click='setStep(2)' type="soft" :disabled="false" size="big" class="mt-8 !shadow">
            Volver
        </x-button>
        <x-button :disabled="false" size="big" class="mt-8">
            Confirmar
        </x-button>
    </div>

</div>