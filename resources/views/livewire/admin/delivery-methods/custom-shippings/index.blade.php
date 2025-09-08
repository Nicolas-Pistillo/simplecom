<div>
    <div class="px-4 sm:px-6 lg:px-8 mb-8">

        <div class="sm:flex sm:items-center mb-8">

            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    Envíos personalizados
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    Desde acá podrás configurar tus propias formas y condiciones de envío 
                    ya sea con un servicio de cadetería o logistica que no este integrado 
                    con simplecom o si vas a encargarte vos mismo de la entrega de tus pedidos.
                </p>
            </div>

            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button :href="route('admin.delivery-methods.custom-shippings.create')" 
                class="flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Nuevo envío propio
                </x-button>
            </div>
        </div>

        <div class="w-full mb-16">

            @if (!$origin_point)
                <x-alert class="mb-3" color="yellow" icon="warning" title="Sin puntos de origen activos">
                    Necesitas crear o asignar un
                    <span @click="current = 'Puntos de origen'" class="text-blue-600 hover:underline cursor-pointer">
                        punto de origen
                    </span>
                    para indicarle al proveedor desde donde cotizar y retirar tus pedidos
                </x-alert>
            @else
                <x-alert class="mb-3" color="blue" icon="where_to_vote">
                    <x-slot name="title">
                        Las cotizaciones y despachos se están realizando
                        desde <b>{{ $origin_point->name }}</b>
                    </x-slot>
                </x-alert>
            @endif
        </div>

        @if ($providers->isEmpty())
            <div class="text-center mx-auto">

                <img src="{{ URL::to('img/illustrations/delivery_truck.svg') }}" class="h-36 mx-auto"
                    alt="Sin envios propios">

                <div class="my-4">
                    <h3 class="text-sm font-semibold text-gray-900">
                        Todavía no añadiste envíos propios
                    </h3>
                    <p class="mt-1 mb-4 text-sm text-gray-500">
                        Agregá tus propias formas de envío cuando quieras
                    </p>
                </div>
            </div>
        @else
            @dump($providers)
        @endif
    </div>
</div>
