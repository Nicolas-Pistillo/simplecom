<div x-on:close-edit-information.window="open = false">
    <h2 class="text-base/7 font-semibold text-gray-900">Datos personales</h2>

    <p class="mt-1 text-sm/6 text-gray-500">
        Esta información se usara para identificarte al momento de retirar un pedido
        o generar el envío del mismo.
    </p>

    <dl class="mt-6 divide-y divide-gray-100 border-t border-gray-200 text-sm/6">
        <div class="py-6 sm:flex">
            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                Nombre completo
            </dt>
            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                <h6 class="text-gray-900">{{ Auth::user()->full_name }}</h6>
            </dd>
        </div>
        <div class="py-6 sm:flex">
            <dt class="font-medium text-gray-500 sm:w-64 sm:flex-none sm:pr-6">
                Email
                <sup>
                    <x-icon code="lock" class="text-[16px] text-blue-600"
                        x-tooltip.raw="Por razones de seguridad, el email no se puede modificar" />
                </sup>
            </dt>
            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                <h6 class="text-gray-500">{{ Auth::user()->email }}</h6>
            </dd>
        </div>
        <div class="py-6 sm:flex">
            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                DNI
            </dt>
            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                <h6 class="text-gray-900">
                    {{ Auth::user()->document }}
                </h6>
            </dd>
        </div>
        <div class="py-6 sm:flex">
            <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">
                Teléfono
            </dt>
            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                <h6 class="text-gray-900">
                    {{ Auth::user()->phone }}
                </h6>
            </dd>
        </div>
    </dl>

    <div class="mt-6">
        <x-button @click="open = true" size="big">Modificar</x-button>
    </div>

    <x-drawer ref="open">
        <div class="h-full">
            <section class="h-full flex flex-col justify-between">

                <div class="mb-3">

                    <h3 class="text-lg text-gray-700 font-semibold mb-3">Editar información</h3>

                    <hr class="mb-6">

                    <div class="mb-6">
                        <label for="customer_name" class="block text-sm font-semibold leading-6 text-gray-500">
                            Nombre
                        </label>
                        <div class="mt-2">
                            <input id="customer_name" type="text" wire:model.blur='name' autocomplete="off"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                            focus:ring-2 focus:ring-inset transition duration-300 
                            focus:ring-blue-600  sm:text-sm sm:leading-6">
                        </div>
                        @error('name')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="customer_lastname" class="block text-sm font-semibold leading-6 text-gray-500">
                            Apellido
                        </label>
                        <div class="mt-2">
                            <input id="customer_lastname" type="text" wire:model.blur='lastname' autocomplete="off"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                            focus:ring-2 focus:ring-inset transition duration-300 
                            focus:ring-blue-600  sm:text-sm sm:leading-6">
                        </div>
                        @error('lastname')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="customer_document" class="block text-sm font-semibold 
                        leading-6 text-gray-500">
                            DNI
                        </label>
                        <div class="mt-2">
                            <input id="customer_document" type="text" wire:model.blur='document' autocomplete="off"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                            focus:ring-2 focus:ring-inset transition duration-300 
                            focus:ring-blue-600  sm:text-sm sm:leading-6">
                        </div>
                        @error('document')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="customer_phone" class="block text-sm font-semibold leading-6 text-gray-500">
                            Teléfono
                        </label>
                        <div class="mt-2">
                            <input type="text" id="customer_phone" wire:model.blur='phone' autocomplete="off"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                            focus:ring-2 focus:ring-inset transition duration-300 
                            focus:ring-blue-600  sm:text-sm sm:leading-6">
                        </div>
                        @error('phone')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center py-6">

                    <x-button wire:loading.remove wire:target='update' @click="open = false"
                    size="large" class="w-full mr-4" type="secondary">
                        Cancelar
                    </x-button>

                    <x-button wire:click='update' wire:loading.remove wire:target='update' size="large"
                    class="w-full">Guardar</x-button>

                    <x-spinner wire:loading wire:target='update' class="w-full" />
                </div>

            </section>
        </div>
    </x-drawer>
</div>
