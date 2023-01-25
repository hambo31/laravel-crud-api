<?php

use App\Http\Controllers\Api\userController;
use App\Http\Controllers\Api\authController;
use Illuminate\Support\Facades\Route;


Route::apiResource('users', userController::class)->middleware('auth:api');
Route::post('login', [authController::class, 'login']);
