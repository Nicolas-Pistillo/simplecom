<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        
        <li>
            <ul role="list" class="-mx-2 space-y-1">

                <x-navbar-item route="admin.dashboard.index" icon="home" title="Inicio" />

                @can('Editar operadores')
                    <x-navbar-item route="admin.operators.index" icon="contacts" title="Operadores" />
                @endcan

                @can('Editar configuraciones')
                    <x-navbar-item route="admin.configurations.index" icon="settings" title="Configuracion" />
                @endcan
                
            </ul>
        </li>

        <li>
            <h5 class="text-xs font-semibold leading-6 text-gray-400 tracking-wide">Catálogo</h5>
            <ul role="list" class="-mx-2 mt-2 space-y-1">

                @can('Editar productos')
                    <x-navbar-item route="admin.products.index" icon="deployed_code" title="Productos" 
                    active="{{ Route::is('admin.products.*') }}"/>
                @endcan

                @can('Editar atributos')
                    <x-navbar-item route="admin.attributes.index" icon="category" title="Atributos" />
                @endcan

                @can('Editar categorias')
                    <x-navbar-item route="admin.categories.index" icon="format_list_bulleted" title="Categorías" />
                @endcan

                @can('Editar marcas')
                    <x-navbar-item route="admin.brands.index" icon="sell" title="Marcas" />
                @endcan

            </ul>
        </li>

        <li>
            <h5 class="text-xs font-semibold leading-6 text-gray-400 tracking-wide">Contenidos</h5>
            <ul role="list" class="-mx-2 mt-2 space-y-1">

                @can('Editar banners')
                    <x-navbar-item route="admin.contents.banners" icon="burst_mode" title="Banners" />
                @endcan

            </ul>
        </li>
    </ul>
</nav>