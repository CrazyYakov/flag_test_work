<?php

use Illuminate\Support\Facades\Route;
use Marketplace\Order\Presentation\Controllers\IndexOrderController;
use Marketplace\Order\Presentation\Controllers\PaymentOrderController;
use Marketplace\Order\Presentation\Controllers\ShowOrderController;

Route::get('/', IndexOrderController::class);
Route::get('/{id}', ShowOrderController::class);
Route::post('/payed/{id}', PaymentOrderController::class);
