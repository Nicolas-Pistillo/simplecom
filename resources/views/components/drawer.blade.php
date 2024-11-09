<div x-show="{{ $ref }}" x-cloak class="relative z-50" role="dialog" aria-modal="true">

    <div x-show="{{ $ref }}" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-gray-700 bg-opacity-60 transition-opacity"></div>

    <div class="fixed inset-0 cursor-default overflow-hidden">
        <div class="absolute inset-0 overflow-hidden z-50">
            <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">

                <div x-show="{{ $ref }}"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                    class="pointer-events-auto relative w-96">

                    @if (!isset($withoutClose))
                        <div x-show="{{ $ref }}" x-transition:enter="ease-in-out duration-500"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute left-0 top-0 flex pr-2 pt-4 -ml-12 sm:-ml-14 sm:pr-4">

                            <x-icon @click="{{ $ref }} = false" code="close"
                            class="transition colors duration-300 cursor-pointer text-gray-600 p-2 bg-gray-50 rounded-full hover:bg-gray-100 focus:outline-none focus:ring" />

                        </div>
                    @endif

                    <!-- Slide-over panel, show/hide based on slide-over state. -->
                    <div @click.away="{{ $ref }} = false" class="h-full cursor-default overflow-y-auto 
                    bg-white py-6 px-8 {{ $containerClasses ?? '' }}">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
