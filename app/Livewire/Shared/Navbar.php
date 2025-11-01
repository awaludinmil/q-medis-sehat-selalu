<?php

namespace App\Livewire\Shared;

use Livewire\Component;
use App\Services\Api\AuthApi;

class Navbar extends Component
{
    public $user = null;

    public function mount()
    {
        if (session('access_token')) {
            try {
                $response = app(AuthApi::class)->me();
                $this->user = $response['data'] ?? null;
            } catch (\Throwable $e) {
                $this->user = null;
            }
        }
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

    public function render()
    {
        return view('livewire.shared.navbar');
    }
}
