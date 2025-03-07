<div x-show="open" x-cloak @click.away="open = false" 
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="transform opacity-0 scale-90" 
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100" 
    x-transition:leave-start="transform opacity-100 scale-200"
    x-transition:leave-end="transform opacity-0 scale-90"
    class="absolute top-12 right-0 w-[30.25rem] rounded-md bg-white 
    p-4 ring-1 shadow-xl shadow-black/5 ring-slate-700/10">

    <h6 class="font-semibold text-sm text-slate-900">Filtros</h6>

    <div class="mt-4 text-[0.8125rem]/6 text-slate-900">

        <div class="flex items-center border-t border-slate-400/20 py-3">
            <span class="w-2/5 flex-none">Estado</span>
            <span class="pointer-events-auto ml-auto font-medium">
                <select wire:model.live="filters.status"
                    class="block w-full rounded-md border-none py-0.5 text-gray-900 
                    shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                    focus:ring-inset focus:ring-blue-600 text-sm leading-6">
                    <option value="">Todos</option>

                    @foreach (OrderStatus::cases() as $status)
                        <option value="{{ $status->value }}">
                            {{ $status->name() }}
                        </option>
                    @endforeach
                </select>
            </span>
        </div>

        <div class="flex items-center border-t border-slate-400/20 py-3">
            <span class="w-2/5 flex-none">Tipo de entrega</span>
            <span class="pointer-events-auto ml-auto font-medium">
                <select wire:model.live="filters.delivery_type"
                    class="block w-full rounded-md border-none py-0.5 text-gray-900 
                    shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                    focus:ring-inset focus:ring-blue-600 text-sm leading-6">
                    <option value="">Todos</option>

                    @foreach (DeliveryType::cases() as $deliveryType)
                        <option value="{{ $deliveryType->value }}">
                            {{ $deliveryType->name() }}
                        </option>
                    @endforeach
                </select>
            </span>
        </div>

        <div class="flex items-center border-t border-slate-400/20 py-3">
            <span>Solo facturados</span>
            <span class="ml-auto flex items-center">
                <x-switch wireModel="filters.only_invoiced" />
            </span>
        </div>
    </div>
</div>
