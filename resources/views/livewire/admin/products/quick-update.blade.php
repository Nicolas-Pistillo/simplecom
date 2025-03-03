<div x-data="{ showQuickUpdate: false, tab: 'information' }" x-on:open-quick-update.window="showQuickUpdate = true">
    <x-drawer ref="showQuickUpdate" withoutClose panelClass="w-[50rem]" containerClasses="flex flex-col !p-0">

        @if ($product)
            <div class="pt-6 px-8">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h2 class="text-base font-semibold line-clamp-1">
                            {{ $product->name }}
                        </h2>
                        <small>Producto #{{ $product->id }}</small>
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
                      <!-- Tab component -->
                      <nav class="-mb-px flex space-x-6">
                        <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
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

            <div x-cloak x-show="tab === 'information'" x-transition.enter>
                @include('admin.products.partials.quick-update.information')
            </div>

            <div x-cloak x-show="tab === 'pricing'" x-transition.enter>
                @include('admin.products.partials.quick-update.pricing')
            </div>
        @endif

        @script
            <script>
                Livewire.on('open-quick-update', () => {
                    setTimeout(() => {
                        new Sortable(document.getElementById('previewImages'), {
                            handle: '.sortable-item',
                            animation: 250,
                            ghostClass: 'bg-gray-100',
                            store: {
                                set: (sortable) => Livewire.dispatch('change-images-order', {
                                    newOrder: sortable.toArray()
                                })
                            }
                        });
                    }, 500);
                })
            </script>
        @endscript

        <div class="flex shrink-0 gap-3 justify-end py-4 px-6 border-t mt-auto">
            <x-button @click="showQuickUpdate = false" size="large" type="secondary">Cancelar</x-button>
            <x-button size="large">Guardar</x-button>
        </div>
    </x-drawer>
</div>
