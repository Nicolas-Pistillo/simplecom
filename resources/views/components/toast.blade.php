@php
    $typeColors = [
        'danger'    => 'red',
        'warning'   => 'yellow',
        'success'   => 'green',
        'info'      => 'blue',
        'secondary' => 'gray',
    ];

    $typeIcons = [
        'danger'    => 'error',
        'warning'   => 'warning',
        'success'   => 'check_circle_outline',
        'info'      => 'info',
        'secondary' => 'info'
    ];

    $icon = $icon ?? $typeIcons[$type ?? 'info'];
    $color = $typeColors[$type ?? 'info'];
@endphp

<div x-data="{ timeoutId: false }" x-show="{{ $ref }}" x-cloak aria-live="assertive"
    class="z-50 pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6" x-init="$watch('{{ $ref }}', value => { clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {{ $ref }} = false, {{ $time ?? 3000 }}) })">
    <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
        <div x-show="{{ $ref }}" x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <x-icon code="{{ $icon }}" class="text-{{ $color }}-500" />
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium text-{{ $color }}-700"> {{ $title ?? '' }} </p>
                        <p class="mt-1 text-sm text-gray-500"> {{ $body ?? '' }} </p>
                    </div>
                    <div class="ml-4 flex flex-shrink-0">
                        <button @click="{{ $ref }} = false" type="button"
                            class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <x-icon code="close" class="text-lg" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
