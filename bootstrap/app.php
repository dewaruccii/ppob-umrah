<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        api: __DIR__ . '/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->redirectGuestsTo(fn(Request $request) => route('auth.index'));
        $middleware->redirectUsersTo(fn(Request $request) => route('dashboard'));
        $middleware->validateCsrfTokens(except: [
            'v1/webhook/midtrans', // Sesuaikan dengan URL route webhook kamu
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
