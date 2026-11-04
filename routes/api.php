<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/auth')
    ->group(base_path('routes/v1/auth.php'));

Route::prefix('/carts')
    ->middleware('auth:sanctum')
    ->group(base_path('routes/v1/carts.php'));

Route::prefix('/products')
    ->group(base_path('routes/v1/products.php'));

Route::prefix('/payment')->group(base_path('routes/v1/payment.php'));

Route::prefix('/orders')
    ->middleware('auth:sanctum')
    ->group(base_path('routes/v1/orders.php'));
