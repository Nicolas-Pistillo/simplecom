<label {{ $attributes->merge(['class' => 'inline-flex w-max items-center cursor-pointer']) }}
@isset($tooltip) x-tooltip.raw.placement.{{ $tooltipPosition ?? 'left' }}="{{ $tooltip }}"  @endisset>

    <input type="checkbox" class="sr-only peer" @isset($value) value="{{ $value }}" @endisset
    @if (isset($disabled) && $disabled == true) disabled @endif
    @if (isset($checked) && $checked == true) checked @endif
    @if (!empty($name)) name="{{ $name }}" @endif
    @isset($wireModel) wire:model.live='{{ $wireModel }}' @endisset
    @isset($wireChange) wire:change='{{ $wireChange }}' @endisset>

    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 
    peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full 
    rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] 
    after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 
    after:border after:rounded-full after:h-5 after:w-5 after:transition-all 
    peer-checked:bg-blue-600"></div>
    @isset($label)
        <span class="ms-3 text-xs sm:text-sm font-medium text-gray-900">{{ $label }}</span>
    @endisset
</label>