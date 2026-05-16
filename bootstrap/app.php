<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'is_siswa' => \App\Http\Middleware\IsSiswa::class,
            'is_guru' => \App\Http\Middleware\IsGuru::class,
            'is_admin' => \App\Http\Middleware\IsAdmin::class,
            'is_kurikulum' => \App\Http\Middleware\IsKurikulum::class,
            'is_kepsek' => \App\Http\Middleware\IsKepsek::class,
            'is_ortu' => \App\Http\Middleware\IsOrtu::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
