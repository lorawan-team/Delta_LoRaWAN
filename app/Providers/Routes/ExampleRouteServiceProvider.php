<?php

namespace App\Providers\Routes;

use Dingo\Api\Routing\Router;
use App\Providers\ApiRouteServiceProvider as ServiceProvider;

class ExampleRouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @param  \Dingo\Api\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->version('v1', function ($router) {
            $router->group([
                'namespace'  => 'App\Http\Controllers'
            ], function ($router) {

                $router->resource('/example', 'ExampleController', [
                    'only' => ['index'],
                    'names' => [
                        'index' => 'example.index',
                    ]
                ]);
    
                $router->resource('/user', 'Auth\RegisterController', [
                    'only' => ['store'],
                    'names' => [
                        'store' => 'user.store',
                    ]
                ]);
            });
        });
    }
}
