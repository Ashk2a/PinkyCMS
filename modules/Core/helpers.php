<?php

use Illuminate\Routing\Router;
use Nwidart\Modules\Laravel\LaravelFileRepository;
use Shipu\Themevel\Contracts\ThemeContract;
use Shipu\Themevel\Managers\Theme;

if (! function_exists('modules')) {
    function modules(): LaravelFileRepository
    {
        return app(LaravelFileRepository::class);
    }
}

if (! function_exists('router')) {
    function router(): Router
    {
        return app(Router::class);
    }
}

if (! function_exists('themevel')) {
    function themevel(): Theme
    {
        return app(ThemeContract::class);
    }
}
