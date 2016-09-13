<?php

namespace App\Providers;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     * In addition, it is set as the URL generator's root namespace.
     *
     * Note: This doesn't work for Dingo\Api routes.
     *
     * @var string|null
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The route service providers for the application.
     *
     * @var array
     */
    protected $providers = [
        \App\Providers\Routes\ExampleRouteServiceProvider::class,
        \App\Providers\Routes\DevicesRouteServiceProvider::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setRootControllerNamespace();

        $this->registerProviders($this->providers);
    }

    /**
     * Set the root controller namespace for the application.
     *
     * @return void
     */
    protected function setRootControllerNamespace()
    {
        if (is_null($this->namespace)) {
            return;
        }

        $this->app[UrlGenerator::class]->setRootControllerNamespace($this->namespace);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register any route service providers.
     *
     * @param  array  $providers
     * @return void
     */
    protected function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            $this->app->register($provider);
        }
    }
}
