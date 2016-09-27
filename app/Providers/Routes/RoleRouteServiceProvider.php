<?php

namespace App\Providers\Routes;

use Dingo\Api\Routing\Router;
use App\Providers\ApiRouteServiceProvider as ServiceProvider;

class RoleRouteServiceProvider extends ServiceProvider
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
                'namespace'  => 'App\Http\Controllers\Roles',
                'middleware' => 'auth.token',
            ], function ($router) {

                $router->resource('/role', 'RoleController', [
                    'only' => ['index', 'show', 'store', 'update', 'destroy'],
                    'names' => [
                        'index' => 'role.index',
                        'show' => 'role.show',
                        'store' => 'role.store',
                        'update' => 'role.update',
                        'destroy' => 'role.destroy',
                    ]
                ]);
            });
        });
    }
}
