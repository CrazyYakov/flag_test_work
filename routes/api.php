<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\PaymentMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->group(function () {
    Route::post('/registration', [UserController::class, 'registration']);

    Route::post('/authorization', [UserController::class, 'authorization']);
});

Route::prefix('/cart')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [CartController::class, 'index']);

    Route::post('{id}', [CartController::class, 'store']);

    Route::delete('{id}', [CartController::class, 'remove']);
});

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
});

Route::prefix('/payments')->group(function () {
    Route::get('/', [PaymentMethodController::class, 'index']);
});

Route::prefix('/orders')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::post('/create', [OrderController::class, 'store']);
});

Route::middleware(PaymentMiddleware::class)->get('/payment', [PaymentController::class, 'pay']);
