<?php

namespace App\Providers;

use App\Mail\UserCreated;
use App\Mail\UserMailChanged;
use App\User;
use App\Vendor; 
use Illuminate\Support\Facades\Mail;
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
        User::updated(function($user){
            if($user->isDirty('email')){
                Mail::to($user->email)->send(new UserMailChanged($user));
            }
            
        });
        User::created(function($user){
            Mail::to($user->email)->send(new UserCreated($user));
        });


        Vendor::updated(function($vendor) {
            if ($vendor->amount == 0 && $vendor->isAvailable()) {
                $vendor->status = Vendor::UNAVAILABLE_VENDOR;

                $vendor->save();
            }
        });
    }
}
