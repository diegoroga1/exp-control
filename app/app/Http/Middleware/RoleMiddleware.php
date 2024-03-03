<?php

namespace App\Http\Middleware;

use App\Models\Team;
use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = auth()->user();
        if($user->isAdmin()) return $next($request);
        if(!AuthService::hasRole($role)) abort(403,__('errors.team_role_middleware.unauthorized'));
        return $next($request);
    }
}
