@extends('layouts.ecommerce')

@section('content')
    <section class="sm:max-w-4xl mx-auto">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
            <div>
                <h2 class="text-3xl font-semibold tracking-tight text-pretty 
                text-gray-900 sm:text-4xl mb-12">
                    Preguntas Frecuentes
                </h2>

                <dl x-data="{ selected: false }" class="divide-y divide-gray-900/10">

                    @foreach (FaqsService::get() as $faq)
                        <div @click="selected === {{ $faq->id }} ? selected = false : selected = {{ $faq->id }}"
                            class="py-6 first:pt-0 last:pb-0">
                            <dt>
                                <button @click="open = !open" type="button"
                                    class="flex w-full items-start 
                                    justify-between text-left text-gray-900">
                                    <span class="text-sm sm:text-base/7 font-semibold">{{ $faq->question }}</span>
                                    <span class="ml-6 flex h-7 items-center">
                                        <i class="material-symbols-outlined"
                                            x-text="selected === {{ $faq->id }} ? 'remove' : 'add'"></i>
                                    </span>
                                </button>
                            </dt>
                            <div x-cloak x-show="selected === {{ $faq->id }}" x-collapse>
                                <dd class="mt-2 pr-12">
                                    <p class="text-sm sm:text-base/7 text-gray-600">{{ $faq->response }}</p>
                                </dd>
                            </div>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </section>
@endsection
