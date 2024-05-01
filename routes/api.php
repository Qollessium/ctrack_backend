<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\AuthenticateUser;
use App\Http\Controllers\API\UserController;

Route::middleware('api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);

        Route::middleware([AuthenticateUser::class])->group(function () {
            Route::post('me', [AuthController::class, 'me']);
        });
    });

    Route::prefix('user')->middleware([AuthenticateUser::class])->group(function () {
        Route::post('attachCryptoCurrency', [UserController::class, 'attachCryptoCurrency']);
        Route::post('detachCryptoCurrency', [UserController::class, 'detachCryptoCurrency']);
    });
});
