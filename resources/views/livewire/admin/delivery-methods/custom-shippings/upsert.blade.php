<div>




    <x-button :href="route('admin.delivery-methods.custom-shippings.index')" type="secondary" class="inline-flex w-max h-max items-center mb-4">
        <x-icon code="arrow_back" class="mr-1" />
        Volver al listado
    </x-button>

    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:tracking-tight">
        Nuevo envío personalizado
    </h2>

    <div class="grid sm:grid-cols-12 gap-x-4 gap-y-6 mt-8">

        <x-form-input class="sm:col-span-6" label="Nombre de la opción" placeholder="Motomensajeria en CABA" />

        <fieldset class="col-span-full mb-3 no-select">
            <legend class="text-sm/6 font-semibold text-gray-900">Cobertura del envío</legend>
            <p class="mt-1 text-sm/6 text-gray-600">Hasta donde cubris las entregas con este método</p>

            <div class="mt-3 flex items-center flex-wrap gap-x-6 gap-y-4">

                <div class="flex items-center">
                    <input id="shipping_delivery" name="delivery_type" type="radio"
                        class="size-4 border-gray-300 text-blue-600 focus:ring-blue-600">
                    <label for="shipping_delivery" class="ml-3 block text-sm/6 font-medium text-gray-900">
                        Todo el país
                    </label>
                </div>

                <div class="flex items-center">
                    <input id="picking_delivery" name="delivery_type" type="radio"
                        class="size-4 border-gray-300 text-blue-600 focus:ring-blue-600">
                    <label for="picking_delivery" class="ml-3 no-select block text-sm/6 font-medium text-gray-900">
                        Por zona de envío
                    </label>
                </div>
            </div>
        </fieldset>

        <x-multi-select label="Zonas de envío" 
        title="Seleccionar zonas de envío" class="sm:col-span-6" />

    </div>

</div>
