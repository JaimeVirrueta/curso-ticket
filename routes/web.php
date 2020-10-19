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
    Route::resource('usuarios', 'UsersController')->names('user')->parameters(['usuarios' => 'user']);
    // roles
    // permisos (solo lectura)
});
