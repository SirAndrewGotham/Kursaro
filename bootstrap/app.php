<?php

use App\Http\Middleware\AuthGates;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api/v1/backend_api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
//            Route::namespace('App\Http\Controllers\Backend')->prefix('admin')->name('admin.')->group(base_path('routes/backend.php'));
            Route::namespace('App\Http\Controllers\Backend')->prefix('admin')->name('admin.')->group(base_path('routes/backend.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
//        $middleware->authenticateSessions();
//        $middleware->prependToGroup('web', AuthGates::class);

        $middleware->appendToGroup('web', SetLocale::class);
        $middleware->appendToGroup('web', ShareErrorsFromSession::class);
//        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//        $middleware->append(AuthGates::class);
//        $middleware->append(SetLocale::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
