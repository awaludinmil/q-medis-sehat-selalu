<?php

namespace App\Services\Api;

class AuthApi extends BaseApi
{
    public function login(string $email, string $password): array
    {
        return $this->post('/api/auth/login', [
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function me(): array
    {
        return $this->get('/api/auth/me');
    }

    public function refresh(string $refresh_token): array
    {
        return $this->post('/api/auth/refresh', [
            'refresh_token' => $refresh_token,
        ]);
    }

    public function logout(?string $refresh_token = null): array
    {
        $data = [];
        if ($refresh_token) {
            $data['refresh_token'] = $refresh_token;
        }
        return $this->post('/api/auth/logout', $data);
    }
}
