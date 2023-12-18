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
                    {{ $currentStep != 'welcome' ? 'sm:max-w-2xl' : 'sm:max-w-lg' }}">

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
                                    <img src="{{ $ecommerceLogo ? $ecommerceLogo->temporaryUrl() : URL::to('img/no-image.png') }}"
                                        class="h-40 mb-6 mx-auto object-contain" style="max-width: 200px">

                                    <x-button file onlyImages type="secondary" wireModel="ecommerceLogo" name="ecommerce_logo"
                                        class="flex items-center justify-center">
                                        Subir logo <x-icon code="upload" class="ml-2" />
                                    </x-button>
                                    <small class="font-extralight text-xs">Medidas recomendadas: 512 x 512</small>
                                    @error('ecommerceLogo')
                                        <br>
                                        <small class="font-extralight text-red-500 text-xs"> {{ $message }} </small>
                                    @enderror
                                </div>

                                <div>
                                    <fieldset>
                                        <legend class="block text-sm leading-6 text-gray-700">
                                            Seleccione un color
                                        </legend>
                                        <div x-data="{selected: $wire.ecommerceColor}" class="mt-2 grid grid-cols-5 gap-2">

                                            <label @click="selected = 'pink'" :class="selected === 'pink' ? 'ring ring-offset-1 ring-pink-500' : ''"
                                            class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="pink" class="sr-only"
                                                    aria-labelledby="color-choice-0-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-0-label" class="sr-only">Pink</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-pink-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'red'" :class="selected === 'red' ? 'ring ring-offset-1 ring-red-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="red" class="sr-only"
                                                    aria-labelledby="color-choice-0-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-0-label" class="sr-only">Red</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-red-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'indigo'" :class="selected === 'indigo' ? 'ring ring-offset-1 ring-indigo-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="indigo" class="sr-only"
                                                    aria-labelledby="color-choice-0-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-0-label" class="sr-only">Indigo</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-indigo-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>
                                            
                                            <label @click="selected = 'purple'" :class="selected === 'purple' ? 'ring ring-offset-1 ring-purple-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="purple" class="sr-only"
                                                    aria-labelledby="color-choice-1-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-1-label" class="sr-only">Purple</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-purple-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'sky'" :class="selected === 'sky' ? 'ring ring-offset-1 ring-sky-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="sky" class="sr-only"
                                                    aria-labelledby="color-choice-1-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-1-label" class="sr-only">Sky</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-sky-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'slate'" :class="selected === 'slate' ? 'ring ring-offset-1 ring-slate-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="slate" class="sr-only"
                                                    aria-labelledby="color-choice-1-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-1-label" class="sr-only">Slate</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-slate-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'cyan'" :class="selected === 'cyan' ? 'ring ring-offset-1 ring-cyan-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="cyan" class="sr-only"
                                                    aria-labelledby="color-choice-1-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-1-label" class="sr-only">Cyan</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-cyan-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'orange'" :class="selected === 'orange' ? 'ring ring-offset-1 ring-orange-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="orange" class="sr-only"
                                                    aria-labelledby="color-choice-1-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-1-label" class="sr-only">Orange</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-orange-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'emerald'" :class="selected === 'emerald' ? 'ring ring-offset-1 ring-emerald-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="emerald" class="sr-only"
                                                    aria-labelledby="color-choice-1-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-1-label" class="sr-only">Emerald</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-emerald-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'zinc'" :class="selected === 'zinc' ? 'ring ring-offset-1 ring-zinc-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="zinc" class="sr-only"
                                                    aria-labelledby="color-choice-1-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-1-label" class="sr-only">Zinc</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-zinc-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'lime'" :class="selected === 'lime' ? 'ring ring-offset-1 ring-lime-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="lime" class="sr-only"
                                                    aria-labelledby="color-choice-1-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-1-label" class="sr-only">Lime</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-lime-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>
                                            
                                            <label @click="selected = 'blue'" :class="selected === 'blue' ? 'ring ring-offset-1 ring-blue-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="blue" class="sr-only"
                                                    aria-labelledby="color-choice-2-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-2-label" class="sr-only">Blue</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-blue-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>
                                            
                                            <label @click="selected = 'green'" :class="selected === 'green' ? 'ring ring-offset-1 ring-green-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="green" class="sr-only"
                                                    aria-labelledby="color-choice-3-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-3-label" class="sr-only">Green</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-green-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>
                                            
                                            <label @click="selected = 'rose'" :class="selected === 'rose' ? 'ring ring-offset-1 ring-rose-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="rose" class="sr-only"
                                                    aria-labelledby="color-choice-0-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-0-label" class="sr-only">Rose</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-rose-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'yellow'" :class="selected === 'yellow' ? 'ring ring-offset-1 ring-yellow-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="yellow" class="sr-only"
                                                    aria-labelledby="color-choice-4-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-4-label" class="sr-only">Yellow</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-yellow-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'violet'" :class="selected === 'violet' ? 'ring ring-offset-1 ring-violet-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="violet" class="sr-only"
                                                    aria-labelledby="color-choice-4-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-4-label" class="sr-only">Violet</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-violet-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'amber'" :class="selected === 'amber' ? 'ring ring-offset-1 ring-amber-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="amber" class="sr-only"
                                                    aria-labelledby="color-choice-4-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-4-label" class="sr-only">Amber</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-amber-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'teal'" :class="selected === 'teal' ? 'ring ring-offset-1 ring-teal-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="teal" class="sr-only"
                                                    aria-labelledby="color-choice-4-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-4-label" class="sr-only">Teal</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-teal-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'stone'" :class="selected === 'stone' ? 'ring ring-offset-1 ring-stone-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="stone" class="sr-only"
                                                    aria-labelledby="color-choice-4-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-4-label" class="sr-only">stone</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-stone-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>

                                            <label @click="selected = 'fuchsia'" :class="selected === 'fuchsia' ? 'ring ring-offset-1 ring-fuchsia-500' : ''"
                                                class="relative flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none">
                                                <input type="radio" name="ecommerceColor" value="fuchsia" class="sr-only"
                                                    aria-labelledby="color-choice-4-label" wire:model.live='ecommerceColor'>
                                                <span id="color-choice-4-label" class="sr-only">Fuchsia</span>
                                                <span aria-hidden="true"
                                                    class="h-8 w-8 bg-fuchsia-500 rounded-full border border-black border-opacity-10"></span>
                                            </label>
                                        </div>
                                    </fieldset>
                                    @error('ecommerceColor')
                                        <small class="font-extralight text-red-500 text-xs"> {{ $message }} </small>
                                    @enderror
                                </div>

                            </div>

                            <div class="mt-6 flex justify-end border-t border-gray-200 pt-4">
                                @if ($ecommerceLogo && $ecommerceColor)
                                    <x-button submit type="primary"
                                    class="w-full sm:w-1/2 flex items-center justify-center">
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

                        <div class="animate__animated animate__fadeIn">
                            <h4 class="text-2xl sm:text-3xl font-bold tracking-tight text-center text-gray-900">
                                Ubicación y contacto
                            </h4>
    
                            <p class="mt-3 mb-8 text-sm sm:text-base leading-7 text-gray-600 text-center">
                                Ingresa el correo principal por el cual recibiras consultas de tus clientes.
                            </p>
    
                            <div class="px-4 sm:px-8 grid grid-cols-1 sm:grid-cols-2 gap-4">

                                <x-input type="email" label="Correo de contacto" name="ecommerceContact" 
                                class="border-none px-0" placeholder="Las consultas de tus clientes llegaran aqui" />

                                <x-input type="email" label="Correo de contacto" name="ecommerceContact" 
                                class="border-none px-0" />

                                <x-input type="email" label="Correo de contacto" name="ecommerceContact" 
                                class="border-none px-0" />

                                <x-input type="email" label="Correo de contacto" name="ecommerceContact" 
                                class="border-none px-0" />

                            </div>
    
                            <div class="mt-6 grid grid-flow-row-dense grid-cols-2 gap-3 border-t border-gray-200 pt-4">
                                <x-button wire:click='previousStep' type="secondary"
                                    class="flex items-center justify-center">
                                    <x-icon code="arrow_back" class="mr-4" />
                                    Anterior
                                </x-button>
    
                                <x-button wire:click="submitSecondStep" type="primary"
                                    class="flex items-center justify-center">
                                    Siguiente
                                    <x-icon code="arrow_forward" class="ml-4" />
                                </x-button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
