<div>
    <ul role="list" class="mt-6 divide-y divide-gray-200 border-t border-gray-200 text-sm font-medium text-gray-500">
        @foreach ($order->items as $item)
            <li x-data="{detailItemOpen: false}" wire:key='{{ $item->id }}'
            class="no-select flex space-x-6 py-6 items-center hover:bg-gray-50 
            transition duration-200 cursor-pointer" @click="detailItemOpen = !detailItemOpen">

                <img src="{{ $item->product->first_image }}" alt="Imagen producto"
                class="h-10 w-10 flex-none rounded-md bg-gray-100 object-contain">

                <div class="flex-auto space-y-1">

                    <h3 class="text-gray-900 line-clamp-2">
                        {{ $item->product->name }} 
                    </h3>

                    <p class="text-xs text-gray-500">
                        Cantidad: {{ $item->quantity }}
                    </p>

                    @if ($item->variant && isset($item->variant->options))
                        @foreach ($item->variant->options as $variantOption)
                            <p class="text-xs text-gray-500">
                                {{ $variantOption->attribute->name }}:
                                {{ $variantOption->attributeValue->name }}
                            </p>
                        @endforeach
                    @endif
                </div>

                <p class="text-right font-medium text-gray-900">
                    ${{ priceFormat($item->total) }} <br>
                </p>
            </li>
        @endforeach
        {{-- <section x-show="detailItemOpen" x-cloak class="relative py-8 sm:p-8 cursor-default">
                    <div class="w-full max-w-7xl mx-auto px-4 lg:px-8 xl:px-14 relative">
                        <div class="w-full relative flex justify-center">
                            <div class="w-full h-full fixed top-0 left-0 z-[60] overflow-x-hidden overflow-y-auto">
                                <div class="opacity-1 ease-out sm:max-w-sm sm:w-full m-5 relative top-1/2 -translate-y-1/2 sm:mx-auto modal-open:opacity-100 transition-all modal-open:duration-500">
                                    <div class="flex items-start bg-white p-6 rounded-lg">
                                        <div class="block w-full">
            
                                            <div class="flex items-center justify-between mb-1">
                                                <h6 class="text-lg font-bold leading-8 text-gray-900">
                                                    <div class="flex items-center">
                                                        <img class="h-8 w-8 mr-2 object-cover rounded-full" 
                                                        src="{{ $item->product->first_image }}">
                                                        <span class="line-clamp-1">{{ $item->name }}</span>
                                                    </div>
                                                </h6>
            
                                                <x-icon code="close" @click="detailItemOpen = false"
                                                class="transition colors duration-300 text-[18px] ml-1
                                                cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                              hover:bg-gray-200 focus:outline-none focus:ring" />
                                            </div>
            
                                            <p class="text-xs font-normal text-gray-500 mb-5">
                                                Note: Some payment providers issue a temporary authorization charge
                                            </p>
            
                                            <div class="flex flex-col gap-4 mb-5">
                                                <div class="relative">
                                                    <label class="flex  items-center mb-2 text-gray-600 text-xs font-medium">Card
                                                        Number
                                                    </label>
                                                    <input type="text" id="default-search"
                                                        class="block w-full  px-4 py-2 text-sm font-normal shadow-xs text-gray-900 bg-transparent border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none leading-relaxed"
                                                        placeholder="1234 5678 9123 4567" required="">
                                                </div>
            
                                                <div class="flex items-center gap-4">
                                                    <div class="relative">
                                                        <label
                                                            class="flex  items-center mb-2 text-gray-600 text-xs font-medium">Expiration
                                                        </label>
                                                        <input type="text" id="default-search"
                                                            class="block w-full  px-4 py-2 text-sm font-normal shadow-xs text-gray-900 bg-transparent border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none leading-relaxed"
                                                            placeholder="01/23" required="">
                                                    </div>
                                                    <div class="relative">
                                                        <label class="flex  items-center mb-2 text-gray-600 text-xs font-medium">CVC
                                                        </label>
                                                        <input type="text" id="default-search"
                                                            class="block w-full  px-4 py-2 text-sm font-normal shadow-xs text-gray-900 bg-transparent border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none leading-relaxed"
                                                            placeholder="201" required="">
                                                    </div>
                                                </div>
            
                                                <div class="relative">
                                                    <label class="flex  items-center mb-2 text-gray-600 text-xs font-medium">Name on
                                                        Card
                                                    </label>
                                                    <input type="text" id="default-search"
                                                        class="block w-full  px-4 py-2 text-sm font-normal shadow-xs text-gray-900 bg-transparent border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none leading-relaxed"
                                                        placeholder="John smith" required="">
                                                </div>
                                            </div>
            
                                            <div class="flex items-center gap-4">
                                                <button
                                                    class="py-2.5 px-3.5 w-full text-center rounded-lg border border-blue-600 hover:bg-blue-50 text-sm font-medium text-blue-600 transition-all duration-500 close-modal-button"
                                                    data-pd-overlay="#modalBox-21" data-modal-target="modalBox-21">Cancel</button>
                                                <button
                                                    class="py-2.5 px-3.5 w-full text-center rounded-lg bg-blue-600 transition-all duration-500 hover:bg-blue-700 text-sm font-medium text-white close-modal-button"
                                                    data-pd-overlay="#modalBox-21" data-modal-target="modalBox-21">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="backdrop" class="fixed top-0 left-0 w-full h-full bg-black/50 z-[50]">
                            </div>
                        </div>
                    </div>
                </section> --}}
    </ul>

    <dl class="space-y-4 border-t border-gray-200 pt-4 text-sm font-medium text-gray-600">
        <div class="flex justify-between">
            <dt>Subtotal</dt>
            <dd class="text-gray-900">
                ${{ priceFormat($order->subtotal) }}
            </dd>
        </div>

        @if ($order->shipping_cost > 0)
            <div class="flex justify-between">
                <dt class="flex flex-col">

                    Envío

                    @if ($order->shipping)
                        <small class="text-gray-500 font-semibold">
                            {{ $order->shipping->provider_label }}
                        </small>
                    @endif
                </dt>
                <dd class="text-gray-900">
                    ${{ priceFormat($order->shipping_cost) }}
                </dd>
            </div>
        @endif

        <div
            class="flex items-center justify-between border-t 
        border-gray-200 pt-6 text-gray-900 font-semibold">
            <dt class="text-base">Total</dt>
            <dd class="text-base">
                ${{ priceFormat($order->total) }}
            </dd>
        </div>
    </dl>

    {{-- <dl class="mt-4 grid grid-cols-2 gap-x-4 text-sm text-gray-600">
      <div>
        <dt class="font-medium text-gray-900">Shipping Address</dt>
        <dd class="mt-2">
          <address class="not-italic">
            <span class="block">Kristin Watson</span>
            <span class="block">7363 Cynthia Pass</span>
            <span class="block">Toronto, ON N3Y 4H8</span>
          </address>
        </dd>
      </div>
      <div>
        <dt class="font-medium text-gray-900">Payment Information</dt>
        <dd class="mt-2 space-y-2 sm:flex sm:space-y-0 sm:space-x-4">
          <div class="flex-none">
            <svg aria-hidden="true" width="36" height="24" viewBox="0 0 36 24" class="h-6 w-auto">
              <rect width="36" height="24" rx="4" fill="#224DBA"></rect>
              <path d="M10.925 15.673H8.874l-1.538-6c-.073-.276-.228-.52-.456-.635A6.575 6.575 0 005 8.403v-.231h3.304c.456 0 .798.347.855.75l.798 4.328 2.05-5.078h1.994l-3.076 7.5zm4.216 0h-1.937L14.8 8.172h1.937l-1.595 7.5zm4.101-5.422c.057-.404.399-.635.798-.635a3.54 3.54 0 011.88.346l.342-1.615A4.808 4.808 0 0020.496 8c-1.88 0-3.248 1.039-3.248 2.481 0 1.097.969 1.673 1.653 2.02.74.346 1.025.577.968.923 0 .519-.57.75-1.139.75a4.795 4.795 0 01-1.994-.462l-.342 1.616a5.48 5.48 0 002.108.404c2.108.057 3.418-.981 3.418-2.539 0-1.962-2.678-2.077-2.678-2.942zm9.457 5.422L27.16 8.172h-1.652a.858.858 0 00-.798.577l-2.848 6.924h1.994l.398-1.096h2.45l.228 1.096h1.766zm-2.905-5.482l.57 2.827h-1.596l1.026-2.827z" fill="#fff"></path>
            </svg>
            <p class="sr-only">Visa</p>
          </div>
          <div class="flex-auto">
            <p class="text-gray-900">Ending with 4242</p>
            <p>Expires 12 / 21</p>
          </div>
        </dd>
      </div>
    </dl> --}}
</div>
