<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;


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
route::get('/register',[UserController::class,'showregister'])->name('auth.register');
route::post('/register',[UserController::class,'store'] )->name('auth.register.store');

route::group(['prefix'=> 'admin'], function () {
    Route::get('/dashboard',[AdminDashboardController::class, 'index'])->name('admin.index')->middleware('auth');
    route::get('/BookController',[BookController::class,'index'])->name('book.index');
});

route::get('/login',[UserController::class,'showlogin'])->name('auth.showlogin');
route::post('/login',[UserController::class,'login'])->name('auth.login');
route::post('/logout',[UserController::class,'logout'])->name('logout');


//require __DIR__.'/auth.php';
