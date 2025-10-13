<fieldset wire:loading.remove wire:target='selectAddress' 
class="col-span-full animate__animated animate__fadeIn">

    <legend class="text-sm/6 font-semibold text-gray-900">
        Seleccionar dirección de entrega
    </legend>
    
    <p class="mt-1 text-sm/6 text-gray-600">
        Elige o agrega una dirección para calcular el envío
    </p>

    {{-- User addresses selection --}}
    <fieldset class="mt-3 no-select col-span-full rounded-lg overflow-hidden 
    border shadow-sm" aria-label="User addresses">

        @foreach ($form->addresses as $address)
            <div wire:key='{{ $address->id }}' wire:click='selectAddress({{ $address->id }})'
                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="-space-y-px transition-colors duration-300 hover:bg-gray-100">

                <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">

                    <input type="radio" {{-- wire:model.live='form.selected_payment_method' value="{{ $method->id }}" --}} name="payment_method"
                        class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                    text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                    active:ring-offset-2">

                    <div class="ml-3 flex items-center justify-between w-full">

                        <div class="flex items-center text-sm">

                            <x-icon code="location_on" />

                            <div>
                                <h5 class="font-medium mb-0.5 text-xs sm:text-sm">
                                    {{ $address->summary }}
                                </h5>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <x-icon code="arrow_forward" class="text-gray-700" />
                        </div>
                    </div>
                </label>
            </div>
        @endforeach

        <div @click="$dispatch('open-new-address-panel')" class="-space-y-px transition-colors duration-300 hover:bg-gray-100">
            <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
                <div class="flex items-center justify-between w-full">

                    <div class="flex items-center text-sm text-blue-600">

                        <x-icon code="add_circle" class="mr-2" />

                        <div>
                            <h5 class="font-medium mb-0.5 text-xs sm:text-sm">
                                Agregar nueva dirección
                            </h5>
                        </div>
                    </div>
                </div>
            </label>
        </div>
    </fieldset>
</fieldset>

<div wire:loading.remove wire:target='selectAddress' class="flex items-center gap-3 mt-8">

    <x-button wire:click='setStep(1)' type="soft" size="big" class="!shadow">
        Volver
    </x-button>
</div>
