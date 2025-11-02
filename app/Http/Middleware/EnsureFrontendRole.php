<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Api\AuthApi;

class EnsureFrontendRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        try {
            $resp = app(AuthApi::class)->me();
            $data = $resp['data'] ?? $resp;
            $role = (string) ($data['role'] ?? '');
            if ($roles && ! in_array($role, $roles, true)) {
                abort(403);
            }
        } catch (\Throwable $e) {
            return redirect()->route('auth.login');
        }

        return $next($request);
    }
}
