<?php

namespace App\Providers\Routes;

use Dingo\Api\Routing\Router;
use App\Providers\ApiRouteServiceProvider as ServiceProvider;

class DeviceRouteServiceProvider extends ServiceProvider
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
                'namespace'  => 'App\Http\Controllers\Devices'
            ], function ($router) {

                $router->resource('/device', 'DeviceController', [
                    'only' => ['index', 'show', 'store', 'update', 'destroy'],
                    'names' => [
                        'index' => 'device.index',
                        'show' => 'device.show',
                        'store' => 'device.store',
                        'update' => 'device.update',
                        'destroy' => 'device.destroy',
                    ]
                ]);
            });
        });
    }
}
