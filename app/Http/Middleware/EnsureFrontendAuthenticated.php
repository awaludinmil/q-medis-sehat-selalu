<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureFrontendAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('access_token')) {
            return redirect()->route('auth.login');
        }
        return $next($request);
    }
}
