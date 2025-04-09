<?php

declare(strict_types=1);

namespace FredBradley\ArubaCentral;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ArubaCentralServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        // For Facade
        $this->app->singleton('Aruba', static function (Application $app) {
            return new ArubaCentral;
        });

        // For Dependency Injection
        $this->app->bind(ArubaCentralConnector::class, static function (Application $app) {
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
            __DIR__.'/../config/config.php' => config_path('aruba.php'),
        ], 'config');
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'aruba');
    }
}
