<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->group(function () {
    Route::post('/registration', [UserController::class, 'registration']);

    Route::post('/authorization', [UserController::class, 'authorization']);
});
