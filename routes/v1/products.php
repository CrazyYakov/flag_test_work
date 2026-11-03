<?php

use Illuminate\Support\Facades\Route;
use Marketplace\Product\Presentation\Controllers\IndexProductController;
use Marketplace\Product\Presentation\Controllers\ShowProductController;

Route::get('/', IndexProductController::class);

Route::get('/{id}', ShowProductController::class);
