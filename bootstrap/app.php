<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    // Bagian middleware — tambahkan semua alias kustom di sini
    ->withMiddleware(function (Middleware $middleware) {
        /**
         * Daftar middleware alias.
         * Kamu bisa menambahkan middleware baru seperti contoh di bawah.
         */
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'auth' => \App\Http\Middleware\Authenticate::class,
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'isBuyer' => \App\Http\Middleware\IsBuyer::class, 
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();
