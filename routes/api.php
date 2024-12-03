<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->group(function () {
    Route::post('/registration', [UserController::class, 'registration']);

    Route::post('/authorization', [UserController::class, 'authorization']);
});

Route::prefix('/cart')->middleware('auth:sanctum')->group(function () {
    Route::post('/store/{id}', [CartController::class, 'store']);

    Route::delete('/remove/{id}', [CartController::class, 'remove']);
});

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
});

Route::prefix('/payments')->group(function () {
    Route::get('/', [PaymentMethodController::class, 'index']);
});
