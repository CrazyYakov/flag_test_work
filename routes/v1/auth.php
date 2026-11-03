<?php

use Illuminate\Support\Facades\Route;
use Marketplace\Auth\Presentation\Controllers\AuthorizationController;
use Marketplace\Auth\Presentation\Controllers\RegistrationController;

Route::post('/registration', RegistrationController::class);

Route::post('/authorization', AuthorizationController::class);
