<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductFileController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/category/{category}', [CategoryController::class, 'FilteredProducts']);
Route::get('/products/seller/{seller}', [CategoryController::class, 'SellersProducts']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/product/{id}/images', [ProductFileController::class, 'index']);
Route::get('/random-products/{id}', [ProductController::class, 'GetRandom']);
Route::get('/user-history-products/{id}', [HistoryController::class, 'GetHistory']);
Route::get('/product/{id}/reviews', [ProductController::class, 'GetReviews']);
