<?php

namespace FredBradley\ArubaCentral\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            \FredBradley\ArubaCentral\ArubaCentralServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            // e.g. 'YourFacade' => \FredBradley\YourPackage\Facades\YourFacade::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Any custom config or setup
        config()->set('yourpackage.key', 'value');
    }
}
