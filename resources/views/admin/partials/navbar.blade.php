<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <ul role="list" class="-mx-2 space-y-1">

                <x-navbar-item route="admin.dashboard.index" icon="home" title="Inicio" />
                
            </ul>
        </li>
        <li>
            <h5 class="text-xs font-semibold leading-6 text-gray-400 tracking-wide">
                Catálogo
            </h5>
            <ul role="list" class="-mx-2 mt-2 space-y-1">

                <x-navbar-item active="{{ Route::is('admin.categories.*') }}" 
                route="admin.categories.index" icon="format_list_bulleted" title="Categorías" />

            </ul>
        </li>

        <x-navbar-item itemClasses="mt-auto" linkClasses="-mx-2" 
        route="admin.setup" icon="settings" title="Configuracion" />
    </ul>
</nav>