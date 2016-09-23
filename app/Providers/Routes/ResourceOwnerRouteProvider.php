<?php

namespace App\Providers\Routes;

use Dingo\Api\Routing\Router;
use App\Providers\ApiRouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;

class ResourceOwnerRouteProvider extends ServiceProvider
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
                'namespace'  => 'App\Http\Controllers',
                'middleware' => 'auth.token'
            ], function ($router) {

                $router->resource('/me', 'ResourceOwnerController', [
                    'only' => ['index'],
                    'names' => [
                        'index' => 'owner.index',
                    ]
                ]);
            });
        });
    }
}
