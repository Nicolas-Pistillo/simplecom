@php
    $typeColors = [
        'danger'    => 'red',
        'warning'   => 'yellow',
        'success'   => 'green',
        'info'      => 'blue',
        'secondary' => 'gray',
    ];

    $color = $typeColors[$type ?? 'info'];
@endphp

<div x-show="{{ $ref }}" x-cloak class="relative z-50" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div x-show="{{ $ref }}" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-700 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="{{ $ref }}" @click.away="{{ $ref }} = false"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-{{ $color }}-100 sm:mx-0 sm:h-10 sm:w-10">
                        <x-icon class="text-{{ $color }}-600" code="{{ $icon ?? 'info' }}" />
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">
                            {{ $title }}
                        </h3>
                      <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            {{ $body }}
                        </p>
                      </div>
                    </div>
                </div>
                @isset($actions)
                    <div class="mt-5 flex justify-end sm:mt-4">
                        {{ $actions }}
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
