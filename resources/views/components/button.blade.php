@php
    $sizes = [
        'tiny'      => 'px-2 py-1 text-xs rounded transition-colors duration-300',
        'small'     => 'px-2 py-1 text-sm rounded transition-colors duration-300',
        'normal'    => 'px-2.5 py-1.5 text-sm rounded-md transition-colors duration-300',
        'large'     => 'px-3 py-2 text-sm rounded-md transition-colors duration-300',
        'big'       => 'px-3.5 py-2.5 rounded-md transition-colors duration-300'
    ];

    $btnSize = isset($size) ? $sizes[$size] : $sizes['normal'];

    $types = [
        'primary'   => 'font-semibold text-white bg-blue-600 shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600',
        'secondary' => 'bg-white font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50',
        'soft'      => 'bg-blue-50 font-semibold text-blue-600 shadow-sm hover:bg-blue-100'
    ];

    $btnClassType = isset($type) ? $types[$type] : $types['primary'];

    $btnClass = "$btnSize $btnClassType";

@endphp

@if(isset($href))

    <a href="{{ $href }}" @isset ($blank) target="_blank" @endisset 
    {{ $attributes->merge(['class' => $btnClass]) }}>
        {{ $slot }}
    </a>

@else 

    @if (isset($file))
        
        <label {{ $attributes->merge(['class' => "cursor-pointer $btnClass"]) }}>
            {{ $slot }}
            <input type="file" name="{{ $name }}" {{ isset($wireModel) ? "wire:model=$wireModel" : '' }} class="hidden">
        </label>

    @else
        <button type="{{ isset($submit) ? 'submit' : 'button' }}" 
        {{ $attributes->merge(['class' => $btnClass]) }}>
            {{ $slot }}
        </button>
    @endif
@endif