<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

route::group(['prefix'=> 'admin'], function () {
    Route::get('/',[AdminDashboardController::class, 'index'])->name('admin.index');
    route::get('/BookController',[BookController::class,'index'])->name('book.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// user
Route::get('/', [UserController::class, 'index']);

Route::get('/theloai/{id}', [theloaiController::class, 'theloai'])->name('theloai');
Route::get('/tatca-sach', [UserController::class, 'tatCaSach'])->name('books.all');

Route::get('/tatca-sach', [UserController::class, 'tatCaSach'])->name('tatca-sach');
Route::get('/search', [UserController::class, 'search'])->name('search');

Route::get('/book/{id}', [UserController::class, 'bookDetails'])->name('book.details');

// cập nhật thông tin user
Route::get('/accountpanel','App\Http\Controllers\AccountController@accountpanel')
->middleware('auth')->name("account");

Route::post('/saveaccountinfo','App\Http\Controllers\AccountController@saveaccountinfo')
->middleware('auth')->name('saveinfo');
Route::post('/book/{id}/borrow', [BookController::class, 'borrow'])->name('book.borrow')->middleware('auth');
// routes/web.php

Route::post('/book/borrow/{book_id}', [UserController::class, 'borrowBook'])->name('book.borrow');
/*// Chỉ cho phép người dùng đã đăng nhập truy cập
Route::middleware('auth')->group(function () {
    // Lịch sử mượn sách của người dùng
    Route::get('/user/borrow-history', [UserController::class, 'borrowHistory'])->name('user.borrow.history');
});*/
// routes/web.php
Route::get('/borrow-history','App\Http\Controllers\UserController@borrowHistory')
    ->middleware('auth')
    ->name("borrowHistory");

