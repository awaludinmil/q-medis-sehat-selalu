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
        $data = [];
        if ($refresh_token) {
            $data['refresh_token'] = $refresh_token;
        }
        $client = $this->withAuth($this->client());
        $json = $client->post('/api/auth/logout', $data)->throw()->json();
        return is_array($json) ? $json : [];
    }
}
