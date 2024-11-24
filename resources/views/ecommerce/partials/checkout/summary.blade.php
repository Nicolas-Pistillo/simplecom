<div aria-labelledby="summary-heading" class="mx-auto lg:mr-10 flex w-full max-w-md flex-col bg-gray-50">

    <div class="flex items-center justify-between px-3 sm:px-0">

        <h2 class="text-lg font-medium text-gray-900">Resumen</h2>

        <x-button :href="route('ecommerce.products')" type="soft" class="flex items-center">
            Seguir comprando
            <x-icon code="shopping_cart" class="ml-1" />
        </x-button>
    </div>

    <div class="mt-2 rounded-lg border border-gray-200 overflow-hidden bg-white shadow-sm">
        <ul role="list" class="divide-y divide-gray-200 overflow-y-auto sm:max-h-[350px]" scrollbar-thin>

            @foreach (Cart::content() as $product)
                <li wire:key='{{ $product->rowId }}'
                    class="flex px-4 py-6 sm:px-6 transition-colors duration-300 hover:bg-gray-50">

                    <div class="shrink-0">
                        <img src="{{ $product->options->image_url }}" alt="{{ $product->name }}"
                        class="w-14 h-14 rounded-md object-contain">
                    </div>

                    <div class="ml-6 flex flex-1 flex-col">
                        <div class="flex">
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm">
                                    <a href="{{ $product->model->detailPageUrl() }}"
                                        class="font-medium text-gray-700 hover:text-blue-600
                                    transition-colors duration-300">
                                        {{ $product->name }}
                                    </a>
                                </h4>
                                @if (count($product->options->variant_attribute_names))
                                    <div class="flex flex-col text-xs">
                                        @foreach ($product->options->variant_attribute_names as $name => $value)
                                            <span class="mt-1 text-gray-500">
                                                {{ $name }}: {{ $value }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="ml-4 flow-root shrink-0">
                                <button wire:click="removeItem('{{ $product->rowId }}')"
                                    x-tooltip.raw.placement.left="Quitar del carrito" type="button"
                                    class="-m-2.5 flex items-center transition
                                duration-300 justify-center p-2.5 bg-inherit text-gray-400 
                                hover:text-red-500">
                                    <x-icon code="delete" />
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-1 items-end justify-between pt-2">

                            <p class="mt-1 text-sm font-medium text-gray-900">
                                ${{ priceFormat($product->price) }}
                            </p>

                            <div class="flex items-center gap-2">
                                <button wire:click="changeQty('subtract' ,'{{ $product->rowId }}')"
                                class="group rounded-full border border-gray-200 shadow-sm shadow-transparent 
                                p-2 flex items-center justify-center bg-white transition-all duration-500 hover:shadow-gray-200 
                                hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                                    <x-icon code="remove" style="font-size: 16px" />
                                </button>

                                <input type="text" readonly
                                class="border border-gray-200 rounded-full w-11
                                aspect-square outline-none text-gray-900 font-semibold 
                                text-sm py-1.5 px-3 bg-gray-100 text-center"
                                    placeholder="{{ $product->qty }}">

                                <button wire:click="changeQty('add' ,'{{ $product->rowId }}')"
                                class="group rounded-full border border-gray-200 shadow-sm shadow-transparent 
                                p-2 flex items-center justify-center bg-white transition-all duration-500 hover:shadow-gray-200 
                                hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                                    <x-icon code="add" style="font-size: 16px" />
                                </button>
                            </div>
                        </div>

                        @error("product-$product->rowId-selection")
                            <span class="inline-flex mt-3 text-red-500 text-xs">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </li>
            @endforeach
        </ul>
        <dl class="space-y-6 border-t border-gray-200 px-4 py-6 sm:px-6">
            <div class="flex items-center justify-between">
                <dt class="text-sm">Subtotal</dt>
                <dd class="text-sm font-medium text-gray-900">
                    ${{ priceFormat(Cart::subtotal()) }}
                </dd>
            </div>
            {{-- <div class="flex items-center justify-between">
                <dt class="text-sm">Impuestos</dt>
                <dd class="text-sm font-medium text-gray-900">
                    ${{ priceFormat(Cart::tax()) }}
                </dd>
            </div> --}}
            <div class="flex items-center justify-between">
                <dt class="text-sm">Envío</dt>
                <dd class="text-sm font-medium text-gray-900">
                    @if ($selected_shipping)
                    @else
                        No calculado
                    @endif
                </dd>
            </div>
            <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                <dt class="text-base font-semibold">Total</dt>
                <dd class="text-base font-semibold text-gray-900">
                    ${{ priceFormat(Cart::total()) }}
                </dd>
            </div>
        </dl>
    </div>
</div>