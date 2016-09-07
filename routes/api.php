<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/*Route::group(
    [
        'namespace' => '',
        'prefix' => '/example',
        'middleware => '',
    ],
    function () {
        Route::get('/', [
            'as' => 'example.show',
            'uses' => 'ExampleController@show'
        ]);
    }
);*/

Route::resource('/example', 'ExampleController', [
    'only' => ['index'],
    'names' => [
        'index' => 'example.index',
    ]
]);
