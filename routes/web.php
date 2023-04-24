<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/category/{category}', function () {
    return view('welcome');
});
Route::get('/seller/{seller}', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'showPage']);
Route::post('/product/{id}/buying', [ProductController::class, 'buyingProduct']);
Route::post('add-review/{id}', [ProductController::class, 'addReview']);

Route::middleware('roleCheck:user')->get('/user', [HomeController::class, 'userProfile'])->name('user-profile');
Route::post('/add-rating/{id}', [HomeController::class, 'addRating']);

Route::middleware('roleCheck:seller')->group(function () {
    Route::get('/seller', [HomeController::class, 'sellerProfile'])->name('seller-profile');
    Route::get('/seller/{id}/statistic', [HomeController::class, 'GetStatistic']);
    Route::get('/seller-add-new', [HomeController::class, 'addingPage']);
    Route::post('/seller/{id}/add-new', [ProductController::class, 'PostProduct']);
});

Route::middleware('roleCheck:admin')->group(function () {
   Route::get('/admin', [HomeController::class, 'adminProfile'])->name('admin-profile');
   Route::post('/cancel-appeal/{id}', [HomeController::class, 'cancelAppeal']);
   Route::post('/delete-appeal/{id}', [HomeController::class, 'deleteAppeal']);
});

Route::post('/delete-product/{id}', [ProductController::class, 'deleteProduct']);
Route::post('/product/{id}/buying', [ProductController::class, 'buyingProduct']);
