<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;


Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/new-arrival', [ItemController::class, 'newArrival']); 
Route::get('/items/trending', [ItemController::class, 'trending']);
Route::get('/banners', [ItemController::class, 'showBanner']);

