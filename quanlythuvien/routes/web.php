<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
//
use App\Http\Controllers\UsersController;
use App\Http\Controllers\theloaiController;
use App\Http\Controllers\AccountController;




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

//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';

// user
Route::get('/', [UsersController::class, 'index']);

Route::get('/theloai/{id}', [theloaiController::class, 'theloai'])->name('theloai');

Route::get('/tatca-sach', [UsersController::class, 'tatCaSach'])->name('tatca-sach');
Route::get('/search', [UsersController::class, 'search'])->name('search');

Route::get('/book/{id}', [UsersController::class, 'bookDetails'])->name('book.details');

// cập nhật thông tin user
Route::get('/accountpanel','App\Http\Controllers\AccountController@accountpanel')
->middleware('auth')->name("account");

Route::post('/saveaccountinfo','App\Http\Controllers\AccountController@saveaccountinfo')
->middleware('auth')->name('saveinfo');
