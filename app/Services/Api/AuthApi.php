<?php

namespace App\Services\Api;

class AuthApi extends BaseApi
{
    public function login(string $email, string $password): array
    {
        $json = $this->client()->post('/api/auth/login', [
            'email' => $email,
            'password' => $password,
        ])->throw()->json();
        return is_array($json) ? $json : [];
    }

    public function me(): array
    {
        return $this->get('/api/auth/me');
    }

    public function refresh(string $refresh_token): array
    {
        $json = $this->client()->post('/api/auth/refresh', [
            'refresh_token' => $refresh_token,
        ])->throw()->json();
        return is_array($json) ? $json : [];
    }

    public function logout(?string $refresh_token = null): array
    {
        $client = $this->withAuth($this->client());
        $cookieRefresh = session('refresh_token');
        if ($cookieRefresh) {
            $host = parse_url(config('api.base_url'), PHP_URL_HOST) ?: 'localhost';
            $client = $client->withCookies(['refresh_token' => $cookieRefresh], $host);
        }
        $json = $client->post('/api/auth/logout')->throw()->json();
        return is_array($json) ? $json : [];
    }
}
