<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\BuyerRepository;
use App\Repositories\SellerRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\BuyerRepositoryInterface;
use App\Repositories\SellerRepositoryInterface;

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
        $this->app->bind(BuyerRepositoryInterface::class, BuyerRepository::class);
        $this->app->bind(SellerRepositoryInterface::class, SellerRepository::class);
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
