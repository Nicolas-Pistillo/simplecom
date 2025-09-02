<div x-data x-init="window.scrollTo({ top: 0, behavior: 'smooth' })"
class="animate__animated animate__bounceInLeft grid max-w-xl grid-cols-12 gap-x-4 gap-y-3 items-end">

    <div class="col-span-full no-select">
        <legend class="text-sm/6 font-semibold text-gray-900">Medios de pago</legend>
        <p class="mt-1 text-sm/6 text-gray-600">Seleccione un medio de pago</p>
    </div>

    {{-- Pament Methods Selection --}}
    <fieldset class="no-select col-span-full rounded-lg overflow-hidden border shadow-sm" aria-label="Shipping Rates">

        @foreach ($form->payment_methods as $method)
            <div wire:key='{{ $method->id }}'
                class="-space-y-px transition-colors duration-300
                {{ $form->selected_payment_method == $method->id ? 'bg-gray-100' : 'bg-white hover:bg-gray-50' }}">

                <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">

                    <input type="radio" wire:model.live='form.selected_payment_method' value="{{ $method->id }}"
                    name="payment_method" class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                    text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                    active:ring-offset-2">

                    <div class="ml-3 flex items-center justify-between w-full">

                        <div class="flex items-center text-sm">

                            <img src='{{ Storage::url("providers/$method->code.png") }}' alt="Payment provider logo"
                                class="w-10 h-10 rounded-xl mr-2 object-cover">

                            <div>
                                <h5 class="font-medium mb-0.5 text-xs sm:text-sm">{{ $method->checkout_name }}</h5>
                            </div>
                        </div>

                        {{-- <div>
                            <span class="text-sm font-medium text-green-700 ml-4">Gratis</span>
                        </div> --}}
                    </div>
                </label>
            </div>
        @endforeach
    </fieldset>

    <div class="no-select col-span-full flex items-center gap-3">

        <x-button wire:loading.remove wire:target='confirmOrder' wire:click='setStep(2)' type="soft"
            :disabled="false" size="big" class="mt-8 !shadow">
            Volver
        </x-button>

        <x-button wire:loading.remove wire:target='confirmOrder' wire:click='confirmOrder' size="big" class="mt-8"
            :disabled="!isset($form->selected_payment_method)">
            Confirmar
        </x-button>

        <div wire:loading wire:target='confirmOrder'>
            <x-button size="big" disabled class="mt-8 flex items-center gap-x-3">
                Procesando <x-spinner spinnerclass="!w-4 !h-4" />
            </x-button>
        </div>
    </div>

</div>

{{-- Frontend Checkouts section --}}
@script
    <script>
        Livewire.on('modo-checkout', (event) => 
        {
            const intentionUrl = event[0].intention_url;
            const order = event[0].order;

            async function createPaymentIntention() 
            {
                const res = await fetch(intentionUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }
                });

                const jsonRes = await res.json();

                return {
                    checkoutId: jsonRes.id,
                    qrString: jsonRes.qr,
                    deeplink: jsonRes.deeplink,
                    returnUrl: jsonRes.return_url
                };
            }

            async function showModal() 
            {
                const modalData = await createPaymentIntention();

                var modalObject = {
                    qrString: modalData.qrString,
                    checkoutId: modalData.checkoutId,
                    deeplink: {
                        url: modalData.deeplink,
                        callbackURL: modalData.returnUrl,
                        callbackURLSuccess: modalData.returnUrl
                    },
                    callbackURL: modalData.returnUrl,
                    refreshData: createPaymentIntention,
                    onCancel: function() {
                        $wire.dispatch('cancel-frontend-checkout', {order: order.id});
                    },
                    onClose: function() {
                        $wire.dispatch('cancel-frontend-checkout', {order: order.id});
                    },
                }

                ModoSDK.modoInitPayment(modalObject);
            }

            showModal();
        });
    </script>
@endscript
