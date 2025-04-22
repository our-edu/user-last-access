<?php

namespace Ouredu\LastAccess\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Ouredu\LastAccess\LastAccessTrackerServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LastAccessTrackerServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        // Custom config if needed
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Run package migrations
        $this->loadMigrationsFrom(__DIR__.'/../src/database/migrations');
    }
}
