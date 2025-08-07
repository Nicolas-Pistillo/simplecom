<div>
    <div x-data="{faqsPanelOpen: false}" class="px-4 sm:px-6 lg:px-8">

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
                            Preguntas Frecuentes
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="sm:flex sm:items-center mb-10">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    Preguntas Frecuentes
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    Este mensaje se mostrará en la parte superior de tu tienda con el
                    objetivo de captar la atención e incentivar a tus clientes a comprar.
                    Este puede ser, por ejemplo, un aviso de oferta, descuento u ofrecimiento
                    de cuotas sin interés.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button wire:click='openNew' @click="faqsPanelOpen = true" class="flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Agregar pregunta
                </x-button>
            </div>
        </div>

        <x-modal large ref="faqsPanelOpen" class="w-full" bodyClass="flex-1 mr-4" 
        title="Nueva pregunta">

            <x-form-input label="Pregunta" class="my-4" placeholder="¿Sobre que trata esta pregunta?" />

            <div>
                <label for="faq_response" class="block mb-2 text-sm 
                font-medium text-gray-900">
                    Respuesta
                </label>
                <div class="w-full border border-gray-300 rounded-lg bg-gray-50 
                shadow-sm ring-1 ring-inset ring-gray-300">
                    <div class="p-3 bg-white rounded-lg">
                        <textarea id="faq_response" rows="7" scrollbar-thin 
                        class="block w-full p-0 text-sm text-gray-800
                        bg-white border-0 focus:ring-0 placeholder:text-gray-400" 
                        placeholder="Da una respuesta detallada"></textarea>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-x-2 justify-end mt-4">

                <x-button @click="faqsPanelOpen = false" size="large" 
                type="secondary">Cancelar</x-button>

                <x-button size="large">Guardar</x-button>
            </div>

        </x-modal>

        <dl x-data="{ selected: false }" class="divide-y divide-gray-900/10">
            @for ($i = 0; $i < 7; $i++)
                <div @click="selected === {{ $i }} ? selected = false : selected = {{ $i }}" class="py-6 first:pt-0 last:pb-0">
                    <dt>
                        <button @click="open = !open" type="button"
                            class="flex w-full items-start 
                                        justify-between text-left text-gray-900">
                            <span class="text-base/7 font-semibold">
                                ¿Ea molestias porro consequatur exercitationem.?
                            </span>
                            <span class="ml-6 flex h-7 items-center">
                                <i class="material-symbols-outlined" x-text="selected === {{ $i }} ? 'remove' : 'add'"></i>
                            </span>
                        </button>
                    </dt>
                    <div x-show="selected === {{ $i }}" x-collapse>
                        <dd class="mt-2 pr-12">
                            <p class="text-base/7 text-gray-600">I don't know, but the flag is a big plus.
                                Libero a unde ut vel ut et molestias adipisci fuga et quia magni labore et harum
                                perspiciatis id eaque voluptates rem et provident odit nemo aut vel occaecati molestias
                                nulla debitis reprehenderit suscipit nesciunt velit voluptatibus quo recusandae aliquam nisi
                                fugiat quo omnis officia autem quam modi enim natus.
                            </p>
                        </dd>
                    </div>
                </div>    
            @endfor
        </dl>
    </div>
</div>
