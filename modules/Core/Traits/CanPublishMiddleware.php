<?php

namespace Modules\Core\Traits;

use Illuminate\Foundation\Http\Kernel;

trait CanPublishMiddleware
{
    public function registerMiddleware(): void
    {
        $kernel = app(Kernel::class);

        foreach ($this->middleware as $middleware) {
            $kernel->pushMiddleware($middleware);
        }

        foreach ($this->routeMiddleware as $name => $class) {
            router()->aliasMiddleware("$this->moduleNameLower.$name", $class);
        }

        foreach ($this->middlewareGroups as $name => $group) {
            router()->middlewareGroup("$this->moduleNameLower.$name", $group);
        }
    }
}
