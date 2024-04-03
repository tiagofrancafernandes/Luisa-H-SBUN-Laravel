<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminUserOnly extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        parent::handle($request, $next, ...$guards);

        abort_unless($request?->user(), 403, 'Forbidden');
        abort_unless($request?->user()?->isAdmin(), 401, 'Unauthorized');

        return $next($request);
    }
}
