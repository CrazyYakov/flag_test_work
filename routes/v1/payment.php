<?php

use Illuminate\Support\Facades\Route;
use Marketplace\Payment\Presentation\Controllers\GenerateUrlController;
use Marketplace\Payment\Presentation\Controllers\IndexPaymentController;

Route::get('/methods', IndexPaymentController::class);

Route::get('/payment/generate/url/{PaymentMethodEnum}', GenerateUrlController::class);
