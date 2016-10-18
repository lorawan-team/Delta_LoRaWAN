<?php

namespace App\Providers\Routes;

use Dingo\Api\Routing\Router;
use App\Providers\ApiRouteServiceProvider as ServiceProvider;

class MeasurementRouteServiceProvider extends ServiceProvider
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
                'namespace'  => 'App\Http\Controllers\Measurements',
                'middleware' => 'auth.token',
            ], function ($router) {

                $router->resource('/{deviceEui}/measurement', 'MeasurementController', [
                    'only' => ['index', 'show', 'destroy'],
                    'names' => [
                        'index' => 'measurement.index',
                        'show' => 'measurement.show',
                        'destroy' => 'measurement.destroy',
                    ]
                ]);
            });

            $router->group([
                'namespace' => 'App\Http\Controllers\Measurements',
            ], function($router){

                $router->resource('/{deviceEui}/measurement', 'MeasurementController', [
                    'only' => ['store'],
                    'names' => [
                        'store' => 'measurement.store',
                    ]
                ]);
            });
        });
    }
}
