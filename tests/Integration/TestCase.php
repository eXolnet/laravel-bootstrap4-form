<?php

namespace Exolnet\LaravelBootstrap4Form\Tests\Integration;

use Collective\Html\FormBuilder;
use Collective\Html\FormFacade;
use Collective\Html\HtmlBuilder;
use Collective\Html\HtmlFacade;
use Collective\Html\HtmlServiceProvider;
use Exolnet\HtmlList\HtmlListServiceProvider;
use Exolnet\LaravelBootstrap4Form\Bootstrap4FormServiceProvider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;
use Mockery;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{

    /**
     * @var FormBuilder
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
        $this->htmlBuilder = new HtmlBuilder($this->urlGenerator, $this->viewFactory);

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

        $this->formBuilder = new FormBuilder(
            $this->htmlBuilder,
            $this->urlGenerator,
            $this->viewFactory,
            'abc',
            $request
        );
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
            'form' => FormFacade::class,
            'Html' => HtmlFacade::class,
        ];
    }
}
