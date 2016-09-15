<?php

namespace App\Providers\Routes;

use Dingo\Api\Routing\Router;
use App\Providers\ApiRouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;

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
                'namespace'  => 'App\Http\Controllers',
                'middleware' => 'auth.token'
            ], function ($router) {

                $router->resource('/example', 'ExampleController', [
                    'only' => ['index'],
                    'names' => [
                        'index' => 'example.index',
                    ]
                ]);
            });

            $router->post('/test/{id}/', function ($id) {
                \Log::info('Received message from device with id:' . $id);
                return response()->json([
                    'success' => 'true',
                    'id' => $id
                ]);
            });
        });
    }
}
