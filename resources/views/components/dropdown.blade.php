<div x-data="{ open: false }" {{ $attributes->merge(['class' => 'relative inline-block text-left']) }}>

    @if (isset($trigger))
        <div @click="open = !open">
            {{ $trigger }}
        </div>
    @else 
        <x-button type="secondary" @click="open = !open" class="flex items-center">
            {{ $title }}
            <x-icon code="keyboard_arrow_down" class="ml-0" />
        </x-button>
    @endif

    <div x-show="open" x-cloak @click.away="open = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100 scale-100"
    x-transition:leave-end="transform opacity-0 scale-95"
    class="absolute {{ $position ?? 'left-0' }} z-10 mt-2 rounded-md bg-white shadow-lg 
    ring-1 ring-black ring-opacity-5 focus:outline-none min-w-max {{ $containerClass ?? '' }}"
    role="menu" aria-orientation="vertical" tabindex="-1">
        <div class="py-1" role="none">
            {{ $slot }}
        </div>
    </div>
</div>