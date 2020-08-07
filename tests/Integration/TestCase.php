<?php

namespace Exolnet\LaravelBootstrap4Form\Tests\Integration;

use Exolnet\LaravelBootstrap4Form\Bootstrap4FormServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            Bootstrap4FormServiceProvider::class,
        ];
    }
}
