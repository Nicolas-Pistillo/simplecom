<tr wire:key='{{ $product->id }}' wire:click='quickUpdate({{ $product->id }})'
    class="border-b text-xs text-center transition-colors 
    cursor-pointer duration-300 hover:bg-gray-50">

    <td class="w-4 px-4 py-3" onclick="event.stopPropagation()">
        <div class="flex items-center">
            <input id="checkbox-table-search-1" type="checkbox"
                class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
        </div>
    </td>

    <th class="flex items-center pl-4 pr-8 py-2 font-medium text-gray-900">

        <img src="{{ $product->first_image }}" alt="{{ $product->name }}" 
        class="w-8 h-8 mr-3 rounded-lg object-contain">

        <div class="flex flex-col items-start">
            <span class="max-w-[220px] truncate font-semibold" x-tooltip.raw.placement.top="{{ $product->name }}">
                {{ $product->name }}
            </span>

            <div class="text-gray-600 font-semibold">
                <small style="font-size: 11px">ID {{ $product->id }}</small>

                @if (!empty($product->code))
                    <small style="font-size: 11px">- Código
                        {{ $product->code }}</small>
                @endif
            </div>
        </div>
    </th>

    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
        {{ $product->category->name }}
    </td>

    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
        {{ $product->stock }}
    </td>

    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
        <div class="flex justify-center gap-x-1">

            <span>${{ priceFormat($product->current_price) }}</span>

            @if ($product->hasDiscount())
                <small class="text-green-700 font-semibold" style="font-size: 11px">
                    %{{ $product->discount_percent }} OFF
                </small>
            @endif
        </div>
    </td>

    <td class="px-4 py-2 whitespace-nowrap mx-auto" onclick="event.stopPropagation()">
        <span class="inline-flex overflow-hidden shadow-sm">

            <span class="flex h-7 mx-auto rounded-md shadow-sm">

                <x-button type="secondary" wire:click='togglePublishedProduct({{ $product->id }})'
                    x-tooltip.raw.placement.top="{{ $product->published ? 'Despublicar' : 'Publicar' }}"
                    class="text-xs rounded-r-none flex items-center
                        {{ $product->published ? '!bg-blue-100 !text-blue-500' : '' }}">

                    <x-icon wire:loading.remove wire:target='togglePublishedProduct({{ $product->id }})'
                        code="{{ $product->published ? 'visibility' : 'visibility_off' }}" style="font-size: 16px" />

                    <x-spinner wire:loading wire:target='togglePublishedProduct({{ $product->id }})'
                        spinnerclass="!h-4 !w-4" />

                </x-button>

                <x-button type="secondary" wire:click='toggleFeaturedProduct({{ $product->id }})'
                    x-tooltip.raw.placement.top="{{ $product->featured ? 'No destacar' : 'Destacar' }}"
                    class="rounded-none flex items-center
                        {{ $product->featured ? '!bg-yellow-100 !text-yellow-500' : '' }}">

                    <x-icon wire:loading.remove wire:target='toggleFeaturedProduct({{ $product->id }})' code="star"
                        style="font-size: 16px" />

                    <x-spinner wire:loading wire:target='toggleFeaturedProduct({{ $product->id }})'
                        spinnerclass="!h-4 !w-4" />

                </x-button>

                <x-button :href="route('admin.products.edit', $product->id)" type="secondary" class="flex items-center rounded-none"
                    x-tooltip.raw.placement.top="Editar">
                    <x-icon code="edit" style="font-size: 16px" />
                </x-button>

                <x-button :href="$product->detailPageUrl()" blank type="secondary" class="flex items-center rounded-l-none"
                    x-tooltip.raw.placement.top="Ver producto en la tienda">
                    <x-icon code="storefront" style="font-size: 16px" />
                </x-button>

            </span>
        </span>
    </td>
</tr>
