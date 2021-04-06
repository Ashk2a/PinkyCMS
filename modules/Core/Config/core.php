<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Check if asgard was installed
    |--------------------------------------------------------------------------
    */
    'is_installed' => env('INSTALLED', false),

    /*
   |--------------------------------------------------------------------------
   | The prefix that'll be used for the administration
   |--------------------------------------------------------------------------
   */
    'admin-url-prefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    | You can customise the Middleware that should be loaded.
    | The localizationRedirect middleware is automatically loaded for both
    | Backend and Frontend routes.
    */
    'middleware' => [
        'admin' => [],
        'public' => [],
        'api' => [
            'api',
        ],
    ]
];
