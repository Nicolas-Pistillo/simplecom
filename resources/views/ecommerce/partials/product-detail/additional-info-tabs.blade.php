@php
    $tabs = [];

    if (!empty($product->description)) {
        $tabs[] = 'Descripción';
    }

    if (true) {
        $tabs[] = 'Reseñas';
    }

    if (FaqsService::hasQuestions()) {
        $tabs[] = 'Preguntas Frecuentes';
    }

    $current = !empty($tabs) ? $tabs[0] : '';

    $tabs = json_encode($tabs, JSON_UNESCAPED_UNICODE);
@endphp

<div class="mx-auto mt-6 lg:mt-0 w-full max-w-2xl lg:col-span-4 lg:max-w-none overflow-y-hidden">
    <x-tabs simple current="{!! $current !!}" containerClass="!w-full" tabs="{!! $tabs !!}">

        <div x-cloak x-show="current === 'Descripción'">
            <p class="mt-6 text-gray-500">
                {!! !empty($product->description) ? $product->description : 'Sin descripción' !!}
            </p>
        </div>

        <div x-cloak x-show="current === 'Reseñas'">
            @include('ecommerce.partials.product-detail.reviews')
        </div>

        <div x-cloak x-show="current === 'Preguntas Frecuentes'" class="text-sm text-gray-500">
            <dl x-data="{ selected: false }" class="lg:col-span-7 lg:mt-0 divide-y divide-gray-900/10">
                @foreach (FaqsService::get() as $faq)
                    <div wire:key='faq-{{ $faq->id }}' class="py-6 first:pt-0 last:pb-0"
                        @click="selected === {{ $faq->id }} ? selected = false : selected = {{ $faq->id }}">
                        <dt>
                            <button @click="open = !open" type="button"
                                class="flex w-full items-start justify-between text-left text-gray-900">
                                <span class="text-base/7 font-semibold">{{ $faq->question }}</span>
                                <span class="ml-6 flex h-7 items-center">
                                    <i class="material-symbols-outlined"
                                        x-text="selected === {{ $faq->id }} ? 'remove' : 'add'"></i>
                                </span>
                            </button>
                        </dt>
                        <div onclick="event.stopPropagation()" x-cloak x-show="selected === {{ $faq->id }}" x-collapse>
                            <dd class="mt-2 pr-12">
                                <p class="text-base/7 text-gray-600">{{ $faq->response }}</p>
                            </dd>
                        </div>
                    </div>
                @endforeach
            </dl>
        </div>
    </x-tabs>
</div>
