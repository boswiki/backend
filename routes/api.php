<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/me', fn (Request $request) => $request->user());

Route::get('/statistics', \App\Api\Controllers\StatisticsController::class);
Route::get('/categories', [\App\Api\Controllers\CategoryController::class, 'index'])->name('categories');
Route::resource('stations', \App\Api\Controllers\StationController::class);


Route::resource('control-centers', \App\Api\Controllers\ControlCenterController::class);
