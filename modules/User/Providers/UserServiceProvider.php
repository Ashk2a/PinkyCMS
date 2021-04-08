<?php

namespace Modules\User\Providers;

use Cartalyst\Sentinel\Laravel\SentinelServiceProvider;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;

class UserServiceProvider extends ServiceProvider
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
