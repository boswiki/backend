<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', fn (Request $request) => $request->user());
Route::middleware('auth:sanctum')->get('/user', fn (Request $request) => $request->user());

Route::middleware(['guest'])->group(function () {
    Route::get('/categories', [\App\Api\Controllers\CategoryController::class, 'index'])->name('categories');
});

