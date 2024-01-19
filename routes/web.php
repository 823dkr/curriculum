<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [DisplayController::class, 'index']);

    Route::get('/create_type', [RegistrationController::class, 'createTypeForm'])->name('create.type');
    Route::post('/create_type', [RegistrationController::class, 'createType']);

    Route::get('/create_creature', [RegistrationController::class, 'createCreatureForm'])->name('create.creature');
    Route::post('/create_creature', [RegistrationController::class, 'createCreature']);

    Route::get('/users/edit', 'UserController@edit2');
    Route::post('/users/edit', 'UserController@update');
});
