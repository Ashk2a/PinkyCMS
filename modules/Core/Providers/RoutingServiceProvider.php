<?php

namespace Modules\Core\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

abstract class RoutingServiceProvider extends RouteServiceProvider
{
    protected $namespace = '';

    abstract protected function getApiRouteFilePath(): string;

    abstract protected function getPublicRouteFilePath(): string;

    abstract protected function getAdminRouteFilePath(): string;

    public function boot(): void
    {
        parent::boot();
    }

    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {
            $this->loadApiRoutes($router);
        });

        $router->group([
            'namespace' => $this->namespace,
            'middleware' => ['web', 'theme'],
        ], function (Router $router) {
            $this->loadPublicRoutes($router);
            $this->loadAdminRoutes($router);
        });
    }

    private function loadApiRoutes(Router $router): void
    {
        $api = $this->getApiRouteFilePath();

        if ($api && file_exists($api)) {
            $router->group([
                'namespace' => 'Api',
                'prefix' => 'api',
                'middleware' => config('wowlf.core.core.middleware.api', []),
            ], function (Router $router) use ($api) {
                require $api;
            });
        }
    }

    private function loadPublicRoutes(Router $router): void
    {
        $public = $this->getPublicRouteFilePath();

        if ($public && file_exists($public)) {
            $router->group([
                'middleware' => config('wowlf.core.core.middleware.public', []),
            ], function (Router $router) use ($public) {
                require $public;
            });
        }
    }

    private function loadAdminRoutes(Router $router): void
    {
        $admin = $this->getAdminRouteFilePath();

        if ($admin && file_exists($admin)) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'middleware' => config('wowlf.core.core.middleware.admin', []),
            ], function (Router $router) use ($admin) {
                require $admin;
            });
        }
    }

}
