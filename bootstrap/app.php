<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__.'/../routes/web.php',
            __DIR__.'/../routes/admin.php',
            __DIR__.'/../routes/auth.php',
            __DIR__.'/../routes/user.php',
        ],

        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'auth' => \App\Http\Middleware\AuthMiddleware::class,
            'web' => \App\Http\Middleware\Encrytion::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

    })
    ->withProviders([
        App\Providers\NotificationServiceProvider::class,

    ])->create();
