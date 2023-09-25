<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/me', fn (Request $request) => $request->user());

Route::get('/categories', [\App\Api\Controllers\CategoryController::class, 'index'])->name('categories');
Route::resource('stations', \App\Api\Controllers\StationController::class);

