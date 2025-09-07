<div {{ $attributes->merge(['class' => 'relative w-full']) }} x-data="{ isOpen: false }">
    @isset($label)
        <label class="inline-block text-sm font-medium leading-6 text-gray-900 mb-2">
            {{ $label }}
        </label>

        @isset($withAsterisk)
            <sup class="text-red-500" style="font-size: 12px">*</sup>
        @endisset
    @endisset

    <button @click="isOpen = !isOpen" type="button" class="rounded-md border-0 py-1.5 
    pr-4 pl-2 text-gray-900 w-full shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
    focus:ring-inset focus:ring-blue-600 text-sm sm:leading-6 flex items-center justify-between gap-x-3">
        <div class="flex items-center gap-1.5">
            {{ $beforeTitle ?? '' }}
            <span class="text-gray-800 truncate">
                {{ $title ?? '' }}
            </span>
        </div>
        <x-icon code="expand_all" class="text-gray-500 text-[18px]" />
    </button>

    <div x-show="isOpen" x-transition x-cloak @click.away="isOpen = false"
    class="absolute mt-2 z-10 w-max max-h-72 {{ isset($stickyContainer) ? 'pb-1' : 'py-1' }} 
    px-1 space-y-0.5 bg-white border border-gray-200 rounded-lg 
    overflow-hidden overflow-y-auto top-full">
        @isset($stickyContainer)
            <div class="bg-white p-2 -mx-1 sticky top-0">
                {{ $stickyContainer }}
            </div>
        @endisset

        {{ $slot }}
    </div>
</div>
