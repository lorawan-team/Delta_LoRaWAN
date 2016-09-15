<?php

namespace App\Providers\Routes;

use Dingo\Api\Routing\Router;
use App\Providers\ApiRouteServiceProvider as ServiceProvider;

class SensorRouteServiceProvider extends ServiceProvider
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
                'namespace'  => 'App\Http\Controllers\Sensors'
            ], function ($router) {

                $router->resource('/sensor', 'SensorController', [
                    'only' => ['index', 'show', 'store', 'update', 'destroy'],
                    'names' => [
                        'index' => 'sensor.index',
                        'show' => 'sensor.show',
                        'store' => 'sensor.store',
                        'update' => 'sensor.update',
                        'destroy' => 'sensor.destroy',
                    ]
                ]);
            });
        });
    }
}
