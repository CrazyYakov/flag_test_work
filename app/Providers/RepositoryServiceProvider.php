<?php

namespace App\Providers;

use App\Services\Repositories\CartRepository;
use App\Services\Repositories\Interfaces\CartRepositoryInterface;
use App\Services\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Repositories\Interfaces\PaymentMethodRepositoryInterface;
use App\Services\Repositories\Interfaces\StatusRepositoryInterface;
use App\Services\Repositories\OrderRepository;
use App\Services\Repositories\PaymentMethodRepository;
use App\Services\Repositories\StatusRepository;
use Illuminate\Support\ServiceProvider;
use Marketplace\Product\Infrastructure\Interfaces\ProductRepositoryInterface;
use Marketplace\Product\Infrastructure\Repositories\ProductRepository;
use Test\Profile\Infrastructure\Interfaces\UserRepositoryInterface;
use Test\Profile\Infrastructure\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            abstract: CartRepositoryInterface::class,
            concrete: CartRepository::class
        );

        $this->app->bind(
            abstract: PaymentMethodRepositoryInterface::class,
            concrete: PaymentMethodRepository::class
        );

        $this->app->bind(
            abstract: OrderRepositoryInterface::class,
            concrete: OrderRepository::class
        );

        $this->app->bind(
            abstract: StatusRepositoryInterface::class,
            concrete: StatusRepository::class
        );
    }
}
