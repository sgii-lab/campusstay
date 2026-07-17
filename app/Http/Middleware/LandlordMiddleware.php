<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;    

class LandlordMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'landlord') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}