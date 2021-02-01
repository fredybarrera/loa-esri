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


// verificacion de ruteo en caso que un usuario este logueado o no 
Route::get('/', function () {

    if(Auth::check())
    {
        return redirect()->guest('escogerPerfil');
        // return redirect()->guest('/home');
    }else{
        return redirect()->guest('login');
    }
});


/*
|--------------------------------------------------------------------------
| Usuarios autenticados
|--------------------------------------------------------------------------
|
*/

Route::get('/page-2', 'Page2Controller')->name('page-2');
// Route::get('/', 'HomeController')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


Route::resource('usuario', UsuarioController::class);
Route::resource('tarea', TareaController::class);
Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');


Route::post('registrar-tarea',[
    'uses' => 'TareaController@registrarTarea'
]);
Route::post('actualizar-tarea',[
    'uses' => 'TareaController@actualizarTarea'
]);
Route::post('eliminar-tarea',[
    'uses' => 'TareaController@eliminarTarea'
]);


// Login de usuario
Route::get('escogerPerfil', 'HomeController@escogerPerfil');
Route::post('/setPerfil', 'HomeController@setPerfil');
Route::get('/auth/logout', [
    'as' => 'logout',
    'uses' => 'HomeController@getLogout'
]);
Route::get('cambiarPerfil', 'HomeController@cambiarPerfil');


// Utilidades
Route::get('reset-password/{key}', 'UsuarioController@resetPassword');
Route::get('update-user-profile/{key}', 'UsuarioController@updateUserProfile');


// Route::get('login', [
//     'as' => 'login', 
//     'uses' => 'Auth\LoginController@login'
// ]);

// Route::post('auth/login', [
//     'as' =>'login', 
//     'uses' => 'Auth\LoginController@postLogin'
// ]);