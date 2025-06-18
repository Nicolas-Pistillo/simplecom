<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /******* PERMISSIONS *******/
        $editCategories = Permission::firstOrCreate(['name' => 'Editar categorias', 'guard_name' => 'operator']);

        $editBrands = Permission::firstOrCreate(['name' => 'Editar marcas', 'guard_name' => 'operator']);

        $viewProducts = Permission::firstOrCreate((['name' => 'Ver productos', 'guard_name' => 'operator']));

        $editProducts = Permission::firstOrCreate((['name' => 'Editar productos', 'guard_name' => 'operator']));

        $editCollections = Permission::firstOrCreate(['name' => 'Editar colecciones', 'guard_name' => 'operator']);

        $editBanners = Permission::firstOrCreate(['name' => 'Editar banners', 'guard_name' => 'operator']);

        $editOperators = Permission::firstOrCreate(['name' => 'Editar operadores', 'guard_name' => 'operator']);

        $editAttributes = Permission::firstOrCreate(['name' => 'Editar atributos', 'guard_name' => 'operator']);

        $editPaymentMethods = Permission::firstOrCreate(['name' => 'Editar formas de pago', 'guard_name' => 'operator']);

        $editDeliveryMethods = Permission::firstOrCreate(['name' => 'Editar formas de entrega', 'guard_name' => 'operator']);

        $editConfigs = Permission::firstOrCreate(['name' => 'Editar configuraciones', 'guard_name' => 'operator']);

        $viewOrders = Permission::firstOrCreate(['name' => 'Ver ventas', 'guard_name' => 'operator']);

        $editOrders = Permission::firstOrCreate(['name' => 'Editar ventas', 'guard_name' => 'operator']);

        $viewCustomers = Permission::firstOrCreate(['name' => 'Ver clientes', 'guard_name' => 'operator']);

        $editCustomers = Permission::firstOrCreate(['name' => 'Editar clientes', 'guard_name' => 'operator']);

        $viewMessages = Permission::firstOrCreate(['name' => 'Ver mensajes', 'guard_name' => 'operator']);

        $replyMessages = Permission::firstOrCreate(['name' => 'Responder mensajes', 'guard_name' => 'operator']);

        /******* ROLES *******/
        $admin = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'operator']);
        $contentManager = Role::firstOrCreate(['name' => 'Editor de contenido', 'guard_name' => 'operator']);

        /******* ATTACH PERMISSIONS TO ROLES *******/
        $admin->syncPermissions([
            $editCategories, $viewProducts, $editProducts, $editOperators, $editBanners, 
            $editBrands, $viewOrders, $editOrders, $editAttributes, $editConfigs, $editCollections,
            $editPaymentMethods, $editDeliveryMethods, $viewCustomers, $editCustomers, 
            $viewMessages, $replyMessages
        ]);

        $contentManager->syncPermissions([$editBanners, $editCollections]);
    }
}
