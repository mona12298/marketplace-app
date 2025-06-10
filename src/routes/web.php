<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;

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
Route::get('/login', [UserController::class,'login']);
Route::get('/register', [UserController::class,'register']);
Route::post('/login', [UserController::class,'loginUser']);
Route::post('/register', [UserController::class,'storeUser']);
Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);
Route::post('/item/{item_id}/comment', [CommentController::class, 'comment']);


Route::middleware('auth')->group(function () {
    Route::post('/item/{item_id}/like', [ItemController::class, 'like']);

    Route::get('/purchase/{item_id}', [ItemController::class, 'showPurchase']);
    Route::post('/purchase/{item_id}', [ItemController::class, 'purchase']);

    Route::get('/purchase/address/{item_id}', [ProfileController::class, 'showAddress']);
    Route::patch('/purchase/address/{item_id}', [ProfileController::class, 'updateAddress']);

    Route::get('/sell', [ItemController::class, 'showListing']);
    Route::post('/sell', [ItemController::class, 'storeListing']);

    Route::get('/mypage', [ProfileController::class, 'mypage']);

    Route::get('/mypage/profile', [ProfileController::class, 'showMyPage']);
    Route::patch('/mypage/profile', [ProfileController::class, 'updateMypage']);
});