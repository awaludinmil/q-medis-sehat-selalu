<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

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
        $access = $request->query('access_token');
        $refresh = $request->query('refresh_token');
        if ($access) {
            session([
                'access_token' => $access,
                'refresh_token' => $refresh,
            ]);
            return redirect()->route('admin.users');
        }
        // Jika tidak ada token, kembali ke login
        return redirect()->route('auth.login');
    }

    public function logout()
    {
        // Optional: panggil backend logout di sini jika perlu
        session()->forget(['access_token', 'refresh_token']);
        return redirect()->route('auth.login');
    }
}
