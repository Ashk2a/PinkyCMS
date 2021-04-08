<?php

namespace Modules\User\Providers;

use Cartalyst\Sentinel\Laravel\SentinelServiceProvider;
use Modules\Core\Providers\ModuleServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;

class UserServiceProvider extends ModuleServiceProvider
{
    use CanPublishConfiguration;

    protected string $moduleName = 'User';
    protected string $moduleNameLower = 'user';

    protected array $providers = [
        'Sentinel' => SentinelServiceProvider::class
    ];

    public function boot(): void
    {
        $this->publishConfig('config');
    }
}
