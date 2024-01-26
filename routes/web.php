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
    Route::resource('types', 'TypeController', ['only' => ['create', 'store',]]);
    Route::resource('creatures', 'MainController', ['except' => ['show']]);
    Route::resource('searches', 'SearchController', ['only' => ['index',]]);
});
