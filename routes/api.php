<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ArticleController;
use Illuminate\Http\Request;


Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'showArticle']);
Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/new-arrival', [ItemController::class, 'newArrival']);
Route::get('/items/trending', [ItemController::class, 'trending']);
Route::get('/banners', [ItemController::class, 'showBanner']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
