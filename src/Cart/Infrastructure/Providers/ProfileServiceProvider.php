<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Marketplace\Cart\Infrastructure\Interfaces\CartManagerInterface;
use Marketplace\Cart\Infrastructure\Interfaces\CartRepositoryInterface;
use Marketplace\Cart\Infrastructure\Interfaces\OrderManagerInterface;
use Marketplace\Cart\Infrastructure\Interfaces\OrderRepositoryInterface;
use Marketplace\Cart\Infrastructure\Interfaces\ProductRepositoryInterface;
use Marketplace\Cart\Infrastructure\Interfaces\TransactorInterface;
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
            CartRepositoryInterface::class,
            CartRepository::class
        );

        $this->app->bind(
            CartManagerInterface::class,
            CartManger::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->bind(
            OrderManagerInterface::class,
            OrderManager::class
        );

        $this->app->bind(
            TransactorInterface::class,
            Transactor::class,
        );
    }
}
