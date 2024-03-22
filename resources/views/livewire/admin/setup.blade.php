<div>
    <div x-data="{ showSetupModal: false }" x-init="setTimeout(() => showSetupModal = true, 150)" 
        class="relative z-20" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div x-cloak x-show="showSetupModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 brightness-50 transition-opacity bg-cover bg-bottom"
            style="background-image: url({{ URL::to('img/office-3.jpg') }})"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-cloak x-show="showSetupModal" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 text-left shadow-xl 
                    transition-all sm:my-8 w-full p-6 mx-3 
                    {{ !in_array($currentStep, ['welcome', 'finished']) ? 'sm:max-w-3xl' : 'sm:max-w-lg' }}">

                    @if ($currentStep === 'welcome')
                        <div>
                            <div class="mx-auto flex items-center justify-center">
                                <img src="{{ URL::to('img/illustrations/happy_feeling.svg') }}" class="h-24 sm:h-36"
                                    alt="Welcome Illustration">
                            </div>

                            <div class="text-center">
                                <h4 class="my-4 text-2xl sm:text-3xl font-bold tracking-tight text-gray-900">
                                    ¡Bienvenid@ a Simplecom!
                                </h4>

                                <p class="my-6 text-sm sm:text-base leading-7 text-gray-600">
                                    Gracias por confiar en nosotros, <span
                                        class="text-gray-700 font-semibold">{{ tenant()->ecommerce_name }}</span>. <br>
                                    Es hora de poner en marcha tu gestor de comercio. Para ello es necesario realizar
                                    las configuraciones iniciales para que tu tienda y tu gestor comiencen a operar.
                                </p>

                            </div>
                        </div>

                        <x-button wire:click='beginSetup' type="primary"
                            class="flex items-center justify-center w-full">
                            Comenzar ahora
                            <x-icon code="arrow_forward" class="ml-4" />
                        </x-button>
                    @endif

                    @if ($currentStep === 1)
                        <form wire:submit='submitFirstStep' class="animate__animated animate__fadeIn">
                            <h4 class="text-2xl sm:text-3xl font-bold tracking-tight text-center text-gray-900">
                                Identidad de tu negocio
                            </h4>

                            <p class="mt-3 mb-5 text-sm sm:text-base leading-7 text-gray-600 text-center">
                                Sube el logo de tu comercio y selecciona el color principal que lo identifique.
                            </p>

                            <div class="flex items-center justify-around flex-wrap">

                                <div class="text-center mb-5 sm:mb-0 mx-5 w-60">
                                    <img src="{{ $ecommerceLogoPreview ?: URL::to('img/no-image.png') }}"
                                        class="h-40 mb-6 mx-auto object-contain" style="max-width: 200px">

                                    <x-button wire:loading.remove wire:target='ecommerceLogo' file onlyImages type="secondary" wireModel="ecommerceLogo" name="ecommerce_logo"
                                        class="flex items-center justify-center">
                                        Subir logo <x-icon code="upload" class="ml-2" />
                                    </x-button>
                                    <div wire:loading wire:target='ecommerceLogo' class="w-full mx-auto">
                                        <x-spinner />
                                    </div>
                                    <small class="font-extralight text-xs">Medidas recomendadas: 400 x 100</small>
                                    @error('ecommerceLogo')
                                        <br>
                                        <small class="font-extralight text-red-500 text-xs"> {{ $message }} </small>
                                    @enderror
                                </div>

                                <div>
                                    <fieldset>
                                        <legend class="block text-sm leading-6 text-gray-700">
                                            Seleccionar color
                                        </legend>
                                        <div x-data="{selected: $wire.ecommerceColor}" class="mt-2 grid grid-cols-5 gap-2">

                                            @foreach ($availableColors as $color)
                                                <label @click="selected = '{{ $color }}'" :class="selected === '{{ $color }}' ? 'ring ring-offset-1 ring-{{ $color }}-300' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                    <input type="radio" name="ecommerceColor" 
                                                    wire:model.live='ecommerceColor' value="{{ $color }}" class="sr-only">
                                                    <span class="sr-only"> {{ $color }} </span>
                                                    <span aria-hidden="true"
                                                        class="h-8 w-8 bg-{{ $color }}-500 rounded-full border border-black border-opacity-10"></span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </fieldset>
                                    @error('ecommerceColor')
                                        <small class="font-extralight text-red-500 text-xs"> {{ $message }} </small>
                                    @enderror
                                </div>

                            </div>

                            <div class="mt-6 flex justify-end border-t border-gray-200 pt-4">
                                @if (($ecommerceLogo && $ecommerceColor) || (tenant()->logo_url && $ecommerceColor))
                                    <x-button submit class="w-full sm:w-1/2 flex items-center justify-center">
                                        <span wire:loading.remove wire:target='submitFirstStep'>Siguiente</span>
                                        <x-icon wire:loading.remove wire:target='submitFirstStep' code="arrow_forward" class="ml-4" />
                                        <div wire:loading wire:target='submitFirstStep' role="status">
                                            <svg aria-hidden="true" class="w-6 h-6 mr-2 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </x-button>
                                @else
                                    <x-button disabled class="w-full sm:w-1/2">Siguiente</x-button>
                                @endif
                            </div>
                        </form>
                    @endif

                    @if ($currentStep === 2)
                        <form wire:submit.prevent='submitSecondStep' class="animate__animated animate__fadeIn">
                            <h4 class="text-2xl sm:text-3xl font-bold tracking-tight text-center text-gray-900">
                                Configuración de comercio
                            </h4>
    
                            <p class="mt-3 mb-8 text-sm sm:text-base leading-7 text-gray-600 text-center">
                                ¡Ya casi terminas!
                            </p>
    
                            <div class="px-4 sm:px-8 grid grid-cols-1 sm:grid-cols-2 gap-4">

                                @foreach ($configurationModels as $key => $configField)

                                    <div wire:key='{{ $key }}' class="flex items-center">
                                        <x-input 
                                        class="border-none px-0 mb-4 w-full"  
                                        label="{{ $configField->display_name }}" 
                                        wire:model.live="{{ $configField->key }}" 
                                        error="{{ $errors->first($configField->key) }}"
                                        placeholder="{{ $configField->description }}"
                                        withAsterisk="{{ $configField->required }}"
                                        value="{{ $this->{$configField->key} }}"
                                        type="{{ $configField->datatype }}"
                                        />

                                        

                                        @if ($configField->key === 'contact_whatsapp')

                                            <a href="https://api.whatsapp.com/send?phone={{ $contact_whatsapp }}" 
                                            target="_blank" title="Probar link a Whatsapp" class="ml-3">
                                                <x-icon code="open_in_new" style="font-size: 21px"
                                                class="transition colors duration-300 cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none focus:ring" />
                                            </a>
                                        @endif
                                    </div>
                                    
                                @endforeach

                            </div>
    
                            <div class="mt-6 grid grid-flow-row-dense grid-cols-2 gap-3 border-t border-gray-200 pt-4">
                                <x-button wire:click='previousStep' type="secondary"
                                    class="flex items-center justify-center">
                                    <x-icon code="arrow_back" class="mr-4" />
                                    Anterior
                                </x-button>
    
                                <x-button submit
                                    class="flex items-center justify-center">
                                    <span wire:loading.remove wire:target='submitSecondStep'>Finalizar</span>
                                        <x-icon wire:loading.remove wire:target='submitSecondStep' code="checklist" class="ml-4" />
                                        <div wire:loading wire:target='submitSecondStep' role="status">
                                            <svg aria-hidden="true" class="w-6 h-6 mr-2 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                </x-button>
                            </div>
                        </form>
                    @endif

                    @if ($currentStep === 'finished')
                        <div>
                            <div class="mx-auto flex items-center justify-center">
                                <img src="{{ URL::to('img/illustrations/happy_news.svg') }}" class="h-24 sm:h-36"
                                    alt="Welcome Illustration">
                            </div>

                            <div class="text-center">
                                <h4 class="my-4 text-2xl sm:text-3xl font-bold tracking-tight text-gray-900">
                                    ¡Todo listo!
                                </h4>

                                <p class="my-6 text-sm sm:text-base leading-7 text-gray-600">
                                    Completaste con éxito las configuraciones iniciales de tu comercio y ya se encuentra listo para operar 🚀 <br> <br>
                                    Ya podes usar tu panel de administración para gestionar todo lo necesario para comenzar a vender. <br>
                                    ¡Esperamos poder ayudarte a lograr el éxito y crecimiento de tu negocio juntos! 🤝
                                </p>

                            </div>
                        </div>

                        <x-button href="{{ route('admin.dashboard.index') }}" type="primary"
                        size="large" class="flex items-center justify-center w-full">
                            Comenzar a operar
                        </x-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
