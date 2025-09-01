<li class="select-none {{ $itemClasses ?? '' }}" 
x-data="{open: {{ (isset($open) && $open) ? 'true' : 'false' }}}">
    <span @click="open = !open" class="flex justify-between gap-x-3 rounded-md 
    transition-colors duration-200 p-2 text-sm leading-6 font-semibold 
    cursor-pointer hover:bg-gray-50 text-gray-600">
        <div class="flex items-center gap-x-3">
            <x-icon code="{{ $icon }}" /> {{ $title }}
        </div>
        <i class="material-symbols-outlined" x-text="open ? 'arrow_drop_down' : 'arrow_right'"></i>
    </span>

    <ul x-show="open" x-cloak x-collapse role="list" 
    class="pl-4 ml-5 border-l flex flex-1 flex-col gap-y-2 text-sm">
        {{ $slot }}
    </ul>
</li>