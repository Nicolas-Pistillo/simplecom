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
        /******* PERMISOS *******/

        $editCategories = Permission::create(['name' => 'Editar categorias', 'guard_name' => 'operator']);
        $deleteCategories = Permission::create(['name' => 'Eliminar categorias', 'guard_name' => 'operator']);

        $editProducts = Permission::create((['name' => 'Editar productos', 'guard_name' => 'operator']));
        $deleteProducts = Permission::create(['name' => 'Eliminar productos', 'guard_name' => 'operator']);

        $createOperators = Permission::create(['name' => 'Editar operadores', 'guard_name' => 'operator']);

        $viewSales = Permission::create(['name' => 'Ver ventas', 'guard_name' => 'operator']);

        /******* ROLES *******/
        $admin = Role::create(['name' => 'Administrador', 'guard_name' => 'operator']);
        $contentManager = Role::create(['name' => 'Editor de contenido', 'guard_name' => 'operator']);

        $admin->syncPermissions([
            $editCategories, $deleteCategories, $editProducts, $deleteProducts,
            $createOperators, $viewSales
        ]);

        $contentManager->syncPermissions([$editCategories, $editProducts]);
    }
}
