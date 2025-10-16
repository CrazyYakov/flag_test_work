<?php

declare(strict_types=1);

namespace Marketplace\Cart\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Marketplace\Cart\Infrastructure\Interfaces\CartManagerInterface;
use Marketplace\Cart\Infrastructure\Interfaces\CartRepositoryInterface;
use Marketplace\Cart\Infrastructure\Interfaces\ProductRepositoryInterface;
use Marketplace\Cart\Infrastructure\Manager\CartManger;
use Marketplace\Cart\Infrastructure\Repositories\CartRepository;
use Marketplace\Cart\Infrastructure\Repositories\ProductRepository;

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
    }
}
