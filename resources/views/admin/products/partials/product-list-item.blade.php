<li wire:key='{{ $product->id }}' x-data="{ showDeleteProductConfirm: false }"
    class="flex justify-between gap-x-6 py-5 px-3 border-b
    {{ $isProductSelected ? 'shadow border-l-2 border-l-blue-700 bg-blue-50' : 'hover:bg-gray-50' }}">

    {{-- Left place | Product thumbnail, name, stock, code & states --}}
    <div class="flex items-center">
        <div class="flex min-w-0 gap-x-5 items-center">

            <input type="checkbox" wire:model.live='selectedProducts'
                value="{{ $product->id }}"
                :checked="{{ $isProductSelected ? 'true' : 'false' }}"
                id="select-product-{{ $product->id }}"
                class="h-4 w-4 rounded cursor-pointer border-gray-300 text-blue-600">

            <label for="select-product-{{ $product->id }}" class="cursor-pointer hidden md:block">
                <img class="w-12 h-10 object-cover rounded flex-none shadow-md" alt="product-img"
                src="{{ $product->getPresentationImage() ?: URL::to('img/no-image.png') }}">
            </label>

            <div class="min-w-0 flex-auto">

                <p class="text-sm font-semibold leading-6 text-gray-900 flex items-center">
                    {{ $product->name }}
                </p>

                <p class="mt-1 font-semibold flex text-xs leading-5 text-gray-500">

                    @if ($product->stock === 0)
                        <span class="text-red-500">Sin stock</span>
                    @else
                        <span class="font-semibold">Stock: {{ $product->stock }}</span>
                    @endif

                    @if ($product->code)
                        <span class="ml-1 hidden md:block">- Código: {{ $product->code }}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    {{-- Right place | Product actions --}}
    <div class="flex items-center">

        <span class="flex h-8 mr-4 rounded-md shadow-sm">

            <x-button type="secondary" wire:click='togglePublishedProduct({{ $product->id }})'
            x-tooltip.raw.placement.top="{{ $product->published ? 'Publicado' : 'No publicado' }}"
            class="text-xs rounded-r-none flex items-center
            {{ $product->published ? '!bg-blue-100 !text-blue-500' : '' }}">

                <x-icon wire:loading.remove wire:target='togglePublishedProduct({{ $product->id }})' 
                code="{{ $product->published ? 'visibility' : 'visibility_off' }}" 
                style="font-size: 16px" />

                <x-spinner wire:loading wire:target='togglePublishedProduct({{ $product->id }})' 
                spinnerclass="!h-4 !w-4" />

            </x-button>

            <x-button type="secondary" wire:click='toggleFeaturedProduct({{ $product->id }})'
            x-tooltip.raw.placement.top="{{ $product->featured ? 'Destacado' : 'No destacado' }}"
            class="rounded-l-none flex items-center
            {{ $product->featured ? '!bg-yellow-100 !text-yellow-500' : '' }}">

                <x-icon wire:loading.remove wire:target='toggleFeaturedProduct({{ $product->id }})' 
                code="star" style="font-size: 16px" />

                <x-spinner wire:loading wire:target='toggleFeaturedProduct({{ $product->id }})' 
                spinnerclass="!h-4 !w-4" />

            </x-button>

        </span>

        <div class="flex flex-col items-end text-right">
            <p class="text-sm leading-6 text-green-600">
                ${{ priceFormat($product->price) }}
            </p>
            <p class="mt-1 text-[11px] leading-5 text-gray-500 w-28 whitespace-nowrap overflow-hidden text-ellipsis">
                @if ($product->category)
                    {{ $product->category->name }} 
                @else
                    <span class="text-red-500">Sin categoría</span>
                @endif
            </p>
        </div>

        {{-- Product actions --}}
        <div class="flex-none ml-6">

            <x-dropdown position="right">

                <x-slot name="trigger">
                    <x-icon code="more_vert" class="text-2xl text-gray-500 
                        w-8 h-8 p-1 flex items-center rounded-full bg-gray-100 
                        transition hover:bg-gray-200 text-center no-select shadow cursor-pointer" />
                </x-slot>

                <x-dropdown-item label="Ver en la tienda" icon="store" />

                <x-dropdown-item :href="route('admin.products.edit', $product->id)" label="Editar" icon="edit" />

                <x-dropdown-item @click="showDeleteProductConfirm = true" label="Eliminar"
                    icon="delete" iconClass="text-red-400" />

            </x-dropdown>

            {{-- Confirm delete product --}}
            <x-modal ref="showDeleteProductConfirm" type="danger" icon="warning">

                <x-slot name="title">
                    Eliminar <span class="text-blue-600">{{ $product->name }}</span>
                </x-slot>

                <x-slot name="body">
                    ¿Estás seguro de que deseas eliminar este producto?, se eliminara toda la
                    información asociada incluidas sus imágenes.
                </x-slot>

                <x-slot name="actions">

                    <x-spinner wire:loading wire:target='deleteProduct' />

                    <x-button type="secondary" wire:loading.remove wire:target='deleteProduct'
                        @click="showDeleteProductConfirm = false">Cancelar</x-button>

                    <x-button wire:click='deleteProduct({{ $product->id }})'
                        wire:loading.remove wire:target='deleteProduct'
                        class="bg-red-600 hover:bg-red-500 mx-3">Eliminar</x-button>

                </x-slot>

            </x-modal>
        </div>
    </div>

</li>