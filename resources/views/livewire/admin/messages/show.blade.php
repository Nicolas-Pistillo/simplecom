<div>
    <x-button :href="route('admin.messages.index')" type="secondary"
    class="inline-flex items-center gap-1.5">
        <x-icon code="arrow_back" />
        Volver al listado
    </x-button>
    <section class="flex flex-col bg-white">
        <div class="flex flex-wrap gap-4 justify-between items-center py-4 border-b-2 mb-8">
            <div class="flex space-x-4 items-center">
                <div class="h-12 w-12 rounded-full overflow-hidden">
                    <img src="{{ initialsAvatar(['name' => $message->sender_name]) }}" 
                    loading="lazy" class="h-full w-full object-cover" />
                </div>
                <div class="flex flex-col">
                    <h3 class="font-semibold text-lg">{{ $message->sender_name }}</h3>
                    <p class="text-light text-sm text-gray-500 flex items-center gap-1">
                        <x-icon code="mail" class="text-[16px]" /> {{ $message->sender_email }}
                    </p>
                    <p class="text-light text-sm text-gray-500 flex items-center gap-1">
                        <x-icon code="phone" class="text-[16px]" /> {{ $message->sender_phone }}
                    </p>
                </div>
            </div>
            <div>
                <ul class="flex text-gray-400 gap-4">
                    <li>
                        <a href="https://api.whatsapp.com/send?phone=54{{ $message->sender_phone }}" target="_blank">
                            <img src="{{ URL::to('img/whatsapp-icon.svg') }}" class="h-10
                            cursor-pointer" x-tooltip.raw="Contactar por WhatsApp">
                        </a>
                    </li>

                    <li>
                        <x-icon code="print" x-tooltip.raw="Imprimir" 
                        @click="window.print()" class="transition colors cursor-pointer 
                        bg-gray-100 text-gray-600 p-2 rounded-full hover:bg-gray-200 
                        focus:outline-none focus:ring duration-300" />
                    </li>
                    
                     {{-- <li>
                        <x-icon code="delete" x-tooltip.raw="Eliminar" 
                        class="transition colors cursor-pointer 
                        bg-gray-100 text-red-600 p-2 rounded-full hover:bg-gray-200 
                        focus:outline-none focus:ring duration-300" />
                    </li> --}}
                </ul>
            </div>
        </div>
        <section>
            <small class="text-gray-500">{{ getElapsedTime($message->created_at, true) }}</small>
            <h1 class="font-bold text-2xl">{{ $message->subject }}</h1>
            <article class="mt-2 mb-8 text-gray-700 leading-7 tracking-wider">
                {{ $message->message }}
            </article>
            {{-- <ul class="flex space-x-4 mt-12">
                <li
                    class="w-10 h-10 border rounded-lg p-1 cursor-pointer transition duration-200 text-indigo-600 hover:bg-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                </li>
                <li
                    class="w-10 h-10 border rounded-lg p-1 cursor-pointer transition duration-200 text-blue-800 hover:bg-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                    </svg>
                </li>
                <li
                    class="w-10 h-10 border rounded-lg p-1 cursor-pointer transition duration-200 text-pink-400 hover:bg-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                    </svg>
                </li>
                <li
                    class="w-10 h-10 border rounded-lg p-1 cursor-pointer transition duration-200 text-yellow-500 hover:bg-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                    </svg>
                </li>
            </ul> --}}
        </section>
        <section class="mt-6">
            @if (empty($message->reply))
                <div class="w-full border rounded-lg bg-gray-50 border-gray-200">
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <textarea wire:model="reply" rows="5" 
                        class="block w-full p-0 text-gray-800
                        border-0 focus:ring-0 bg-gray-50" scrollbar-thin 
                        placeholder="Escribí tu respuesta en esta casilla..."></textarea>
                        @error('reply')
                            <small class="text-red-500">La respuesta debe contener al menos 5 caracteres</small>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center justify-end p-2">

                    <x-button wire:click='sendResponse' wire:loading.remove 
                    wire:target='sendResponse' size="big">Responder</x-button>

                    <x-button wire:loading wire:target='sendResponse' disabled>
                        <div class="flex items-center gap-2.5">
                            <x-spinner spinnerclass="!w-5 !h-5" />
                            Enviando...
                        </div>
                    </x-button>
                </div>
            @else
                <section>
                    <small class="text-gray-500">
                        Respuesta de {{ $message->operator?->name . ' ' . getElapsedTime($message->replied_at, true) }}
                    </small>
                </section>
                <p class="text-sm font-semibold text-gray-900">
                    {{ $message->reply }}
                </p>
            @endif
        </section>
    </section>
</div>
