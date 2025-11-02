<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Services\Api\AuthApi;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function loginGoogle()
    {
        $backend = rtrim(config('api.backend_google_redirect'), '/');
        $returnUrl = rtrim(config('api.frontend_url'), '/') . '/auth/google/callback';
        $url = $backend . '?return_url=' . urlencode($returnUrl);
        return Redirect::away($url);
    }

    public function googleCallback(Request $request)
    {
        // Check for error from backend
        $error = $request->query('error');
        if ($error) {
            $errorMessage = $error === 'google_login_failed' 
                ? 'Login dengan Google gagal. Silakan coba lagi.'
                : 'Terjadi kesalahan saat login.';
            return redirect()->route('auth.login')->with('error', $errorMessage);
        }

        // Check for tokens
        $access = $request->query('access_token');
        $refresh = $request->query('refresh_token');
        if ($access) {
            session([
                'access_token' => $access,
                'refresh_token' => $refresh,
            ]);
            return redirect()->route('admin.dashboard');
        }

        // Jika tidak ada token dan tidak ada error, kembali ke login
        return redirect()->route('auth.login')->with('error', 'Login gagal.');
    }

    public function logout()
    {
        try {
            $refresh = session('refresh_token');
            if ($refresh) {
                app(AuthApi::class)->logout($refresh);
            }
        } catch (\Throwable $e) {
        }
        session()->forget(['access_token', 'refresh_token']);
        return redirect()->route('auth.login');
    }
}
