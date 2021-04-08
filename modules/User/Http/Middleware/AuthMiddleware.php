<?php


namespace Modules\User\Http\Middleware;


use Illuminate\Http\Request;

class AuthMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        if (!sentinel()->check()) {
            return redirect()
                ->route(config('wowlf.user.config.redirect_route_not_authenticated'));
        }

        return $next($request);
    }
}
