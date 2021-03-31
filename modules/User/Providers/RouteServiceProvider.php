<?php

namespace Modules\User\Providers;

use Modules\Core\Providers\RoutingServiceProvider;

class RouteServiceProvider extends RoutingServiceProvider
{
    protected $namespace = 'Modules\User\Http\Controllers';

    protected function getApiRouteFilePath(): string
    {
        return module_path('user', 'Routes/api.php');
    }

    protected function getPublicRouteFilePath(): string
    {
        return module_path('user', 'Routes/public.php');
    }

    protected function getAdminRouteFilePath(): string
    {
        return module_path('user', 'Routes/admin.php');
    }
}
