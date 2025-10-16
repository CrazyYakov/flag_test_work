<?php

declare(strict_types=1);

namespace Marketplace\Auth\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Marketplace\Auth\Infrastructure\Interfaces\UserMangerInterface;
use Marketplace\Auth\Infrastructure\Interfaces\UserRepositoryInterface;
use Marketplace\Auth\Infrastructure\Manager\UserManager;
use Marketplace\Auth\Infrastructure\Repositories\UserRepository;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            UserMangerInterface::class,
            UserManager::class
        );
    }
}
