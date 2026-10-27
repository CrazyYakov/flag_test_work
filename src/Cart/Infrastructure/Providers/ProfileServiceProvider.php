<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Marketplace\Cart\Core\Ports\CartManagerContract;
use Marketplace\Cart\Core\Ports\CartRepositoryContract;
use Marketplace\Cart\Core\Ports\OrderManagerContract;
use Marketplace\Cart\Core\Ports\OrderRepositoryContract;
use Marketplace\Cart\Core\Ports\ProductRepositoryContract;
use Marketplace\Cart\Core\Ports\TransactorContract;
use Marketplace\Cart\Infrastructure\Manager\CartManger;
use Marketplace\Cart\Infrastructure\Manager\OrderManager;
use Marketplace\Cart\Infrastructure\Repositories\CartRepository;
use Marketplace\Cart\Infrastructure\Repositories\OrderRepository;
use Marketplace\Cart\Infrastructure\Repositories\ProductRepository;
use Marketplace\Cart\Infrastructure\Services\Transactor;

class ProfileServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(
            CartRepositoryContract::class,
            CartRepository::class
        );

        $this->app->bind(
            CartManagerContract::class,
            CartManger::class
        );

        $this->app->bind(
            ProductRepositoryContract::class,
            ProductRepository::class
        );

        $this->app->bind(
            OrderRepositoryContract::class,
            OrderRepository::class
        );

        $this->app->bind(
            OrderManagerContract::class,
            OrderManager::class
        );

        $this->app->bind(
            TransactorContract::class,
            Transactor::class,
        );
    }
}
