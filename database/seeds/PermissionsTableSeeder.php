<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Admin / Users
         */
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['create']], [
            'description' => 'Creación de usuarios'
        ]);
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de usuario'
        ]);
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['edit']], [
            'description' => 'Edición de usuario'
        ]);
        Permission::updateOrCreate(['name' => UsersController::PERMISSIONS['edit-image']], [
            'description' => 'Edición de imagen del usuario'
        ]);

        /**
         * Admin / Permission
         */
        Permission::updateOrCreate(['name' => PermissionController::PERMISSIONS['show']], [
            'description' => 'Listado y detalle de permiso'
        ]);
    }
}
