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


Route::resource('usuarios', UsuarioController::class);
Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');


// Login de usuario
Route::get('escogerPerfil', 'HomeController@escogerPerfil');
Route::post('/setPerfil', 'HomeController@setPerfil');


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