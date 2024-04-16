@if (isset($href))
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'text-gray-700 block px-4 py-2 text-sm 
    hover:bg-gray-50 hover:text-gray-900 flex items-center']) }}
    role="menuitem">
        @isset($icon) <x-icon :code="$icon" class="mr-2 text-gray-600 {{ $iconClass ?? '' }}" style="font-size: 20px" /> @endisset
        {{ $label }}
    </a>    
@else 
    <span {{ $attributes->merge(['class' => 'text-gray-700 cursor-pointer block px-4 py-2 text-sm 
    hover:bg-gray-50 hover:text-gray-900 flex items-center']) }}
    role="menuitem">
        @isset($icon) <x-icon :code="$icon" class="mr-2 text-gray-600 {{ $iconClass ?? '' }}" style="font-size: 20px" /> @endisset
        {{ $label }}
    </span>
@endif