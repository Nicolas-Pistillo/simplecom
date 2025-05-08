<div>
    <x-button :href="route('admin.customers.index')" type="secondary" class="inline-flex items-center gap-1.5 mb-6">
        <x-icon code="arrow_back" />
        Volver al listado
    </x-button>
    <div class="md:flex md:items-center md:justify-between md:space-x-5">
        <div class="flex items-start space-x-5">
            <div class="shrink-0">
                <div class="relative">
                    <img class="h-12 w-12 rounded-full"
                        src="{{ initialsAvatar(['name' => $customer->full_name, 'background' => '#2563eb', 'color' => '#fff']) }}"
                        alt="Avatar cliente">
                </div>
            </div>
            <div class="pt-1.5">
                <h1 class="text-2xl font-bold text-gray-900">{{ $customer->full_name }}</h1>
                <p class="text-sm font-medium text-gray-500">
                    {{ $customer->email }}
                </p>
            </div>
        </div>
        <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse 
        sm:flex-row-reverse sm:justify-end sm:space-x-3 sm:space-y-0 sm:space-x-reverse 
        md:mt-0 md:flex-row md:space-x-3">
            <x-button href="https://api.whatsapp.com/send?phone=549{{ $customer->phone }}" blank 
            type="secondary" size="large" class="flex items-center justify-center gap-1.5">
                <img class="w-5 h-5" src="{{ URL::to('img/whatsapp-icon.svg') }}" alt="">
                Contactar
            </x-button>
            <x-button>Advance to offer</x-button>
        </div>
    </div>

    <dl class="mt-6 grid grid-cols-1 text-sm/6 sm:grid-cols-2">
        <div class="sm:pr-4">
            <dt class="inline text-gray-500">Fecha de alta</dt>
            <dd class="inline text-gray-700">
                <time datetime="2023-23-01">
                    {{ getElapsedTime($customer->created_at, true) }}
                </time>
            </dd>
        </div>
        <div class="mt-2 sm:mt-0 sm:pl-4">
            <dt class="inline text-gray-500">
                Fecha última act.
            </dt>
            <dd class="inline text-gray-700">
                <time datetime="2023-31-01">
                    {{ getElapsedTime($customer->updated_at, true) }}
                </time>
            </dd>
        </div>
        <div class="mt-6 border-t border-gray-900/5 pt-6 sm:pr-4">
            <dt class="font-semibold text-gray-900">Datos Personales</dt>
            <dd class="mt-2 text-gray-500 flex flex-col">
                <span class="font-medium text-gray-900">
                    Email: {{ $customer->email }}
                </span>
                <span class="font-medium text-gray-900">
                    Teléfono: {{ $customer->phone }}
                </span>
                <span class="font-medium text-gray-900">
                    DNI: {{ $customer->document }}
                </span>
            </dd>
        </div>
        <div class="mt-8 sm:mt-6 sm:border-t sm:border-gray-900/5 sm:pt-6 sm:pl-4">
            <dt class="font-semibold text-gray-900">Datos de Facturación</dt>
            <dd class="mt-2 text-gray-500 flex flex-col">
                <span class="font-medium text-gray-900">
                    Cond. fiscal: {{ $customer->tax_condition->name() }}
                </span>
                <span class="font-medium text-gray-900">
                    Razón social: 
                    @if ($customer->tax_condition == TaxCondition::ConsumidorFinal)
                        {{ $customer->full_name }}
                    @else
                        {{ $customer->social_reason ?? '-' }}
                    @endif
                </span>
                <span class="font-medium text-gray-900">
                    @if ($customer->tax_condition == TaxCondition::ConsumidorFinal)
                        DNI: {{ $customer->document }}
                    @else
                        CUIT: {{ $customer->invoice_document ?? '-' }}
                    @endif
                </span>
                <span class="font-medium text-gray-900">
                    Domicilio fiscal: {{ $customer->invoice_address ?? '-' }}
                </span>
            </dd>
        </div>
    </dl>

    @include('admin.customers.partials.addresses')

    @include('admin.customers.partials.orders')
</div>
