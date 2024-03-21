<div>
    <div x-data="{menuOpen: false}" class="pt-2">
        <!-- Notifications Button -->
        <button @click="menuOpen = !menuOpen" type="button" class="relative -m-2.5 pt-2 pr-2 text-gray-400 transition hover:text-gray-500">
            <x-icon code="notifications" />
            <span
                class="animate__animated animate__heartBeat animate__repeat-3 absolute top-1.5 right-2 block h-2 w-2 rounded-full bg-green-400 ring-2 ring-white"></span>
        </button>

        <!-- Notifications Dropdown -->
        <div x-cloak x-show="menuOpen" @click.away="menuOpen = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" 
        class=" absolute top-16 right-1 sm:right-8 mx-auto md:w-[400px]">
            <div class="z-20 w-full bg-white divide-y divide-gray-100 rounded-lg shadow">
                <div class="block px-4 py-2 font-semibold text-center text-white rounded-t-lg bg-{{ tenant('color') }}-600">
                    Notificaciones
                </div>
                <div class="divide-y divide-gray-100">
                    <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
                        <div class="flex-shrink-0">
                            <img class="rounded-full w-11 h-11" src="{{ URL::to('img/avatar-default.png') }}">
                        </div>
                        <div class="w-full ps-3">
                            <div class="text-gray-500 text-sm mb-1.5"><span class="font-semibold text-gray-900">5
                                    others</span> started following you.
                            </div>
                            <div class="text-xs text-blue-600">10 minutes ago</div>
                        </div>
                    </a>
                    <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
                        <div class="flex-shrink-0">
                            <img class="rounded-full w-11 h-11" src="{{ URL::to('img/avatar-default.png') }}">
                        </div>
                        <div class="w-full ps-3">
                            <div class="text-gray-500 text-sm mb-1.5"><span class="font-semibold text-gray-900">Joseph
                                    Mcfall</span> and <span class="font-medium text-gray-900">5 others</span> started
                                following you.
                            </div>
                            <div class="text-xs text-blue-600">10 minutes ago</div>
                        </div>
                    </a>
                    <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
                        <div class="flex-shrink-0">
                            <img class="rounded-full w-11 h-11" src="{{ URL::to('img/avatar-default.png') }}">
                        </div>
                        <div class="w-full ps-3">
                            <div class="text-gray-500 text-sm mb-1.5"><span class="font-semibold text-gray-900">Joseph
                                    Mcfall</span> and <span class="font-medium text-gray-900">5 others</span> started
                                following you.
                            </div>
                            <div class="text-xs text-blue-600">10 minutes ago</div>
                        </div>
                    </a>
                    <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
                        <div class="flex-shrink-0">
                            <img class="rounded-full w-11 h-11" src="{{ URL::to('img/avatar-default.png') }}">
                        </div>
                        <div class="w-full ps-3">
                            <div class="text-gray-500 text-sm mb-1.5"><span class="font-semibold text-gray-900">Joseph
                                    Mcfall</span> and <span class="font-medium text-gray-900">5 others</span> started
                                following you.
                            </div>
                            <div class="text-xs text-blue-600">10 minutes ago</div>
                        </div>
                    </a>
                    <a href="#" class="flex px-4 py-3 hover:bg-gray-100">
                        <div class="flex-shrink-0">
                            <img class="rounded-full w-11 h-11" src="{{ URL::to('img/avatar-default.png') }}">
                        </div>
                        <div class="w-full ps-3">
                            <div class="text-gray-500 text-sm mb-1.5"><span class="font-semibold text-gray-900">5
                                    others</span> started following you.
                            </div>
                            <div class="text-xs text-blue-600">10 minutes ago</div>
                        </div>
                    </a>
                </div>
                {{-- <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100">
                        <div class="inline-flex items-center ">
                            <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                            </svg>
                            View all
                        </div>
                    </a> 
                --}}
            </div>
        </div>
    </div>
</div>
