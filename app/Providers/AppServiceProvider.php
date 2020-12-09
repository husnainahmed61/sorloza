<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
<<<<<<< HEAD
=======

>>>>>>> 6779ae43f2fd263676be2c8f4fec1dd4d008af1f
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
<<<<<<< HEAD
=======
        //
>>>>>>> 6779ae43f2fd263676be2c8f4fec1dd4d008af1f
    }
}
