<?php

namespace App\Providers;

use App\Services\App;
use App\Services\Token;
use App\Services\Installer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //app register
        $this->app->singleton('App', function ($app) {
            return new App;
        });
        //token register
        $this->app->singleton('Token', function ($app) {
            return new Token;
        });
        //installer register
        $this->app->singleton('Installer', function ($app) {
            return new Installer;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
