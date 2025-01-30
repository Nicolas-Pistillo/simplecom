<div class="col-span-full animate__animated animate__fadeIn">
    <h4 class="text-sm/6 font-semibold text-gray-900">Elija un punto de retiro</h4>
</div>

<fieldset class="col-span-full rounded-lg overflow-hidden
border shadow-sm animate__animated animate__fadeIn" aria-label="Shipping Rates">

    @foreach ($form->store_pickups as $storePickup)
        <div wire:key='{{ $storePickup->id }}' 
        class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
            <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
                <input type="radio" name="store_pickup" value="{{ $storePickup->id }}"
                wire:model.live='form.selected_store_pickup'
                class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                active:ring-offset-2">
                <div class="ml-3 flex items-center justify-between w-full">
                    <div class="flex items-center text-sm">
                        <div
                            class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                            <x-icon code="storefront" class="text-gray-600" />
                        </div>
                        <div class="flex flex-col">
                            <h5 class="font-medium mb-0.5 text-xs sm:text-sm">
                                {{ $storePickup->name }}
                            </h5>

                            <small class="flex gap-1">
                                <x-icon class="text-sm" code="location_on" />
                                {{ $storePickup->address }}
                            </small>

                            <small class="hidden sm:flex gap-1">
                                <x-icon class="text-sm" code="schedule" />
                                {{ $storePickup->schedule }}
                            </small>
                        </div>
                    </div>
                    {{-- <div>
                        <x-button type="soft" href="{{ $storePickup->mapUrl() }}" blank
                            class="ml-4 text-xs flex items-center">
                            <x-icon code="moved_location" class="mr-1" /> Ver
                        </x-button>
                    </div> --}}
                </div>
            </label>
        </div>
    @endforeach
</fieldset>

<div class="flex items-center gap-3 mt-8">

    <x-button wire:click='setStep(1)' type="soft" :disabled="false" size="big" class="!shadow">
        Volver
    </x-button>

    <x-button wire:click='setStep(3)' :disabled="false" size="big">
        Continuar
    </x-button>
</div>