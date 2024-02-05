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
//ログイン
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::post('/login/admin', 'Auth\LoginController@adminLogin');
//新規登録
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('admin-register');
//パスワードリセット
Route::get('password/admin/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('password/admin/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('password/admin/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('password/admin/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
//ホーム画面
Route::resource('admin', 'AdminController', ['only' => ['index', 'destroy']])->middleware('auth:admin');



//一般ユーザー
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resource('types', 'TypeController', ['only' => ['create', 'store',]]);
    Route::resource('creatures', 'MainController', ['only' => ['index', 'create', 'store']]);

    Route::group(['middleware' => 'can:view,creature'], function () {
        Route::resource('creatures', 'MainController', ['only' => ['edit', 'update', 'destroy']]);
    });

    Route::resource('searches', 'SearchController', ['only' => ['index',]]);

    Route::post('/ajaxfeed', 'FeedController@feed')->name('creatures.feed');
});
