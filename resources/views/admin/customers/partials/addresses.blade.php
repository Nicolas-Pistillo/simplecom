<div class="py-8">
    <h2 class="text-base font-semibold text-gray-900 flex items-center gap-1">
        <x-icon code="location_on" />
        Direcciones
    </h2>
    <div class="mt-4 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto" scrollbar-thin>
            <div class="inline-block min-w-full py-2 align-middle px-3">
                <div class="overflow-hidden shadow ring-1 ring-black/5 rounded-lg">
                    @if ($customer->addresses->isEmpty())
                        <div class="p-4 text-center">
                            <p class="text-sm text-gray-500">
                                No hay direcciones registradas por este cliente.
                            </p>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr class="text-center">
                                    <th scope="col"
                                        class="py-3.5 px-3 text-sm 
                                    font-semibold text-gray-900">
                                        Etiqueta
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 px-3 text-sm 
                                    font-semibold text-gray-900">
                                        Calle
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 px-3 text-sm 
                                    font-semibold text-gray-900">
                                        Detalles
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-sm 
                                    font-semibold text-gray-900 whitespace-nowrap">
                                        Código Postal
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-sm 
                                    font-semibold text-gray-900">
                                        Localidad
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-sm 
                                    font-semibold text-gray-900">
                                        Provincia
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($customer->addresses as $address)
                                    <tr wire:key='address-{{ $address->id }}'
                                        class="hover:bg-gray-50 cursor-pointer text-center"
                                        @click="window.open('{{ $address->map_url }}')">
                                        <td class="whitespace-nowrap py-4 px-3 text-sm font-medium text-gray-900">
                                            {{ $address->label }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm font-medium text-gray-900">
                                            {{ $address->street }} {{ $address->number }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm font-medium text-gray-900">
                                            {{ $address->references }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm font-medium text-gray-900">
                                            {{ $address->zipcode }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm font-medium text-gray-900">
                                            {{ $address->locality->name }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 px-3 text-sm font-medium text-gray-900">
                                            {{ $address->province->name }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>