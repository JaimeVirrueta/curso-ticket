<?php

use Illuminate\Support\Facades\Route;

Route::get('home', 'HomeController')->name('home');

// Gestión
    // tickets
    // asignación
// Configuracion
    // tipo
    // prioridades
// Reportes
    // creados
    // pendientes

Route::prefix('administracion')->namespace('Admin')->name('admin.')->group(function(){
    Route::patch('usuarios/{user}/imagen', 'UsersController@image')->name('user.image');
    Route::resource('usuarios', 'UsersController')
        ->names('user')
        ->parameters(['usuarios' => 'user'])
        ->except(['destroy']);
    // roles
    Route::resource('roles', 'RoleController')
        ->names('role')
        ->parameters(['permisos' => 'role']);
    // permisos (solo lectura)
    Route::resource('permisos', 'PermissionController')
        ->names('permission')
        ->parameters(['permisos' => 'permission'])
        ->only(['index', 'show']);
});
