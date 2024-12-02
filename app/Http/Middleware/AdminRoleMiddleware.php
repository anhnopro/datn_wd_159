<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            if ($role == 0) {
                return $next($request);
            } else{
                return redirect()->route('guest.home');
            }            
        }

        return $next($request);
    }
}