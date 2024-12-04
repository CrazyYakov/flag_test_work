<?php

namespace App\Providers;

use App\Services\Payments\Payment;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Payment::setTokenKey(config('payment.token_key'));

        Payment::setAlg(config('payment.alg'));
    }
}
