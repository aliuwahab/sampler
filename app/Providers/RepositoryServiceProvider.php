<?php

namespace App\Providers;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\CheckingRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Eloquent\CheckingRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(CheckingRepositoryInterface::class, CheckingRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
