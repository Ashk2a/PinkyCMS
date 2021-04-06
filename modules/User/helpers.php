<?php

use Cartalyst\Sentinel\Sentinel;

if (!function_exists('sentinel')) {
    function sentinel(): Sentinel
    {
        return app(Sentinel::class);
    }
}
