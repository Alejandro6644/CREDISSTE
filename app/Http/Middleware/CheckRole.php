<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {
        $user = $request->user();

        if ($user && $user->role->nombre == 'Administrador') {
            return $next($request);
        }

        if ($role != 'Administrador' && $user && $user->role->nombre == $role) {
            return $next($request);
        }

        return Redirect::to('/error-login');
    }
}
