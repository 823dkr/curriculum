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

//管理ユーザー
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('admin-register');

Route::view('/admin', 'auth.admin')->middleware('auth:admin')->name('admin-home');

//一般ユーザー
Route::group(['middleware' => ['auth',]], function () {
    Route::resource('types', 'TypeController', ['only' => ['create', 'store',]]);
    Route::resource('creatures', 'MainController', ['except' => ['show']]);
    Route::resource('searches', 'SearchController', ['only' => ['index',]]);

    Route::post('/feed', 'FeedController@feed')->name('creatures.feed');
});
