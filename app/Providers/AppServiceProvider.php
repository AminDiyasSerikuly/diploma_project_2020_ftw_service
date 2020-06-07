<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Firebase\Auth\Token\Verifier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Verifier::class, function ($app) {
//            return new Verifier('firebase-project-name');
            return new Verifier('ein-geiles-project');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
