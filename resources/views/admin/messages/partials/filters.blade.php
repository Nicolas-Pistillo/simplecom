<div class="flex items-end justify-between flex-wrap gap-4 mb-4">

    <div class="relative w-full order-2 sm:order-1 sm:w-72">

        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
            <x-icon code="search" class="text-gray-500" />
        </div>

        <input type="search" wire:model.live="search"
        class="block w-full pt-2 ps-10 text-sm text-gray-900 
        border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 
        focus:border-blue-500" placeholder="Buscar mensaje...">
    </div>

    <div class="flex items-center order-1 sm:order-2 gap-3">

        <div x-data="{ open: false }" class="relative">

            <i class="material-symbols-outlined transition colors cursor-pointer bg-gray-100 text-gray-500 
            p-1.5 rounded-full hover:bg-gray-200 no-select focus:outline-none 
            focus:ring duration-300"
            code="tune" x-tooltip.raw.placement.top="Filtrar" @click="open = !open">
                tune
            </i>
            <div x-show="open" x-cloak @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-90"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="transform opacity-100 scale-200"
                x-transition:leave-end="transform opacity-0 scale-90"
                class="absolute top-12 z-20 left-0 sm:right-0 sm:left-[unset] rounded-md 
                bg-white p-4 ring-1 shadow-xl shadow-black/5 ring-slate-700/10
                w-[280px] sm:w-[480px]">

                <div class="flex items-center justify-between">
                    <h6 class="font-semibold text-sm text-slate-900">Filtros</h6>
                    <div wire:loading wire:target='filters'>
                        <x-spinner spinnerclass="!w-5 !h-5" />
                    </div>
                </div>

                <div class="mt-4 text-[0.8125rem]/6 text-slate-900">

                    <div class="flex items-center border-t border-slate-400/20 py-3">
                        <span class="w-2/5 flex-none">Tipo de mensaje</span>
                        <span class="pointer-events-auto ml-auto font-medium">
                            <select wire:model.live="filters.topic"
                                class="block w-full rounded-md border-none py-0.5 text-gray-900 
                                shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                                focus:ring-inset focus:ring-blue-600 text-sm leading-6">
                                <option value="">Todos</option>

                                @foreach (MessageTopic::cases() as $topic)
                                    <option value="{{ $topic->value }}">
                                        {{ $topic->name() }}
                                    </option>
                                @endforeach
                            </select>
                        </span>
                    </div>

                    <div class="flex items-center border-t border-slate-400/20 py-3">
                        <span>Sin responder</span>
                        <span class="ml-auto flex items-center">
                            <x-switch wireModel="filters.only_unreplied" />
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
