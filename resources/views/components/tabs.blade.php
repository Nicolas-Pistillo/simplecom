<div x-data="{ tabs: {{ $tabs }}, current: {{ isset($current) ? "'$current'" : 'false' }} }"
class="{{ $class ?? '' }}">

    @if (isset($simple))
        <div class="mx-auto sm:mx-0 w-max mb-6">
            <div>
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex gap-x-6" aria-label="Tabs">

                        <template x-for="tab in tabs">
                            <span @click="current = tab" x-text="tab"
                            class="whitespace-nowrap border-b-2 px-1 transition-colors duration-200
                            py-4 text-xs sm:text-sm font-medium cursor-pointer"
                            :class="current === tab ? 'text-blue-600 border-blue-600' : 'text-gray-500 hover:border-gray-300 hover:text-gray-700'">
                            </span>
                        </template>

                    </nav>
                </div>
            </div>
        </div>
    @else
        <div class="mb-6">
            <nav class="flex divide-x divide-gray-200 rounded-lg overflow-hidden shadow" aria-label="Tabs">
                
                <template x-for="tab in tabs">
                    <span @click="current = tab"
                    class="cursor-pointer no-select group transition duration-200 relative min-w-0 flex-1 p-2 sm:p-3 text-center text-sm font-medium"
                    :class="current === tab ? 'text-blue-700 bg-blue-50/50' : 'text-gray-500 hover:text-gray-700 bg-white hover:bg-gray-50'">
                        <span x-text="tab" class="text-xs sm:text-sm"></span>
                        <span class="absolute inset-x-0 transition duration-200 bottom-0 h-0.5"
                        :class="current === tab ? 'bg-blue-500' : 'bg-transparent'"></span>
                    </span>
                </template>

            </nav>
        </div>
    @endif

    {{ $slot }}

</div>