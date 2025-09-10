<div>
    <div class="px-4 sm:px-6 lg:px-8">

        <nav class="flex mb-4 no-select">
            <ol role="list" class="flex space-x-4 rounded-md bg-white px-6 py-0 sm:py-1 
            shadow text-xs sm:text-sm">
                <li class="flex">
                    <div class="flex items-center">
                        <a href="{{ route('admin.contents.index') }}"
                            class="font-medium text-gray-500 hover:text-blue-700">
                            Contenidos
                        </a>
                    </div>
                </li>
                <li class="flex">
                    <div class="flex items-center">
                        <svg viewBox="0 0 24 44" fill="currentColor" class="h-full w-4 shrink-0 text-gray-300">
                            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                        </svg>
                        <span class="ml-4 font-medium whitespace-nowrap">
                            Mensaje Promocional
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    Mensaje Promocional
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    Este mensaje se mostrará en la parte superior de tu tienda con el 
                    objetivo de captar la atención e incentivar a tus clientes a comprar. 
                    Este puede ser, por ejemplo, un aviso de oferta, envío gratis u ofrecimiento 
                    de cuotas sin interés.
                </p>
            </div>
        </div>

        <x-form-input liveModel="message" label="Mensaje" class="mb-4"
        placeholder="Escribe aqui el mensaje" />

        @if (!empty($message))
            <h4 class="text-sm font-semibold mb-2">Vista previa</h4>

            <div class="w-full bg-black text-white overflow-hidden">
                <div class="text-center py-1 sm:py-2">
                    <div class="w-full animate-infinite-scroll inline-flex flex-nowrap 
                    items-center justify-center gap-x-6">
                        @for ($i = 0; $i < 15; $i++)
                            <h4 class="whitespace-nowrap text-xs sm:text-base">
                                {{ $message }}
                            </h4>
                        @endfor
                    </div>
                </div>
            </div>
        @endif

        <x-button wire:click='delete' size="large" type="secondary">
            Eliminar
        </x-button>

        <x-button wire:click='save' size="large" class="mt-4">Guardar</x-button>

    </div>
</div>
