<div {{ $attributes->merge(['class' => 'relative w-full']) }}
    x-data="{open: false}">

    @isset($label)
        <label for="{{ $id ?? ($label ?? '') }}"
            class="inline-block text-sm font-medium 
            leading-6 text-gray-900 mb-2">
            {{ $label }}
        </label>

        @isset($withAsterisk)
            <sup class="text-red-500" style="font-size: 12px">*</sup>
        @endisset
    @endisset

    <button @click="open = !open" type="button"
        class="rounded-md border-0 py-1.5 px-4
        text-gray-900 w-full shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
        focus:ring-inset focus:ring-blue-600 text-sm sm:leading-6 flex items-center justify-between">

        <div class="flex items-center gap-1.5">
            {{ $beforeTitle ?? '' }}
            <span class="text-gray-800 truncate">
                {{ $title ?? '' }}
            </span>
        </div>

        <x-icon code="expand_all" class="text-gray-500 text-[18px]" />

    </button>

    <div x-show="open" x-transition x-cloak scrollbar-thin @click.away="open = false"
    class="absolute mt-2 z-10 w-full max-h-72 pb-1 px-1 space-y-0.5 bg-white 
    border border-gray-200 rounded-lg overflow-hidden overflow-y-auto top-full">

        <div class="bg-white p-2 -mx-1 sticky top-0">
            <x-form-input containerClass="shadow-none" placeholder="Buscar..." />
        </div>

        @for ($i = 0; $i < 100; $i++)
            <div class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 
            hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100">
                <div class="flex justify-between items-center w-full">
                    <span>
                        Essence Mascara Lash Princess
                    </span>
                    <input type="checkbox" name="" id="">
                </div>
            </div>
        @endfor
    </div>
</div>
