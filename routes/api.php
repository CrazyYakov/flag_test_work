<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Middleware\PaymentMiddleware;
use Illuminate\Support\Facades\Route;
use Marketplace\Auth\Presentation\Controllers\AuthorizationController;
use Marketplace\Auth\Presentation\Controllers\RegistrationController;
use Marketplace\Product\Presentation\Controllers\IndexProductController;
use Marketplace\Product\Presentation\Controllers\ShowProductController;

Route::prefix('/auth')->group(function () {
    Route::post('/registration', RegistrationController::class);

    Route::post('/authorization', AuthorizationController::class);
});

Route::prefix('/cart')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [CartController::class, 'index']);

    Route::post('{id}', [CartController::class, 'store']);

    Route::delete('{id}', [CartController::class, 'remove']);
});

Route::prefix('/products')->group(function () {
    Route::get('/', IndexProductController::class);
    Route::get('/{id}', ShowProductController::class);
});

Route::prefix('/payment')->group(function () {
    Route::get('/methods', [PaymentMethodController::class, 'index']);

    Route::middleware(PaymentMiddleware::class)->get('/pay', [PaymentController::class, 'pay']);
});

Route::prefix('/orders')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::post('/create', [OrderController::class, 'store']);
});
