<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Database Connection
    |--------------------------------------------------------------------------
    */

    'delta_service' => [
        'driver'    => env('DB_CONNECTION', 'mysql'),
        'host'      => env('DB_HOST', 'localhost'),
        'database'  => env('DB_DATABASE', 'homestead'),
        'username'  => env('DB_USERNAME', 'homestead'),
        'password'  => env('DB_PASSWORD', 'secret'),
        'charset'   => env('DB_CHARSET', 'utf8'),
        'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
        'prefix'    => env('DB_PREFIX', ''),

    ],
];
