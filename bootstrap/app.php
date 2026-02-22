<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserHasRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'auth' => Authenticate::class,
            'guest' => RedirectIfAuthenticated::class,
            'admin' => EnsureUserIsAdmin::class,
            'role' => EnsureUserHasRole::class,
        ]);
    })
    ->withExceptions(function ($exceptions) {
        //
    })
    ->create();
