<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\MostReadBooksController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\theloaiController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\BorrowTicketController;

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

// User routes
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/', [UsersController::class, 'index']);

// Authentication routes
Route::get('/register',[UserController::class,'showregister'])->name('auth.register');
Route::post('/register',[UserController::class,'store'])->name('auth.register.store');
Route::get('/login',[UserController::class,'showlogin'])->name('auth.showlogin');
Route::post('/login',[UserController::class,'login'])->name('auth.login');
Route::post('/logout',[UserController::class,'logout'])->name('logout');

// Admin routes
Route::group(['prefix'=> 'admin'], function () {
    Route::get('/dashboard',[AdminDashboardController::class, 'index'])->name('admin.index')->middleware('auth');
    Route::get('/BookController',[BookController::class,'index'])->name('book.index');
    Route::get('/qlphieumuon', [BorrowTicketController::class, 'borrowList'])->name('admin.qlphieumuon');
    Route::get('/qlmember', [BorrowTicketController::class, 'members'])->name('admin.qlmember');
    Route::get('/overdue-members', [AdminController::class, 'overduemembers'])->name('admin.overdue-members');
    Route::delete('/qlmember/{member_id}', [BorrowTicketController::class, 'destroy'])->name('admin.member.destroy');
    Route::get('/admin/monthly-loans', [BookController::class, 'getMonthlyLoans'])->name('admin.monthly-loans');
    route::get('/admin/quanlysach', [BookController::class,'qlysach'])->name('admin.qlysach');
    Route::get('/books/category/{id}', [BookController::class, 'showByCategory'])->name('books.category');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/edit/{book_id}', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book_id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book_id}', [BookController::class, 'destroy'])->name('books.destroy');
    route::get('/books/create', [BookController::class,'create'])->name('admin.createbook');
});

// Borrow management
Route::get('/borrow-management', [BorrowTicketController::class, 'mainlayout'])->name('borrow-management.list');

// Book and category routes
Route::get('/theloai/{id}', [theloaiController::class, 'theloai'])->name('theloai');
Route::get('/tatca-sach', [UsersController::class, 'tatCaSach'])->name('tatca-sach');
Route::get('/search', [UsersController::class, 'search'])->name('search');
Route::get('/book/{id}', [UsersController::class, 'bookDetails'])->name('book.details');
route::post('/book/{id}/borrow',[UserController::class,'']);

// Account routes
Route::get('/accountpanel','App\Http\Controllers\AccountController@accountpanel')
    ->middleware('auth')->name("account");
Route::post('/saveaccountinfo','App\Http\Controllers\AccountController@saveaccountinfo')
    ->middleware('auth')->name('saveinfo');

// Static pages
Route::get('/huong-dan', function () {
    return view('user.huongdan');
})->name('huongdan');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
