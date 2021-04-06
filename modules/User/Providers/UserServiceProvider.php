<?php

namespace Modules\User\Providers;

use Cartalyst\Sentinel\Laravel\SentinelServiceProvider;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;

class UserServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;

    protected array $providers = [
        'Sentinel' => SentinelServiceProvider::class
    ];
}
