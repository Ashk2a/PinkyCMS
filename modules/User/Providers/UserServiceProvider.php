<?php

namespace Modules\User\Providers;

use Cartalyst\Sentinel\Laravel\SentinelServiceProvider;
use Modules\Core\Providers\ModuleServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Traits\CanPublishMiddleware;
use Modules\User\Http\Middleware\AuthMiddleware;
use Modules\User\Http\Middleware\GuestMiddleware;

class UserServiceProvider extends ModuleServiceProvider
{
    use CanPublishConfiguration, CanPublishMiddleware;

    protected string $moduleName = 'User';
    protected string $moduleNameLower = 'user';

    protected array $providers = [
        'Sentinel' => SentinelServiceProvider::class
    ];

    protected array $routeMiddleware = [
        'auth' => AuthMiddleware::class,
        'guest' => GuestMiddleware::class
    ];

    public function boot(): void
    {
        $this->publishConfig('config');

        $this->registerMiddleware();
    }
}
