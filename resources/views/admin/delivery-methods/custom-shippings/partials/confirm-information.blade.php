<x-modal large ref="confirmOpen" title="Confirmar forma de envío" withCloseBtn>
    <div class="text-sm">
        <p class="mb-3">
            Estas por crear la forma de envío <b>{{ $form->name }}</b> con la siguiente configuración:
        </p>
        <ul class="pl-4 list-disc space-y-2">

            @if(!empty($form->price) || $form->price == '0')
                <li>
                    <b>Precio:</b> {{ $form->price == 0 ? 'Gratis' : '$' . priceFormat($form->price) }}
                </li>
            @endif

            @if (!empty($form->estimated_delivery))
                <li>
                    <b>Tiempo de entrega estimado:</b> {{ $form->estimated_delivery }}
                </li>
            @endif

            <li>
                <b>Cobertura de envío:</b> 
                {{ ShippingZoneType::tryFrom($form->shipping_zone_type)->name() }}
            </li>

            @if ($form->shipping_zone_type === ShippingZoneType::ByLocalities->value)
                <li>
                    <b>Provincias seleccionadas:</b> 
                    {{ $selectedProvinces->pluck('name')->implode(', ') }}
                </li>
                @if ($excludedLocalities->isNotEmpty())
                    <li>
                        <b>Localidades excluidas:</b> 
                        {{ $excludedLocalities->pluck('name')->implode(', ') }}
                    </li>
                @endif
            @endif

            @if ($form->shipping_zone_type === ShippingZoneType::ByZipcodes->value)
                
                @if ($form->zipcode_selection_type === ZipcodeSelectionType::ByRanges->value)
                    <li>
                        <b>Rangos de códigos postales:</b>
                        <ul class="pl-5 mt-1" style="list-style-type: circle">
                            @foreach ($form->zipcode_ranges as $range)
                                <li>{{ $range['from'] }} - {{ $range['to'] }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                @if ($form->zipcode_selection_type === ZipcodeSelectionType::FreeSelection->value)
                    <li class="max-w-[500px] overflow-hidden text-ellipsis">
                        <b>Códigos postales cubiertos:</b> {{ $form->zipcode_list }}
                    </li>
                @endif
                
            @endif
        </ul>
    </div>
    <x-slot name="actions">
        <x-button @click="confirmOpen = false" type="secondary">Cancelar</x-button>
        <x-button>Confirmar</x-button>
    </x-slot>
</x-modal>
