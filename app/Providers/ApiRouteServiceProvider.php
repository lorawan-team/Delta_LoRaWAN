<?php

namespace App\Providers;

use Dingo\Api\Routing\Router;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

abstract class ApiRouteServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutes();
    }

    /**
     * Load the application routes.
     *
     * @return void
     */
    protected function loadRoutes()
    {
        $this->app->call([$this, 'map']);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Pass dynamic methods onto the router instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->app->make(Router::class), $method], $parameters);
    }
}
