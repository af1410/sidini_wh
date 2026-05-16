<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('guru')->check() && Auth::guard('guru')->user()->jabatan === 'admin') {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Anda tidak memiliki akses');
    }
}
