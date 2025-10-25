<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnsureEmailIsVerified
{
    /**
     * Pastikan user sudah verifikasi email sebelum lanjut.
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika user belum login, arahkan ke login
        if (!$request->user()) {
            return Redirect::route('login');
        }

        // Jika user belum verifikasi email, arahkan ke halaman verifikasi
        if ($request->user() && !$request->user()->hasVerifiedEmail()) {
            return Redirect::route('verification.notice');
        }

        return $next($request);
    }
}
