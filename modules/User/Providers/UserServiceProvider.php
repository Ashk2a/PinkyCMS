<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;

class UserServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
}
