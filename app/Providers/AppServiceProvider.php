<?php

namespace App\Providers;

use App\Services\Config;
use App\Services\RequestMoneyValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Config::class, fn() => new Config());
        $this->app->bind(RequestMoneyValidator::class, fn($app) => new RequestMoneyValidator($app->make(Config::class)));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
