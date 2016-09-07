<?php

namespace App\Providers;

use App\Repositories\ExampleRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ExampleRepositoryInterface;

class ExampleProvider extends AbstractServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //...
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerClassAliases([
            'example' => ExampleRepositoryInterface::class,
        ]);

        $this->app->singleton('example', function ($app) {
            return new ExampleRepository(
                $app['events']
            );
        });
    }
}