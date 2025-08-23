@for ($i = 0; $i < 3; $i++)
    <div class="flex space-x-4 text-sm text-gray-500">

        @php
            $name = fake()->name();
        @endphp

        <div class="flex-none">
            <img src="{{ initialsAvatar(compact('name')) }}" alt=""
            class="w-8 h-8 rounded-full bg-gray-100">
        </div>

        <div class="pb-8">

            <h3 class="font-medium text-gray-900">{{ $name }}</h3>

            <p><time datetime="2021-07-16">July 16, 2021</time></p>

            <div class="flex items-center">
                <x-review-star filled />

                <x-review-star filled />

                <x-review-star filled />

                <x-review-star filled />

                <x-review-star :filled="fake()->boolean()" />
            </div>

            <div class="mt-4 text-sm/6 text-gray-500">
                <p>{{ fake()->paragraphs(2, true) }}</p>
            </div>
        </div>
    </div>
@endfor
