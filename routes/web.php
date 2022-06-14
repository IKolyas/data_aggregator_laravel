<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Admin\NewsCategoryController as AdminNewsCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use \App\Http\Controllers\SocialiteController;
use App\Http\Controllers\Admin\ParserController;
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

// for admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
        Route::resource('/categories', AdminNewsCategoryController::class);
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/users', AdminUserController::class);
    });
    Route::get('admin/account', [AccountController::class, 'index'])->name('admin.account');
});

Route::get('/parser', ParserController::class)->name('parser'); // add middleware

Route::group(['middleware' => 'guest', 'prefix' => 'socialite'], function () {
    Route::get('/auth/vk', [SocialiteController::class, 'init'])->name('vk.init');
    Route::get('/auth/vk/callback', [SocialiteController::class, 'callback'])->name('vk.callback');
});

Route::get('/', [NewsController::class, 'home'])->middleware('recaptcha');
Route::get('/categories', [NewsCategoryController::class, 'index']);
Route::get('/categories/show/{id}', [NewsCategoryController::class, 'show'])->where('id', '\d+')->name('categories.show');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/show/{id}', [NewsController::class, 'show'])->where('id', '\d+')->name('news.show');

