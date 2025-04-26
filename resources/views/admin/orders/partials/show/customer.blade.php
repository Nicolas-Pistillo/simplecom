<div class="rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5 p-4">
    <div class="pb-3 border-b">
        <dt class="flex justify-between items-center text-sm/6 
        font-semibold text-gray-900 mb-1.5">

            <span>Cliente</span>

            <x-badge :color="$order->user->type->color()">
                {{ $order->user->type->name() }}
            </x-badge>
        </dt>
        <dd class="mt-1 text-base font-semibold text-gray-900">
            {{ $order->user->full_name }}
        </dd>
    </div>

    <div class="w-full pt-3">
        <div class="mb-3">
            <dt class="text-xs text-gray-500">
                Email
            </dt>
            <dd class="text-sm/6 font-medium text-gray-700">
                {{ $order->user->email }}
            </dd>
        </div>

        <div class="flex flex-wrap gap-6">
            <div class="flex flex-col">
                <dt class="text-xs text-gray-500">
                    Teléfono
                </dt>
                <dd class="text-sm font-medium text-gray-700">
                    {{ $order->user->phone }}
                </dd>
            </div>

            <div class="flex flex-col">
                <dt class="text-xs text-gray-500">
                    DNI
                </dt>
                <dd class="text-sm font-medium text-gray-700">
                    {{ $order->user->document }}
                </dd>
            </div>
        </div>

    </div>
    <div class="mt-3 pt-3 border-t border-gray-900/5">
        <x-button :href="$order->user->pageUrl()" type="secondary">Ver cliente</x-button>
    </div>
</div>