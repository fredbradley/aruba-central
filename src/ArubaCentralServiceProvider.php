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
            $clientId = (string) config('aruba.client_id');
            $clientSecret = (string) config('aruba.client_secret');
            $baseUrl = (string) config('aruba.base_url');

            return new ArubaCentralConnector(
                $clientId,
                $clientSecret,
                $baseUrl
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
