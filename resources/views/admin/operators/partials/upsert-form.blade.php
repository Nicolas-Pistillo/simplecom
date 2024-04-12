{{-- Upsert form --}}
<x-drawer ref="operatorsDrawerOpen">

    <div class="h-full">

        <div class="h-full">
    
            <form wire:submit='save' class="h-full flex flex-col justify-between">
    
                <div class="mb-3">
    
                    <h3 class="text-lg text-gray-700 font-semibold mb-3">{{ $drawerTitle }}</h3>
            
                    <hr class="mb-6">

                    <h4 class="text-sm text-gray-500 text-center font-semibold mt-3 pb-2">Información general</h4>
                    <hr class="mb-3">
            
                    <div class="mb-6">
                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                            Nombre
                        </label>
                        <div class="mt-2">
                          <input type="text" wire:model='name' name="name" autocomplete="off" class="block w-full 
                          rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                          placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                          sm:text-sm sm:leading-6">
                        </div>
                        @error('name')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>
            
                    <div class="mb-6">
                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                            Email
                        </label>
                        <div class="mt-2">
                          <input type="email" wire:model='email' name="email" autocomplete="off" class="block w-full 
                          rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                          placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                          sm:text-sm sm:leading-6">
                        </div>
                        @error('email')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                            Rol
                        </label>
                        <div class="mt-2">
                            <select wire:model.live='role' name="role" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option>Seleccionar un rol</option>
                                @foreach ($roles as $roleItem)
                                    <option @if($role == $roleItem->id) selected @endif 
                                    value="{{ $roleItem->name }}">{{ $roleItem->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <small class="text-xs text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                            Area (opcional)
                        </label>
                        <div class="mt-2">
                          <input type="text" wire:model='area' name="area" autocomplete="off" class="block w-full 
                          rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                          placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                          sm:text-sm sm:leading-6">
                        </div>
                        @error('area')
                            <small class="text-red-500"> {{ $message }} </small>
                        @else  
                            <small class="text-gray-500">Por ejemplo: Marketing, Soporte, Diseño etc.</small>
                        @enderror
                    </div>

                    @if (!$this->operator)
                        <h4 class="text-sm text-gray-500 text-center font-semibold mt-3 pb-2">Acceso al panel</h4>
                        <hr class="mb-3">

                        <div class="mb-6">
                            <label class="block text-sm font-semibold leading-6 text-gray-500">
                                Contraseña
                            </label>
                            <div class="mt-2">
                            <input type="password" @paste.prevent wire:model='password' name="password" autocomplete="off" class="block w-full 
                            rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                            sm:text-sm sm:leading-6">
                            </div>
                            @error('password')
                                <small class="text-red-500"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-semibold leading-6 text-gray-500">
                                Confirmar contraseña
                            </label>
                            <div class="mt-2">
                            <input type="password" @paste.prevent wire:model='password_confirmation' name="password_confirmation" autocomplete="off" class="block w-full 
                            rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                            sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    @endif

                </div>
    
                <div class="flex items-center py-6">
    
                    <x-button submit wire:loading.remove wire:target='save' size="large" class="w-full mr-4">Guardar</x-button>
                    
                    <x-spinner wire:loading wire:target='save' class="w-full" />
    
                    <x-button wire:loading.remove wire:target='save' wire:click='cancelForm' 
                    size="large" class="w-full" type="secondary">
                        Cancelar
                    </x-button>
                </div>
    
            </form>
    
        </div>
    </div>

</x-drawer>