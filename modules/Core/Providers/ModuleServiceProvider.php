<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;

abstract class ModuleServiceProvider extends ServiceProvider
{
    protected string $moduleName = '';
    protected string $moduleNameLower = '';

    /**
     * The application's route middleware.
     * These middleware may be assigned to groups or used individually.
     */
    protected array $middleware = [];

    /**
     * The application's route middleware.
     * These middleware may be assigned to groups or used individually.
     */
    protected array $routeMiddleware = [];

    /**
     * The application's route middleware groups.
     */
    protected array $middlewareGroups = [];

    protected array $middlewarePriority = [];

    public function boot(): void
    {
    }

    public function register(): void
    {
    }
}
