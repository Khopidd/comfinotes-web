<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role = null)
    {
        if(!Auth::check()) {
            return redirect()->route('auth') ;
        }

        if(Auth::user()->role !== $role){
            abort(403, "Anda Anda di tolak");
        }

        return $next($request);

    }
}
