<?php

namespace Exolnet\LaravelBootstrap4Form\Tests\Integration;

use Collective\Html\FormFacade;
use Collective\Html\HtmlFacade;
use Collective\Html\HtmlServiceProvider;
use Exolnet\HtmlList\HtmlListServiceProvider;
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
            HtmlListServiceProvider::class,
            HtmlServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'form' => FormFacade::class,
            'Html' => HtmlFacade::class,
        ];
    }
}
