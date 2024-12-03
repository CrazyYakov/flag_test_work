<?php

namespace App\Providers;

use App\Services\Repositories\Interfaces\CartRepositoryInterface;
use App\Services\Repositories\Interfaces\PaymentMethodRepositoryInterface;
use App\Services\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Repositories\CartRepository;
use App\Services\Repositories\PaymentMethodRepository;
use App\Services\Repositories\ProductRepository;
use App\Services\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            abstract: UserRepositoryInterface::class,
            concrete: UserRepository::class
        );

        $this->app->bind(
            abstract: CartRepositoryInterface::class,
            concrete: CartRepository::class
        );

        $this->app->bind(
            abstract: ProductRepositoryInterface::class,
            concrete: ProductRepository::class
        );

        $this->app->bind(
            abstract: PaymentMethodRepositoryInterface::class,
            concrete: PaymentMethodRepository::class
        );
    }
}
