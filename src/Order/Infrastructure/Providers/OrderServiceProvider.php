<?php

declare(strict_types=1);

namespace Marketplace\Order\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Marketplace\Order\Infrastructure\Interfaces\OrderManagerInterface;
use Marketplace\Order\Infrastructure\Interfaces\OrderRepositoryInterface;
use Marketplace\Order\Infrastructure\Repositories\OrderRepository;

class OrderServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->app->bind(
            abstract: OrderRepositoryInterface::class,
            concrete: OrderRepository::class
        );

        $this->app->bind(
            abstract: OrderManagerInterface::class,
            concrete: OrderManager::class,
        );
    }
}
