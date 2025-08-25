@if (IncentiveService::hasIncentives())
    <section class="py-8 relative">
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach (IncentiveService::get() as $incentive)
                    <div wire:key='incentive-{{ $incentive->id }}'
                        class="flex max-sm:flex-col max-sm:items-center group gap-x-6 gap-y-2">
                        <span class="w-16 h-14 rounded-full p-4 flex items-center justify-center 
                            shadow-sm shadow-transparent transition-all duration-500 bg-gray-100">
                            <x-icon :code="$incentive->type->icon()" />
                        </span>
                        <div class="flex flex-col">
                            <h6 class="font-semibold text-lg text-black mb-1 max-sm:text-center">
                                {{ $incentive->title }}
                            </h6>
                            <p class="font-normal text-sm text-gray-500 mb-4 max-sm:text-center">
                                {{ $incentive->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
