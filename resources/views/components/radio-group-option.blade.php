<div {{ $attributes->merge(['class' => '-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50']) }}>
    <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
        <input type="radio" name="{{ $name }}" value="{{ $value }}"
        class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
        text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
        active:ring-offset-2">
        <div class="ml-3 flex items-center justify-between w-full">
            <div class="flex items-center text-sm">
                <div class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                    <x-icon code="{{ $icon }}" class="text-gray-600" />
                </div>
                <div>
                    <h5 class="font-medium mb-0.5 text-xs sm:text-sm"> {{ $title }} </h5>
                    <span class="block text-xs text-gray-700">{{ $description }}</span>
                </div>
            </div>
            <div>
                <span class="text-sm font-medium ml-4">{{ $indicator ?? '' }}</span>
            </div>
        </div>
    </label>
</div>