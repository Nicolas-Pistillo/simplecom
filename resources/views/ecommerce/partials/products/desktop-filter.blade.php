<section class="hidden lg:block">
    <h3 class="sr-only">Categories</h3>
    <ul role="list"
        class="space-y-4 border-b border-gray-200 pb-6 text-sm font-medium text-gray-900">
        <li>
            <a href="#">Tote s</a>
        </li>
        <li>
            <a href="#">Backpacks</a>
        </li>
        <li>
            <a href="#">Travel Bags</a>
        </li>
        <li>
            <a href="#">Hip Bags</a>
        </li>
        <li>
            <a href="#">Laptop Sleeves</a>
        </li>
    </ul>

    <div x-data="{ open: false }" class="border-b border-gray-200 py-6">
        <h3 class="-my-3 flow-root">
            <!-- Expand/collapse section button -->
            <button type="button" @click="open = !open"
                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                aria-controls="filter-section-0" aria-expanded="false">
                <span class="font-medium text-gray-900">Color</span>
                <span class="ml-6 flex items-center">

                    <x-icon x-show="!open" x-cloak code="expand_more" />

                    <x-icon x-show="open" x-cloak code="expand_less" />

                </span>
            </button>
        </h3>
        <!-- Filter section, show/hide based on section state. -->
        <div x-show="open" x-cloak x-collapse.duration.300 class="pt-6"
            id="filter-section-0">
            <div class="space-y-4">
                <div class="flex items-center">
                    <input id="filter-color-0" name="color[]" value="white" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-0"
                        class="ml-3 text-sm text-gray-600">White</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-1" name="color[]" value="beige" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-1"
                        class="ml-3 text-sm text-gray-600">Beige</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-2" name="color[]" value="blue" type="checkbox"
                        checked
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-2"
                        class="ml-3 text-sm text-gray-600">Blue</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-3" name="color[]" value="brown" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-3"
                        class="ml-3 text-sm text-gray-600">Brown</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-4" name="color[]" value="green" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-4"
                        class="ml-3 text-sm text-gray-600">Green</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-5" name="color[]" value="purple" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-5"
                        class="ml-3 text-sm text-gray-600">Purple</label>
                </div>
            </div>
        </div>
    </div>

    <div x-data="{ open: false }" class="border-b border-gray-200 py-6">
        <h3 class="-my-3 flow-root">
            <!-- Expand/collapse section button -->
            <button type="button" @click="open = !open"
                class="flex w-full items-center justify-between 
                    bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                aria-controls="filter-section-0" aria-expanded="false">
                <span class="font-medium text-gray-900">Color</span>
                <span class="ml-6 flex items-center">

                    <x-icon x-show="!open" x-cloak code="expand_more" />

                    <x-icon x-show="open" x-cloak code="expand_less" />

                </span>
            </button>
        </h3>
        <!-- Filter section, show/hide based on section state. -->
        <div x-show="open" x-cloak x-collapse.duration.300 class="pt-6">
            <div class="space-y-4">
                <div class="flex items-center">
                    <input id="filter-color-0" name="color[]" value="white" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-0"
                        class="ml-3 text-sm text-gray-600">White</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-1" name="color[]" value="beige" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-1"
                        class="ml-3 text-sm text-gray-600">Beige</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-2" name="color[]" value="blue" type="checkbox"
                        checked
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-2"
                        class="ml-3 text-sm text-gray-600">Blue</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-3" name="color[]" value="brown" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-3"
                        class="ml-3 text-sm text-gray-600">Brown</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-4" name="color[]" value="green" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-4"
                        class="ml-3 text-sm text-gray-600">Green</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-5" name="color[]" value="purple" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-5"
                        class="ml-3 text-sm text-gray-600">Purple</label>
                </div>
            </div>
        </div>
    </div>

    <div x-data="{ open: false }" class="border-b border-gray-200 py-6">
        <h3 class="-my-3 flow-root">
            <!-- Expand/collapse section button -->
            <button type="button" @click="open = !open"
                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                aria-controls="filter-section-0" aria-expanded="false">
                <span class="font-medium text-gray-900">Color</span>
                <span class="ml-6 flex items-center">

                    <x-icon x-show="!open" x-cloak code="expand_more" />

                    <x-icon x-show="open" x-cloak code="expand_less" />

                </span>
            </button>
        </h3>
        <!-- Filter section, show/hide based on section state. -->
        <div x-show="open" x-cloak x-collapse.duration.300 class="pt-6">
            <div class="space-y-4">
                <div class="flex items-center">
                    <input id="filter-color-0" name="color[]" value="white" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-0"
                        class="ml-3 text-sm text-gray-600">White</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-1" name="color[]" value="beige" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-1"
                        class="ml-3 text-sm text-gray-600">Beige</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-2" name="color[]" value="blue" type="checkbox"
                        checked
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-2"
                        class="ml-3 text-sm text-gray-600">Blue</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-3" name="color[]" value="brown" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-3"
                        class="ml-3 text-sm text-gray-600">Brown</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-4" name="color[]" value="green" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-4"
                        class="ml-3 text-sm text-gray-600">Green</label>
                </div>
                <div class="flex items-center">
                    <input id="filter-color-5" name="color[]" value="purple" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="filter-color-5"
                        class="ml-3 text-sm text-gray-600">Purple</label>
                </div>
            </div>
        </div>
    </div>
</section>