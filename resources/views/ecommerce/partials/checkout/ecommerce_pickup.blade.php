<div class="col-span-full animate__animated animate__fadeIn">
    <h4 class="text-sm/6 font-semibold text-gray-900">Elija un punto de retiro</h4>
</div>

<fieldset class="col-span-full rounded-lg overflow-hidden max-w-xl
border shadow-sm animate__animated animate__fadeIn" aria-label="Shipping Rates">
    <div class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
        <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
            <input type="radio" name="shipping_method"
                class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
            text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
            active:ring-offset-2">
            <div class="ml-3 flex items-center justify-between w-full">
                <div class="flex items-center text-sm">
                    <div
                        class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                        <x-icon code="location_on" class="text-gray-600" />
                    </div>
                    <div>
                        <h5 class="font-medium mb-0.5 text-xs sm:text-sm">Av. Ramos Mejía 14450 esquina
                            Plaza Constitución</h5>
                    </div>
                </div>
                <div>
                    <span class="text-sm font-medium ml-4">${{ priceFormat(2500.99) }}</span>
                </div>
            </div>
        </label>
    </div>
    <div class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
        <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
            <input type="radio" name="shipping_method"
                class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
            text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
            active:ring-offset-2">
            <div class="ml-3 flex items-center justify-between w-full">
                <div class="flex items-center text-sm">
                    <div
                        class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                        <x-icon code="location_on" class="text-gray-600" />
                    </div>
                    <div>
                        <h5 class="font-medium mb-0.5 text-xs sm:text-sm">Coronel Lynch 2003 - Barrio Nuevo
                            CABA</h5>
                    </div>
                </div>
                <div>
                    <span class="text-sm font-medium text-green-700 ml-4">Gratis</span>
                </div>
            </div>
        </label>
    </div>
    <div class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
        <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
            <input type="radio" name="shipping_method"
                class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
            text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
            active:ring-offset-2">
            <div class="ml-3 flex items-center justify-between w-full">
                <div class="flex items-center text-sm">
                    <div
                        class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                        <x-icon code="location_on" class="text-gray-600" />
                    </div>
                    <div>
                        <h5 class="font-medium mb-0.5 text-xs sm:text-sm">Calle 156 2600 - Berazategui Oeste
                            Esq. Piñeiro</h5>
                    </div>
                </div>
                <div>
                    <x-button type="soft" href="https://maps.app.goo.gl/PgTffHG1nW5wjJXr6" blank
                        class="ml-4 text-xs flex items-center">
                        <x-icon code="moved_location" class="mr-1" /> Ver
                    </x-button>
                </div>
            </div>
        </label>
    </div>
</fieldset>

<div class="flex items-center gap-3 mt-8">

    <x-button wire:click='setStep(1)' type="soft" :disabled="false" size="big" class="!shadow">
        Volver
    </x-button>

    <x-button wire:click='setStep(3)' :disabled="false" size="big">
        Continuar
    </x-button>
</div>