<?php

declare(strict_types=1);

namespace Marketplace\Product\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Marketplace\Product\Infrastructure\Interfaces\ProductRepositoryInterface;
use Marketplace\Product\Infrastructure\Repositories\ProductRepository;

class ProductServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(
            abstract: ProductRepositoryInterface::class,
            concrete: ProductRepository::class
        );
    }
}
