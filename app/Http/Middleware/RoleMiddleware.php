<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if ($request->user() == null) {
            abort(404);
        }
        $role = explode("|", $role);
        $stat = false;
        foreach ($role as $value) {
            if ($request->user()->hasRole($value)) {
                $stat = true;
            }
        }
        if (!$stat) {
            abort(404);
        }
        
        if ($permission !== null && !$request->user()->can($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
