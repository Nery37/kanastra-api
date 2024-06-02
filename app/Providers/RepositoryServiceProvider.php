<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\BilletRepository;
use App\Repositories\BilletRepositoryEloquent;
use App\Repositories\FileRepository;
use App\Repositories\FileRepositoryEloquent;
use App\Repositories\PasswordResetRepository;
use App\Repositories\PasswordResetRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register() {}

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(PasswordResetRepository::class, PasswordResetRepositoryEloquent::class);
        $this->app->bind(FileRepository::class, FileRepositoryEloquent::class);
        $this->app->bind(BilletRepository::class, BilletRepositoryEloquent::class);
    }
}
