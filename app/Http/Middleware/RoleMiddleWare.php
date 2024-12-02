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
            if ($role == 2) {
                return $next($request);
            } else{
                return redirect()->route('guest.home')->with('error',"Chỉ người dùng mới được đặt phòng");  
            }            
        }
        return $next($request);
    }
}