<?php

namespace Exolnet\LaravelBootstrap4Form\Tests\Integration;

use Exolnet\HtmlList\HtmlListServiceProvider;
use Exolnet\LaravelBootstrap4Form\Bootstrap4FormServiceProvider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;
use Mockery;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Html\Facades\Html;
use Spatie\Html\Html as HtmlBuilder;
use Spatie\Html\HtmlServiceProvider;

abstract class TestCase extends Orchestra
{
    /**
     * @var HtmlBuilder
     */
    protected $formBuilder;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setup();

        $this->urlGenerator = new UrlGenerator(new RouteCollection(), Request::create('/foo', 'GET'));
        $this->viewFactory = Mockery::mock(Factory::class);

        // prepare request for test with some data
        $request = Request::create('/foo', 'GET', [
            "person" => [
                "name" => "John",
                "surname" => "Doe",
            ],
            "agree" => 1,
            "checkbox_array" => [1, 2, 3],
        ]);

        $request = Request::createFromBase($request);

        $this->formBuilder = new HtmlBuilder($request);
    }

    /**
     * Destroy the test environment.
     */
    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    protected function stripHtml($html)
    {
        return trim(preg_replace('/\s+/', '', $html));
    }

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
            'Html' => Html::class,
        ];
    }
}
