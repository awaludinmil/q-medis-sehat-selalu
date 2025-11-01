<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Api\AuthApi;

class EnsureFrontendAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('access_token')) {
            $refresh = session('refresh_token');
            if ($refresh) {
                try {
                    $auth = app(AuthApi::class);
                    $resp = $auth->refresh($refresh);
                    $data = $resp['data'] ?? $resp;
                    $newAccess = $data['access_token'] ?? null;
                    $newRefresh = $data['refresh_token'] ?? null;
                    if ($newAccess) {
                        session([
                            'access_token' => $newAccess,
                            'refresh_token' => $newRefresh ?: $refresh,
                        ]);
                        return $next($request);
                    }
                } catch (\Throwable $e) {
                }
            }
            session()->forget(['access_token', 'refresh_token']);
            return redirect()->route('auth.login');
        }
        return $next($request);
    }
}

