<div>
    <div class="relative isolate overflow-hidden">
        <header class="pb-4 pt-6 sm:pb-6">
            <div class="mx-auto flex max-w-7xl flex-wrap items-center gap-6 sm:flex-nowrap">
                <h1 class="text-base font-semibold leading-7 text-gray-900">Estadísticas</h1>
                <div
                    class="order-last flex flex-wrap w-full gap-4 text-sm leading-6 
                sm:order-none sm:w-auto sm:border-l sm:border-gray-200 sm:pl-6 sm:leading-7">

                    @foreach (PeriodOption::cases() as $period)
                        <span wire:key='period-{{ $period->value }}' wire:click="setPeriod('{{ $period }}')"
                            class="py-1.5 px-2 rounded-full cursor-pointer border transition duration-200 
                        {{ $this->period === $period
                            ? 'text-blue-700 font-semibold bg-blue-50 border-blue-500'
                            : 'text-gray-600 border-transparent hover:border-gray-200' }}">
                            {{ $period->name() }}
                        </span>
                    @endforeach
                </div>
                {{-- <x-button type="secondary" class="ml-auto flex items-center">
                    <x-icon code="add" class="mr-1" /> New invoince
                </x-button> --}}
            </div>
        </header>

        @if ($this->period != PeriodOption::Today)
            <h4 class="text-sm font-semibold">
                Período del {{ data_get($this->period->datesBetween(), 'from')->format('d/m') }} 
                hasta el {{ data_get($this->period->datesBetween(), 'to')->format('d/m') }}
            </h4>
        @endif

        <div class="grid gap-8 sm:grid-cols-3">
            <div>
                <div class="mt-6 text-lg/6 font-medium sm:text-sm/6">Total Pedidos</div>
                <div class="mt-3 text-3xl/8 font-semibold sm:text-2xl/8">
                    {{ data_get($orderAverage, 'total') }}
                </div>
                <div class="mt-3 text-sm/6 sm:text-xs/6">
                    @php
                        $conversion = data_get($orderAverage, 'conversionRate');
                    @endphp
                    <x-badge :color="$conversion >= 60 ? 'emerald' : 'yellow'">{{ $conversion }}%</x-badge>
                    <span class="text-zinc-500">de conversión</span>
                </div>
            </div>
            <div>
                <div class="mt-6 text-lg/6 font-medium sm:text-sm/6">Total Vendido</div>
                <div class="mt-3 text-3xl/8 font-semibold sm:text-2xl/8">
                    ${{ priceFormat(data_get($totalSold, 'total')) }}
                </div>
                <div class="mt-3 text-sm/6 sm:text-xs/6">
                    <x-badge color="emerald">
                        ${{ priceFormat(data_get($totalSold, 'totalShipping')) }}
                    </x-badge>
                    <span class="text-zinc-500">cobrado en envíos</span>
                </div>
            </div>
            <div>
                <div class="mt-6 text-lg/6 font-medium sm:text-sm/6">Ticket Promedio</div>
                <div class="mt-3 text-3xl/8 font-semibold sm:text-2xl/8">
                    ${{ priceFormat($averageTicket) }}
                </div>
            </div>
        </div>
    </div>
</div>
