<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', fn (Request $request) => $request->user());
