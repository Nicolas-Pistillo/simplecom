@if (isset($href))
    <a @if(isset($closeOnClick) && $closeOnClick) @click="open = false" @endif  
    href="{{ $href }}" {{ $attributes->merge(['class' => 'text-gray-700 block px-4 py-2 text-sm 
    hover:bg-gray-50 hover:text-gray-900 flex items-center']) }}
    @isset($blank) target="blank" @endisset role="menuitem">
        @isset($icon) <x-icon :code="$icon" class="mr-2 text-gray-600 {{ $iconClass ?? '' }}" style="font-size: 20px" /> @endisset
        {{ $label }}
    </a>    
@else 
    <span @if(isset($closeOnClick) && $closeOnClick) @click="open = false" @endif 
    {{ $attributes->merge(['class' => 'text-gray-700 cursor-pointer block px-4 py-2 text-sm 
    hover:bg-gray-50 hover:text-gray-900 flex items-center']) }}
    role="menuitem">
        @isset($icon) <x-icon :code="$icon" class="mr-2 text-gray-600 {{ $iconClass ?? '' }}" style="font-size: 20px" /> @endisset
        {{ $label }}
    </span>
@endif