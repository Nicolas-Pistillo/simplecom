<div>
    <div class="sm:flex sm:items-center mb-8">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Mensajes</h1>
            <p class="mt-2 text-sm text-gray-700">
                Este es tu lugar para gestionar las consultas de tus clientes y 
                recibir notificaciones informativas de parte de Simplecom.
            </p>
        </div>
    </div>

    @if ($messages->isEmpty())
        <div class="my-16 text-center">
            <img src="{{ URL::to('img/illustrations/new_message.svg') }}" class="h-48 mx-auto mb-4" alt="no-data-img">
            <div class="mb-4">
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Aún no recibiste mensajes</h3>
                <p class="mt-1 mb-4 text-sm text-gray-500">
                    Tus mensajes y consultas aparecerán aquí una vez que los recibas.
                </p>
            </div>
        </div>
    @else
        <ul role="list" class="divide-y divide-gray-100">
            @foreach ($messages as $message)
                <li wire:key='{{ $message->id }}' class="relative flex justify-between 
                gap-x-6 px-4 py-5 hover:bg-gray-50 cursor-pointer">
                    <div class="flex min-w-0 gap-x-4">
                        <img class="h-10 w-10 flex-none rounded-full bg-gray-50"
                        src="{{ initialsAvatar(['name' => $message->sender_name]) }}">
                        <div class="min-w-max flex-auto">
                            <p class="text-sm/6 font-semibold text-gray-900">
                                <a href="#">
                                    {{ $message->sender_name }}
                                </a>
                            </p>
                            <p class="mt-1 flex text-xs/5 text-gray-500">
                                <a href="mailto:michael.foster@example.com"
                                class="relative truncate hover:underline">{{ $message->sender_email }}</a>
                            </p>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-x-4">
                        <h6 class="hidden md:block text-xs text-gray-700 max-w-[25rem] 
                        truncate">
                            {{ $message->message }}
                        </h6>
                        <div class="hidden sm:flex sm:flex-col sm:items-end">
                            <x-badge :color="$message->topic->color()">
                                {{ $message->topic->name() }}
                            </x-badge>
                        </div>
                        <x-icon code="chevron_right" class="text-gray-400" />
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
