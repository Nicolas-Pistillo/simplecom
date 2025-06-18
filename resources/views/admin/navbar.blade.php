<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        
        <li>
            <ul role="list" class="-mx-2 space-y-1">

                <x-navbar-item route="admin.dashboard.index" icon="home" title="Inicio" />

                @can('Editar configuraciones')
                    <x-navbar-item route="admin.configurations.index" icon="settings" title="Configuracion" />
                @endcan
                
            </ul>
        </li>

        <li>
            <h5 class="text-xs font-semibold leading-6 text-gray-400 tracking-wide">Operatoria</h5>
            <ul role="list" class="-mx-2 mt-2 space-y-1">

                @can('Ver ventas')
                    <x-navbar-item route="admin.orders.index" icon="shopping_cart" title="Pedidos" 
                    :active="Route::is('admin.orders.*')"/>
                @endcan

                @can('Ver clientes')
                    <x-navbar-item route="admin.customers.index" icon="groups" title="Clientes" 
                    :active="Route::is('admin.customers.*')"/>
                @endcan

                @can('Ver mensajes')
                    <x-navbar-item route="admin.messages.index" icon="email" title="Mensajes"
                    :active="Route::is('admin.messages.*')">
                        @if ($unreadMessages = App\Models\Message::unread()->count())
                            <x-badge color="red" class="!rounded-full">
                                {{ $unreadMessages }}
                            </x-badge>
                        @endif
                    </x-navbar-item>
                @endcan

                @can('Editar formas de entrega')
                    <x-navbar-item route="admin.delivery-methods.index" icon="shopping_bag_speed" title="Formas de entrega" 
                    :active="Route::is('admin.delivery-methods.*')"/>
                @endcan

                @can('Editar formas de pago')
                    <x-navbar-item route="admin.payment-methods.index" icon="credit_card" title="Formas de pago" 
                    :active="Route::is('admin.payment-methods.*')"/>
                @endcan

                @can('Editar operadores')
                    <x-navbar-item route="admin.operators.index" icon="manage_accounts" title="Operadores" />
                @endcan

            </ul>
        </li>

        <li>
            <h5 class="text-xs font-semibold leading-6 text-gray-400 tracking-wide">Catálogo</h5>
            <ul role="list" class="-mx-2 mt-2 space-y-1">

                @can('Ver productos')
                    <x-navbar-item route="admin.products.index" icon="deployed_code" title="Productos" 
                    :active="Route::is('admin.products.*')"/>
                @endcan

                @can('Editar colecciones')
                    <x-navbar-item route="admin.collections.index" icon="note_stack" title="Colecciones" />
                @endcan

                @can('Editar categorias')
                    <x-navbar-item route="admin.categories.index" icon="format_list_bulleted" title="Categorías" />
                @endcan

                @can('Editar atributos')
                    <x-navbar-item route="admin.attributes.index" icon="category" title="Atributos" />
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