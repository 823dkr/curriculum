<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth',]], function () {

    Route::get('/', [DisplayController::class, 'index']);

    Route::get('/create_type', [RegistrationController::class, 'createTypeForm'])->name('create.type');
    Route::post('/create_type', [RegistrationController::class, 'createType']);

    Route::get('/create_creature', [RegistrationController::class, 'createCreatureForm'])->name('create.creature');
    Route::post('/create_creature', [RegistrationController::class, 'createCreature']);

    Route::group(['middleware' => 'can:view,creature'], function () {
        Route::get('/edit_form/{creature}', [RegistrationController::class, 'editCreatureForm'])->name('edit.creature');
        Route::post('/edit_form/{creature}', [RegistrationController::class, 'editCreature']);

        Route::get('/delete_creature/{creature}', [RegistrationController::class, 'deleteCreature'])->name('delete.creature');
    });
});
