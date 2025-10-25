<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Jika user belum login, arahkan ke halaman login.
     */
    protected function redirectTo($request): ?string
    {
        // Jika request bukan API (JSON), redirect ke halaman login
        if (!$request->expectsJson()) {
            return route('login');
        }

        return null;
    }
}
