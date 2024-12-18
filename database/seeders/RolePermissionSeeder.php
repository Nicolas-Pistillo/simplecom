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
        $editCategories = Permission::create(['name' => 'Editar categorias', 'guard_name' => 'operator']);

        $editBrands = Permission::create(['name' => 'Editar marcas', 'guard_name' => 'operator']);

        $editProducts = Permission::create((['name' => 'Editar productos', 'guard_name' => 'operator']));

        $editBanners = Permission::create(['name' => 'Editar banners', 'guard_name' => 'operator']);

        $editOperators = Permission::create(['name' => 'Editar operadores', 'guard_name' => 'operator']);

        $editAttributes = Permission::create(['name' => 'Editar atributos', 'guard_name' => 'operator']);

        $editPaymentMethods = Permission::create(['name' => 'Editar formas de pago', 'guard_name' => 'operator']);

        $editDeliveryMethods = Permission::create(['name' => 'Editar formas de entrega', 'guard_name' => 'operator']);

        $editConfigs = Permission::create(['name' => 'Editar configuraciones', 'guard_name' => 'operator']);

        $viewSales = Permission::create(['name' => 'Ver ventas', 'guard_name' => 'operator']);

        $editSales = Permission::create(['name' => 'Editar ventas', 'guard_name' => 'operator']);

        /******* ROLES *******/
        $admin = Role::create(['name' => 'Administrador', 'guard_name' => 'operator']);
        $contentManager = Role::create(['name' => 'Editor de contenido', 'guard_name' => 'operator']);

        /******* ATTACH PERMISSIONS TO ROLES *******/
        $admin->syncPermissions([
            $editCategories, $editProducts, $editOperators, $editBanners, 
            $editBrands, $viewSales, $editAttributes, $editConfigs,
            $editPaymentMethods, $editDeliveryMethods, $editSales
        ]);

        $contentManager->syncPermissions([$editBanners]);
    }
}
