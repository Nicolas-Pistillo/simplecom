<section class="bg-white dark:bg-gray-900 py-6 px-8">
    <div class="mx-auto max-w-2xl">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new product</h2>
        <form action="#">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                </div>
                <div class="w-full">
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                    <input type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Product brand" required="">
                </div>
                <div class="w-full">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                    <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                </div>
                <div class="sm:col-span-3">
                    <label for="unit_cost" class="flex items-center text-sm font-medium leading-6 text-gray-900">
                        Costo unitario 
                        <x-icon code="help" class="ml-1 text-blue-500 cursor-help"
                        x-tooltip.raw.placement.top="Es el gasto que corre por tu cuenta 
                        por conseguir este producto para venderlo, se podrán calcular las 
                        ganancias del producto con este dato"  />
                    </label>
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 
                        focus-within:ring-inset focus-within:ring-blue-600">
                            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">$</span>
                            <input wire:model.blur="form.unit_cost" autocomplete="off" type="number" id="unit_cost" 
                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 
                            placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                        </div>
                        <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
                <div>
                    <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Weight (kg)</label>
                    <input type="number" name="item-weight" id="item-weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12" required="">
                </div> 
                <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here"></textarea>
                </div>
            </div>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Add product
            </button>
        </form>
    </div>
  </section>