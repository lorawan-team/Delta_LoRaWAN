<?php

namespace App\Providers\Routes;

use Dingo\Api\Routing\Router;
use App\Providers\ApiRouteServiceProvider as ServiceProvider;

class UserRouteServiceProvider extends ServiceProvider
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
                'namespace'  => 'App\Http\Controllers\Users',
            ], function ($router) {

                $router->resource('/user', 'UserController', [
                    'only' => ['show',],
                    'names' => [
                        'show' => 'user.show',
                    ]
                ]);
            });
        });
    }
}
