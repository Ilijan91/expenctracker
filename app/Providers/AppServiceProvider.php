<?php

namespace App\Providers;

use App\Vendor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Vendor::updated(function($vendor) {
            if ($vendor->amount == 0 && $vendor->isAvailable()) {
                $vendor->status = Vendor::UNAVAILABLE_VENDOR;

                $vendor->save();
            }
        });
    }
}
