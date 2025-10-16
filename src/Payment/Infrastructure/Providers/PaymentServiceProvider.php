<?php

declare(strict_types=1);

namespace Marketplace\Payment\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Marketplace\Payment\Infrastructure\Interfaces\PaymentMethodRepositoryInterface;
use Marketplace\Payment\Infrastructure\Repositories\PaymentMethodRepository;
use Marketplace\Payment\Infrastructure\Services\Banks\AlphaBank;
use Marketplace\Payment\Infrastructure\Services\Banks\BetaBank;
use Marketplace\Payment\Infrastructure\Services\TokenService;

class PaymentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app
            ->when(AlphaBank::class)
            ->needs(TokenService::class)
            ->give(function () {
                return new TokenService(
                   tokenKey: config('domain.payment.methods.alpha_bank.token_key'),
                   alg: config('domain.payment.methods.alpha_bank.alg')
                );
            });

        $this->app
            ->when(BetaBank::class)
            ->needs(TokenService::class)
            ->give(function () {
                return new TokenService(
                    tokenKey: config('domain.payment.methods.beta_bank.token_key'),
                    alg: config('domain.payment.methods.beta_bank.alg')
                );
            });

        $this->app->bind(
            PaymentMethodRepositoryInterface::class,
            PaymentMethodRepository::class,
        );
    }
}
