<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $role = Auth::user()->role;
            if ($role == 0) {
                return redirect('/admin/dashboard');
            } elseif ($role == 1) {
                return redirect('/landlord_admin/dashboard');
            }
        }

        return $next($request);
    }
}
