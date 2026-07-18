<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // global middleware
    ];

    protected $middlewareGroups = [
        'web' => [
            // web middleware stack
        ],
        'api' => [
            // api middleware stack
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'landlord' => \App\Http\Middleware\LandlordMiddleware::class, // ✅ register here
        'admin.only' => \App\Http\Middleware\AdminOnly::class,
    ];
    
}
