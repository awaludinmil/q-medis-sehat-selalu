<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\Api\AuthApi;

class LoginForm extends Component
{
    public string $email = '';
    public string $password = '';
    public ?string $error = null;

    public function login(): void
    {
        $this->error = null;
        try {
            $api = app(AuthApi::class);
            $resp = $api->login($this->email, $this->password);
            $data = $resp['data'] ?? $resp;
            $access = $data['access_token'] ?? null;
            $refresh = $data['refresh_token'] ?? null;
            if (!$access) {
                throw new \RuntimeException('Token tidak ditemukan');
            }
            session([
                'access_token' => $access,
                'refresh_token' => $refresh,
            ]);
            $this->redirectRoute('admin.users', navigate: true);
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
