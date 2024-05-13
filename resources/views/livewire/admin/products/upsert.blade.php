<div>

    <form wire:submit='save' class="pb-6" x-data="{ showNotification: false }" x-on:open-notification.window="showNotification = true">

        {{-- Success notification toast --}}
        <x-toast ref="showNotification" type="success" title="{{ $notificationMessage }}" />

        <div class="space-y-12">

            {{-- Published & edit alert block --}}
            <div class="grid grid-cols-1 space-y-4 md:space-y-0 gap-x-8 border-gray-900/10 md:grid-cols-3">

                {{-- Published switch --}}
                <x-switch wireModel='form.published' :label="$product ? 'Publicar' : 'Publicar al finalizar'" />

                {{-- Edit alert --}}
                @if ($product)
                    <x-alert class="col-span-2">Estas editando el producto
                        <span class="font-semibold">{{ "#$product->id - $product->name" }}</span>
                    </x-alert>
                @endif
            </div>

            {{-- Identification info block | Identificación --}}
            @include('admin.products.partials.upsert-form.identification-block')

            {{-- Pricing block | Venta --}}
            @include('admin.products.partials.upsert-form.pricing-block')

            {{-- Images block | Imágenes --}}
            @include('admin.products.partials.upsert-form.images-block')

            {{-- Variants block | Variantes --}}
            @include('admin.products.partials.upsert-form.variants-block')

            {{-- Tags block | Etiquetas --}}
            @include('admin.products.partials.upsert-form.tags-block')

            {{-- Measures & stock block | Dimensiones y stock --}}
            @include('admin.products.partials.upsert-form.measures-stock-block')
        </div>

        <div class="mt-6 flex items-center justify-between flex-wrap gap-x-6">

            <span class="text-red-500 text-xs flex items-center my-1">
                @if ($errors->any())
                    <x-icon code="error" class="mr-1" /> Hay errores o campos sin completar
                @endif
            </span>

            <x-button wire:loading.remove wire:target='save' submit size="large" class="flex items-center">
                @if ($product)
                    <x-icon code="sync" class="mr-1" />
                    Actualizar producto
                @else
                    <x-icon code="add_circle" class="mr-1" />
                    Crear producto
                @endif
            </x-button>

            <div wire:loading wire:target='save' class="my-1">
                <div class="flex items-center font-semibold">
                    <x-spinner class="mr-2" />
                    Guardando cambios...
                </div>
            </div>

        </div>

    </form>

</div>
