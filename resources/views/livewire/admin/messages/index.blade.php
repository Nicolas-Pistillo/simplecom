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

    @if (!$has_messages)
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

        @include('admin.messages.partials.filters')

        @if ($messages->isEmpty())
            <div class="text-center py-8">

                <img src="http://romagnoli.localhost/img/illustrations/cancel.svg" 
                class="h-52 mx-auto mb-4" alt="no-data-img">

                <div class="mb-4">
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">
                        No se encontraron resultados
                    </h3>
                    <p class="mt-1 mb-4 text-sm text-gray-500">
                        Revisa tu búsqueda o los filtros aplicados
                    </p>
                    <x-button wire:click='clearFilters' type="secondary">
                        Limpiar filtros
                    </x-button>
                </div>
            </div>
        @else
            <ul role="list" class="divide-y divide-gray-100">
                @foreach ($messages as $message)
                    <li wire:key='{{ $message->id }}'>
                        <a href="{{ $message->pageUrl() }}" class="flex flex-wrap items-center 
                        justify-between gap-x-10 gap-y-4 py-5 sm:flex-nowrap transition-colors 
                        duration-200 hover:bg-gray-50 cursor-pointer px-1.5 rounded">
                            <dl class="w-full sm:w-auto flex flex-wrap sm:flex-none justify-between gap-x-8 gap-y-2">
                                <div class="flex">
                                    <div class="flex items-center min-w-0 gap-x-4">

                                        <input type="checkbox" wire:model.live='selected_messages' 
                                        value="{{ $message->id }}" class="rounded w-5 h-5"
                                        @if(in_array($message->id, $selected_messages)) checked @endif>

                                        <img class="h-10 w-10 flex-none rounded-full bg-gray-50"
                                        src="{{ initialsAvatar(['name' => $message->sender_name]) }}">

                                        <div class="min-w-max flex-auto">
                                            <p class="text-sm text-gray-900 
                                            {{ !$message->read ? 'font-semibold' : '' }}">
                                                {{ $message->sender_name }}
                                            </p>
                                            <small class="text-xs text-gray-500">
                                                {{ getElapsedTime($message->created_at) }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <dt>
                                    <x-badge :color="$message->topic->color()">
                                        {{ $message->topic->name() }}
                                    </x-badge>
                                </dt>
                            </dl>
                            <div class="mr-auto">
                                <p class="text-sm/6 text-gray-900 line-clamp-2">
                                    <span class="{{ !$message->read ? 'font-semibold' : '' }}">{{ $message->subject }}</span> <br>
                                    <span class="text-xs">{{ $message->message }} </span>
                                </p>
                                <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
                                    <p class="flex items-center gap-1">
                                        @if ($message->reply)
                                            <span class="flex items-center gap-1 text-green-700">
                                                Respondido
                                                <x-icon code="mark_email_read" class="text-[16px]" />
                                            </span>
                                        @else
                                            <span class="flex items-center gap-1 text-orange-700">
                                                Sin responder
                                                <x-icon code="mark_email_unread" class="text-[16px]" />
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    @endif
</div>
