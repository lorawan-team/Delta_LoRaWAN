<?php

namespace App\Providers\Routes;

use Dingo\Api\Routing\Router;
use App\Providers\ApiRouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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

            $router->post('/test/{id}/', function ($id) {
                // First we fetch the Request instance
                $request = app()->make('request');
                // Now we can get the content from it
                $content = $request->all();

                \Log::info('Received message from device with id:' . $id . ', value:' . json_encode($content));

                return response()->json([
                    'success' => 'true',
                    'id' => $id,
                    'content' => $content
                ]);
            });
        });
    }
}
