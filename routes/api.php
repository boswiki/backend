<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/me', fn (Request $request) => $request->user());

Route::get('/categories', [\App\Api\Controllers\CategoryController::class, 'index'])->name('categories');
Route::resource('stations', \App\Api\Controllers\StationController::class);

Route::get('/statistics', \App\Api\Controllers\StatisticsController::class);

Route::get('/districts', fn (Request $request) => \Domain\Stations\Models\District::query()
    ->select('id', 'name')
    ->with('controlCenters:id,district_id,name')
    ->get()
);
