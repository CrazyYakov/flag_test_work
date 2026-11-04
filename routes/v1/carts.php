<?php

use Illuminate\Support\Facades\Route;
use Marketplace\Cart\Presentation\Controllers\RemoveProductCartController;
use Marketplace\Cart\Presentation\Controllers\IndexProductCartController;
use Marketplace\Cart\Presentation\Controllers\PayCartController;
use Marketplace\Cart\Presentation\Controllers\StoreProductCartController;

Route::get('/', IndexProductCartController::class);

Route::post('/pay/{paymentMethodId}', PayCartController::class);

Route::post('{id}', StoreProductCartController::class);

Route::delete('{id}', RemoveProductCartController::class);
