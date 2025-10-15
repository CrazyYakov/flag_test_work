<?php

namespace App\Providers;

use App\Services\Payments\Methods\AlphaBank;
use App\Services\Payments\Methods\BetaBank;
use App\Services\Payments\TokenService;
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
        $this->app
            ->when(AlphaBank::class)
            ->needs(TokenService::class)
            ->give(function () {
                return new TokenService(
                    config()->get('services.payment.token_key'),
                    config()->get('services.payment.alg')
                );
            });

        $this->app
            ->when(BetaBank::class)
            ->needs(TokenService::class)
            ->give(function () {
                return new TokenService(
                    config()->get('services.payment.token_key'),
                    config()->get('services.payment.alg')
                );
            });
    }
}
