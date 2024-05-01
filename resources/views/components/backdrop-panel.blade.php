<div x-show="{{ $ref }}" x-cloak class="relative z-50" role="dialog" aria-modal="true"
    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div class="fixed inset-0 bg-gray-500 bg-opacity-25 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen flex justify-center items-center overflow-y-auto p-4 sm:p-6 md:p-20">
        <div @click.away="{{ $ref }} = false" style="min-width: 400px"
        class="mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden 
        rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">

            {{ $slot }}

        </div>
    </div>
</div>
