<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\NewsCategoryController as AdminNewsCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsCategoryController;



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
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('/categories', AdminNewsCategoryController::class);
    Route::resource('/news', AdminNewsController::class);
});

Route::get('/categories', [NewsCategoryController::class, 'index']);
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/show/{id}', [NewsController::class, 'show'])->where('id', '\d+')->name('news.show');

