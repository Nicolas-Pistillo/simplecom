@extends('layouts.ecommerce')

@section('content')
    <div class="relative bg-white">
        <div class="mx-auto">
            <div class="shadow-md">
                <div class="relative h-80">
                    <img class="absolute inset-0 h-full w-full bg-gray-50 object-cover"
                        src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=focalpoint&fp-x=.4&w=2560&h=3413&&q=80"
                        alt="">
                </div>
            </div>
            <div>
                <div class="mx-auto pb-24 pt-16 px-16 sm:pb-32 sm:pt-20">
                    <p class="text-base font-semibold leading-7 text-indigo-600">Sobre nosotros</p>
                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                        {{ tenant()->ecommerce_name ?? tenant()->name }}
                    </h1>
                    <div class="mt-10 text-base leading-7 text-gray-700">
                        <p>Faucibus commodo massa rhoncus, volutpat. Dignissim sed eget risus enim. Mattis mauris semper sed
                            amet vitae sed turpis id. Id dolor praesent donec est. Odio penatibus risus viverra tellus
                            varius sit neque erat velit. Faucibus commodo massa rhoncus, volutpat. Dignissim sed eget risus
                            enim. Mattis mauris semper sed amet vitae sed turpis id.</p>
                        <p class="mt-8">Et vitae blandit facilisi magna lacus commodo. Vitae sapien duis odio id et. Id
                            blandit molestie auctor fermentum dignissim. Lacus diam tincidunt ac cursus in vel. Mauris
                            varius vulputate et ultrices hac adipiscing egestas. Iaculis convallis ac tempor et ut. Ac lorem
                            vel integer orci.</p>
                        <h2 class="mt-16 text-2xl font-bold tracking-tight text-gray-900">No server? No problem.</h2>
                        <p class="mt-6">Id orci tellus laoreet id ac. Dolor, aenean leo, ac etiam consequat in. Convallis
                            arcu ipsum urna nibh. Pharetra, euismod vitae interdum mauris enim, consequat vulputate nibh.
                            Maecenas pellentesque id sed tellus mauris, ultrices mauris. Tincidunt enim cursus ridiculus mi.
                            Pellentesque nam sed nullam sed diam turpis ipsum eu a sed convallis diam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
