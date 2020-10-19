<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController')->name('home');



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
});
    // roles
    // permisos (solo lectura)
