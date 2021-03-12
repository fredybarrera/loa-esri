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
| Rutas
|--------------------------------------------------------------------------
|
*/

// Resources
Route::resource('tarea', TareaController::class);
Route::resource('usuario', UsuarioController::class);
Route::resource('proyecto', ProyectoController::class);

Auth::routes();

/*
|--------------------------------------------------------------------------
| Home de usuarios
|--------------------------------------------------------------------------
|
*/
Route::get('/page-2', 'Page2Controller')->name('page-2');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard-profesional', 'HomeController@dashboardProfesional')->name('dashboard-profesional');
Route::get('/dashboard-admin', 'HomeController@dashboardAdmin')->name('dashboard-admin');



/*
|--------------------------------------------------------------------------
| Modulo tareas
|--------------------------------------------------------------------------
|
*/
Route::post('registrar-tarea',[
    'uses' => 'TareaController@registrarTarea'
]);
Route::post('actualizar-tarea',[
    'uses' => 'TareaController@actualizarTarea'
]);
Route::post('eliminar-tarea',[
    'uses' => 'TareaController@eliminarTarea'
]);

/*
|--------------------------------------------------------------------------
| Login de usuario
|--------------------------------------------------------------------------
|
*/
Route::get('escogerPerfil', 'HomeController@escogerPerfil');
Route::post('/setPerfil', 'HomeController@setPerfil');
Route::get('/auth/logout', [
    'as' => 'logout',
    'uses' => 'HomeController@getLogout'
]);
Route::get('cambiarPerfil', 'HomeController@cambiarPerfil');

/*
|--------------------------------------------------------------------------
| Utilidades
|--------------------------------------------------------------------------
|
*/
Route::get('reset-password/{key}', 'HomeController@resetPassword');
Route::get('update-user-profile/{key}', 'HomeController@updateUserProfile');
Route::get('update-dates/{key}', 'HomeController@updateDates');

