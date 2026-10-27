<?php

declare(strict_types=1);

namespace Marketplace\Auth\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Marketplace\Auth\Core\Ports\UserMangerContract;
use Marketplace\Auth\Core\Ports\UserRepositoryContract;
use Marketplace\Auth\Infrastructure\Manager\UserManager;
use Marketplace\Auth\Infrastructure\Repositories\UserRepository;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(
            UserRepositoryContract::class,
            UserRepository::class
        );

        $this->app->bind(
            UserMangerContract::class,
            UserManager::class
        );
    }
}
