<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\TestimoniController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ChatController;
use Illuminate\Support\Facades\Broadcast;

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/messages', [ChatController::class, 'index']);
//     Route::post('/messages', [ChatController::class, 'store']);
// });

// Route::middleware('auth:sanctum')->post('/pusher/auth', function (Request $request) {
//     return Broadcast::auth($request);
// });

Route::get('/messages', [ChatController::class, 'index']);
Route::post('/messages', [ChatController::class, 'store']);
// Route::middleware('auth:sanctum')->post('/pusher/auth', function (Request $request) {
//     return Broadcast::auth($request);
// });


Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'showArticle']);

Route::get('/testimoni', [TestimoniController::class, 'index']);
Route::post('/testimoni', [TestimoniController::class, 'store']);

Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/new-arrival', [ItemController::class, 'newArrival']);
Route::get('/items/trending', [ItemController::class, 'trending']);

Route::get('/banners', [ItemController::class, 'showBanner']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
