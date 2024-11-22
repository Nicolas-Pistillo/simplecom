<div x-data x-init="window.scrollTo({ top: 0, behavior: 'smooth' })"
class="animate__animated animate__bounceInLeft grid grid-cols-12 gap-x-4 gap-y-3 items-end">

    <fieldset class="col-span-full no-select">
        <legend class="text-sm/6 font-semibold text-gray-900">Medios de pago</legend>
        <p class="mt-1 text-sm/6 text-gray-600">Selecciona un medio de pago de tu preferencia</p>
    </fieldset>

    <x-button wire:click="selectedPaymentMethod('modo')" class="col-span-full">Pagar con MODO</x-button>

    {{-- <x-radio-group>
        <x-radio-group-option wire:click="selectedPaymentMethod('mercadopago')" name="payment_method" value="1" title="MERCADOPAGO" icon="credit_card" description="Todas las formas disponibles" />
        <x-radio-group-option wire:click="selectedPaymentMethod('mobbex')" name="payment_method" value="1" title="MOBBEX" icon="credit_card" description="Viene con GOCuotas" />
        <x-radio-group-option wire:click="selectedPaymentMethod('modo')" name="payment_method" value="1" title="MODO" icon="credit_card" description="Paga con QR" />
    </x-radio-group> --}}

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