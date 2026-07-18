<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    public function handle($request, Closure $next)
    {
        // Allow access to login page
        if ($request->is('admin/login') || $request->is('admin/login/*')) {
            return $next($request);
        }

        // Check guard and role
        if (!Auth::guard('admin')->check() || Auth::guard('admin')->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized');
        }

        return $next($request);
    }
}
