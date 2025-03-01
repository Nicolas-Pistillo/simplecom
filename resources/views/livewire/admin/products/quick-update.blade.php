<div x-data="{showQuickUpdate: false}" 
x-on:open-quick-update.window="showQuickUpdate = true">
    <x-drawer ref="showQuickUpdate" withoutClose panelClass="w-[50rem]">
        @if ($product)
            <div class="mb-5 pb-3 border-b">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-semibold">
                        {{ $product->name }}
                    </h2>
                    <div class="ml-3 flex h-7 items-center">
                        <x-icon @click="showQuickUpdate = false" code="close" 
                        class="cursor-pointer transition colors duration-300 text-[18px]
                        text-gray-600 p-2 bg-gray-100 rounded-full 
                        hover:bg-gray-200 focus:outline-none focus:ring" 
                        x-tooltip.raw="Cerrar" />
                    </div>
                </div>
                <div class="mt-1">
                    <p class="text-sm">Edición rápida</p>
                </div>
            </div>
        
            <div class="grid gap-4 sm:grid-cols-3 sm:gap-6 ">
                <div class="space-y-4 sm:col-span-2 sm:space-y-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                            Nombre
                        </label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border 
                        border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 
                        focus:border-primary-600 block w-full p-2.5" 
                        placeholder="Nombre del producto" autocomplete="off">
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">
                            Descripción
                        </label>
                        <div class="w-full border border-gray-200 rounded-lg bg-gray-50">
                            <div class="p-3 bg-white rounded-lg">
                                <textarea id="description" rows="6" class="block w-full p-0 text-sm 
                                text-gray-800 bg-white border-0 focus:ring-0" 
                                placeholder="Usa una descripción llamativa de tu producto"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="block mb-2 text-sm font-medium text-gray-900">Product Images</span>
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="relative p-2 bg-gray-100 rounded-lg sm:w-36 sm:h-36">
                                <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-side-image.png" alt="imac image">
                                <button type="button" class="absolute text-red-600 bottom-1 left-1">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Remove image</span>
                                </button>
                            </div>
                            <div class="relative p-2 bg-gray-100 rounded-lg sm:w-36 sm:h-36">
                                <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-front-image.png" alt="imac image">
                                <button type="button" class="absolute text-red-600 bottom-1 left-1">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Remove image</span>
                                </button>
                            </div>
                            <div class="relative p-2 bg-gray-100 rounded-lg sm:w-36 sm:h-36">
                                <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-back-image.png" alt="imac image">
                                <button type="button" class="absolute text-red-600 bottom-1 left-1">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Remove image</span>
                                </button>
                            </div>
                            <div class="relative p-2 bg-gray-100 rounded-lg sm:w-36 sm:h-36">
                                <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-side-image.png" alt="imac image">
                                <button type="button" class="absolute text-red-600 bottom-1 left-1">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Remove image</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500">
                                        <span class="font-semibold">Click to upload</span>
                                        or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden">
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center mb-4">
                        <input id="product-options" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2">
                        <label for="product-options" class="ml-2 text-sm text-gray-500">Product has multiple options, like different colors or sizes</label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input datepicker="" id="datepicker" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 datepicker-input" value="15/08/2022" placeholder="Select date">
                    </div>
                </div>
                <div class="space-y-4 sm:space-y-6">
                    <div>
                        <label for="product-brand" class="block mb-2 text-sm font-medium text-gray-900">Brand</label>
                        <input type="text" id="product-brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" value="Apple" placeholder="Product Brand" required="">
                    </div>
                    <div><label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label><select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"><option selected="">Electronics</option><option value="TV">TV/Monitors</option><option value="PC">PC</option><option value="GA">Gaming/Console</option><option value="PH">Phones</option></select></div>
                    <div>
                        <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900">Item Weight (kg)</label>
                        <input type="number" name="item-weight" id="item-weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="12" placeholder="Ex. 12" required="">
                    </div>
                    <div>
                        <label for="length" class="block mb-2 text-sm font-medium text-gray-900">Length (cm)</label>
                        <input type="number" name="length" id="lenght" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="105" placeholder="Ex. 105" required="">
                    </div>
                    <div>
                        <label for="breadth" class="block mb-2 text-sm font-medium text-gray-900">Breadth (cm)</label>
                        <input type="number" name="breadth" id="breadth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="15" placeholder="Ex. 15" required="">
                    </div>
                    <div>
                        <label for="width" class="block mb-2 text-sm font-medium text-gray-900">Width (cm)</label>
                        <input type="number" name="width" id="width" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="23" placeholder="Ex. 23" required="">
                    </div>
                </div>
            </div>
        @endif
    </x-drawer>
</div>
