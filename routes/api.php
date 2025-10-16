<?php

use Illuminate\Support\Facades\Route;
use Marketplace\Auth\Presentation\Controllers\AuthorizationController;
use Marketplace\Auth\Presentation\Controllers\RegistrationController;
use Marketplace\Cart\Presentation\Controllers\RemoveProductCartController;
use Marketplace\Cart\Presentation\Controllers\IndexProductCartController;
use Marketplace\Cart\Presentation\Controllers\PayCartController;
use Marketplace\Cart\Presentation\Controllers\StoreProductCartController;
use Marketplace\Order\Presentation\Controllers\IndexOrderController;
use Marketplace\Order\Presentation\Controllers\PaymentOrderController;
use Marketplace\Order\Presentation\Controllers\ShowOrderController;
use Marketplace\Payment\Presentation\Controllers\GenerateUrlController;
use Marketplace\Payment\Presentation\Controllers\IndexPaymentController;
use Marketplace\Product\Presentation\Controllers\IndexProductController;
use Marketplace\Product\Presentation\Controllers\ShowProductController;

Route::prefix('/auth')->group(function () {
    Route::post('/registration', RegistrationController::class);

    Route::post('/authorization', AuthorizationController::class);
});

Route::prefix('/cart')->middleware('auth:sanctum')->group(function () {
    Route::get('/', IndexProductCartController::class);

    Route::post('/pay/{paymentMethodId}', PayCartController::class);

    Route::post('{id}', StoreProductCartController::class);

    Route::delete('{id}', RemoveProductCartController::class);
});

Route::prefix('/products')->group(function () {
    Route::get('/', IndexProductController::class);

    Route::get('/{id}', ShowProductController::class);
});

Route::prefix('/payment')->group(function () {
    Route::get('/methods', IndexPaymentController::class);

    Route::get('/payment/generate/url/{PaymentMethodEnum}', GenerateUrlController::class);

});

Route::prefix('/orders')->middleware('auth:sanctum')->group(function () {
    Route::get('/', IndexOrderController::class);
    Route::get('/{id}', ShowOrderController::class);

    Route::post('/payed/{id}', PaymentOrderController::class);
});
