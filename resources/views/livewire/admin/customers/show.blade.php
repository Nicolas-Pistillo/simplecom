<div>
    <x-button :href="route('admin.customers.index')" type="secondary" 
    class="inline-flex items-center gap-1.5 mb-6">
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
        <div
            class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-3 sm:space-y-0 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3">
            <button type="button"
                class="inline-flex items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Disqualify</button>
            <button type="button"
                class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Advance
                to offer</button>
        </div>
    </div>
</div>
