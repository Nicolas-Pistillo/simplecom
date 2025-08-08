<div>
    <div x-data="{faqsPanelOpen: false}" class="px-4 sm:px-6 lg:px-8"
    x-on:open-faqs-panel.window="faqsPanelOpen = true"
    x-on:close-faqs-panel.window="faqsPanelOpen = false">

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
                    En esta sección podes editar las preguntas mas frecuentes que suelas recibir de tus
                    clientes para ahorrar tiempos de respuesta y soporte con respecto a tus condiciones y 
                    manera de operar de tu comercio.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button wire:loading.remove wire:target='openNew' 
                wire:click='openNew' class="flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Agregar pregunta
                </x-button>

                <div wire:loading wire:target='openNew'>
                    <x-button disabled class="flex items-center">
                        <x-spinner class="mr-3" spinnerclass="!w-4" />
                        Cargando
                    </x-button>
                </div>
            </div>
        </div>

        @if ($faqs->isEmpty())
            <div class="text-center">
                <img src="{{ URL::to('img/illustrations/online_messaging.svg') }}" 
                class="h-52 mx-auto mb-4" alt="no-data-img">

                <div class="mb-4">
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Sin preguntas frecuentes</h3>
                    <p class="mt-1 mb-4 text-sm text-gray-500">
                        Podés empezar a crearlas cuando quieras
                    </p>
                </div>
            </div>
        @else
            <dl x-data="{ selected: false }" class="divide-y divide-gray-900/10 mb-8">
                @foreach ($faqs as $faq)
                    <div @click="selected === {{ $faq->id }} ? selected = false : selected = {{ $faq->id }}" 
                    class="py-6 first:pt-0 last:pb-0">
                        <dt>
                            <button @click="open = !open" type="button" 
                            class="flex w-full items-start justify-between text-left text-gray-900">

                                <span class="text-base/7 font-semibold line-clamp-1">
                                    {{ $faq->question }}
                                </span>

                                <div class="pl-2 flex items-center gap-4">

                                    <x-switch onclick="event.stopPropagation()" tooltipPosition="top" :checked="$faq->published"
                                    wireChange="togglePublished({{ $faq->id }})" class="hidden sm:block"
                                    :tooltip="$faq->published ? 'Despublicar' : 'Publicar'" />

                                    <x-icon onclick="event.stopPropagation()" 
                                    wire:click='openEdit({{ $faq->id }})'
                                    wire:loading.remove wire:target='openEdit({{ $faq->id }})'
                                    code="edit" x-tooltip.raw="Editar"
                                    class="text-gray-600 shadow p-1 rounded-full 
                                    bg-gray-50 transition hover:bg-white cursor-pointer" />

                                    <x-spinner class="p-1" wire:loading wire:target='openEdit({{ $faq->id }})' />

                                    <span class="flex h-7 items-center">
                                        <i class="material-symbols-outlined" 
                                        x-text="selected === {{ $faq->id }} ? 'expand_less' : 'expand_more'"></i>
                                    </span>
                                </div>
                            </button>
                        </dt>
                        <div x-show="selected === {{ $faq->id }}" x-collapse>
                            <dd class="mt-2 pr-12">
                                <p class="text-base/7 text-gray-600">{{ $faq->response }}</p>
                            </dd>
                        </div>
                    </div>    
                @endforeach
            </dl>
        @endif

        {{-- FAQs panel --}}
        <x-modal large ref="faqsPanelOpen" class="w-full" bodyClass="flex-1 mr-4" 
        :title="$form->faq ? 'Editar pregunta' : 'Nueva pregunta'">

            <x-form-input model="form.question" label="Pregunta" class="my-4" placeholder="¿Sobre que trata esta pregunta?" />

            <div class="mb-4">
                <label for="faq_response" class="block mb-2 text-sm 
                font-medium text-gray-900">
                    Respuesta
                </label>
                <div class="w-full border border-gray-300 rounded-lg bg-gray-50 
                shadow-sm ring-1 ring-inset ring-gray-300">
                    <div class="p-3 bg-white rounded-lg">
                        <textarea id="faq_response" rows="7" scrollbar-thin
                        wire:model.blur='form.response' 
                        class="block w-full p-0 text-sm text-gray-800
                        bg-white border-0 focus:ring-0 placeholder:text-gray-400" 
                        placeholder="Da una respuesta detallada"></textarea>
                    </div>
                </div>

                @error('form.response')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <x-switch wireModel="form.published" label="Marcar como publicada " />

            <div class="flex items-center gap-x-2 justify-end mt-4">

                <x-button wire:loading.remove wire:target='save' 
                @click="faqsPanelOpen = false" size="large" 
                type="secondary">Cancelar</x-button>

                <x-button wire:loading.remove wire:target='save' 
                wire:click='save' size="large">Guardar</x-button>

                <x-button wire:loading wire:target='save' disabled>Guardando...</x-button>
            </div>

        </x-modal>
    </div>
</div>
