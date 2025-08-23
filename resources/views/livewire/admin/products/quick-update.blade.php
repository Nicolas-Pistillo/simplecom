<div x-data="{ showQuickUpdate: false, tab: 'information' }" 
x-on:open-quick-update.window="showQuickUpdate = true"
x-on:close-quick-update.window="showQuickUpdate = false">
    <x-drawer ref="showQuickUpdate" withoutClose 
    panelClass="w-[50rem]" containerClasses="flex flex-col !p-0">

        @if ($product)
            <div class="pt-6 px-8">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h2 class="text-base font-semibold line-clamp-1">
                            {{ $product->name }}
                        </h2>

                        <div class="flex items-center gap-3 mt-2 flex-wrap">
                            @can('Editar productos')
                                <x-button type="secondary" size="small" class="inline-flex items-center gap-1"
                                :href="$product->editPageUrl()">
                                    <x-icon code="edit" />
                                    Edición completa
                                </x-button>
                            @endcan
                        </div>
                    </div>
                    <div class="ml-3 flex h-7 items-center">
                        <x-icon @click="showQuickUpdate = false" code="close"
                        class="cursor-pointer transition colors duration-300 text-[18px]
                        text-gray-600 p-2 bg-gray-100 rounded-full 
                        hover:bg-gray-200 focus:outline-none focus:ring"
                        x-tooltip.raw="Cerrar" />
                    </div>
                </div>
                <div class="no-select border-b border-gray-200 mt-5">
                    <div>
                      <nav class="-mb-px flex space-x-6">
                        <span @click="tab = 'information'" class="whitespace-nowrap 
                        border-b-2 px-1 pb-4 text-sm font-medium cursor-pointer"
                        :class="tab === 'information' 
                        ? 'border-blue-500 text-blue-600' 
                        : 'border-transparent hover:border-gray-300 text-gray-500 hover:text-gray-700'">
                            Informacion
                        </span>

                        <span @click="tab = 'pricing'" class="whitespace-nowrap 
                        border-b-2 px-1 pb-4 text-sm font-medium cursor-pointer"
                        :class="tab === 'pricing' 
                        ? 'border-blue-500 text-blue-600' 
                        : 'border-transparent hover:border-gray-300 text-gray-500 hover:text-gray-700'">
                            Venta
                        </span>
                      </nav>
                    </div>
                </div>
            </div>

            <div x-cloak x-show="tab === 'information'">
                @include('admin.products.partials.quick-update.information')
            </div>

            <div x-cloak x-show="tab === 'pricing'">
                <section class="bg-white py-6 px-8">
                    <div class="grid md:grid-cols-3 gap-4">
    
                        <x-form-input label="Precio" icon="attach_money" id="product_price" model="form.price"
                            type="number" />
    
                        <x-form-input label="Costo unitario" id="product_unit_cost" icon="attach_money"
                            model="form.unit_cost" type="number" />
    
                        <x-form-input label="Descuento" icon="percent" id="product_discount" model="form.discount_percent"
                            type="number" />
    
                        <x-form-input label="Unid. de compra mínima" icon="deployed_code" id="product_min_sale"
                            model="form.min_sale" type="number" />
    
                        <x-form-input label="Unid. de compra máxima" icon="deployed_code" id="product_max_sale"
                            model="form.max_sale" type="number" />
                    </div>
                </section>
            </div>
        @endif

        <div class="flex shrink-0 gap-3 justify-end py-4 px-6 border-t mt-auto">

            <x-spinner wire:loading wire:target='save' />

            <x-button @click="showQuickUpdate = false" size="large" type="secondary"
            wire:loading.remove wire:target='save'>
                Cancelar
            </x-button>

            @can('Editar productos')
                <x-button wire:click='save' size="large" wire:loading.remove wire:target='save'>
                    Guardar
                </x-button>
            @endcan
        </div>
    </x-drawer>
</div>
