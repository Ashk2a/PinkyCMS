<?php

namespace Modules\Core\Providers;

class RouteServiceProvider extends RoutingServiceProvider
{
    protected $namespace = 'Modules\Core\Http\Controllers';

    protected function getApiRouteFilePath(): string
    {
        return module_path('core', 'Routes/api.php');
    }

    protected function getPublicRouteFilePath(): string
    {
        return module_path('core', 'Routes/public.php');
    }

    protected function getAdminRouteFilePath(): string
    {
        return module_path('core', 'Routes/admin.php');
    }
}
