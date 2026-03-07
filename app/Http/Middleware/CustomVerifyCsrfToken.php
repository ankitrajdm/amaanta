<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class CustomVerifyCsrfToken extends Middleware
{
    /**
     * URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'login',       // POST login route sometimes triggers 419 in this setup
        'logout',      // may not need but safe
        'admin/*',     // optionally exclude admin AJAX endpoints if any
    ];
}
