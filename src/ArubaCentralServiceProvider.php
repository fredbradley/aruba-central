<?php

namespace FredBradley\ArubaCentral;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ArubaCentralServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        // For Facade
        $this->app->singleton('aruba', function (Application $app) {
            return new ArubaCentralConnector(
                config('aruba.client_id'),
                config('aruba.client_secret'),
                config('aruba.base_url')
            );
        });

        // For Dependency Injection
        $this->app->singleton(ArubaCentralConnector::class, function (Application $app) {
            return new ArubaCentralConnector(
                config('aruba.client_id'),
                config('aruba.client_secret'),
                config('aruba.base_url')
            );
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('aruba.php'),
        ], 'config');
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'aruba');
    }

}
