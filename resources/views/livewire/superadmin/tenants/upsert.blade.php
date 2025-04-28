<div>
    
    <div class="flex flex-col items-start sm:flex-row sm:items-center gap-y-4 gap-x-6 mb-12">
        <x-button :href="route('superadmin.tenants.index')" 
        type="secondary" class="flex items-center gap-1.5">
            <x-icon code="arrow_back" />
            Ir al listado
        </x-button>
        <h2 class="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            {{ $tenant ? 'Editar Comercio' : 'Nuevo Comercio' }}
        </h2>
    </div>
      

    <form>
        <div class="space-y-12">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base/7 font-semibold text-gray-900">
                        Datos de facturación
                    </h2>
                    <p class="mt-1 text-sm/6 text-gray-600">
                        Información de la empresa o persona a la cual se le facturará el servicio
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    <x-form-input class="sm:col-span-3" label="Razón social" />

                    <x-form-input type="number" class="sm:col-span-3" label="CUIT - CUIL" />

                    <x-form-input class="sm:col-span-3" label="Domicilio fiscal" />

                    <x-form-input type="number" class="sm:col-span-3" label="Teléfono" />

                    <x-form-input type="email" helper="email donde se enviarán las facturas" 
                    class="sm:col-span-3" label="Email" />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base/7 font-semibold text-gray-900">
                        Datos del comercio
                    </h2>
                    <p class="mt-1 text-sm/6 text-gray-600">
                        Información principal y dominio del comercio
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    
                    <x-form-input class="sm:col-span-3" label="Nombre del comercio" />

                    <x-form-input class="sm:col-span-3" label="Código único" helper="sin espacios ni guiones" />

                    <x-form-input class="sm:col-span-3" label="Dominio" />

                    <div class="sm:col-span-3">
                        <label for="sector" class="inline-block text-sm/6 font-medium 
                        text-gray-900">Rubro</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="sector" class="col-start-1 row-start-1 w-full 
                            border-gray-300 focus:ring-0  appearance-none rounded-md 
                            bg-transparent py-1.5 pl-3 pr-8 text-base shadow-sm 
                            text-gray-900 focus:border-transparent 
                            focus:outline-blue-600 sm:text-sm/6 truncate">
                                <option value="">Seleccionar rubro</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{ $sector->id }}">
                                        {{ $sector->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base/7 font-semibold text-gray-900">
                        Usuario operador
                    </h2>
                    <p class="mt-1 text-sm/6 text-gray-600">
                        Datos del primer usuario administrador que iniciará sesión por primera vez en el panel de comercio
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    <x-switch class="sm:col-span-6" label="Usar datos de facturación" />
                    <x-form-input class="sm:col-span-3" label="Nombre de usuario" />
                    <x-form-input class="sm:col-span-3" label="Contraseña" />
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
            <button type="submit"
            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</div>
