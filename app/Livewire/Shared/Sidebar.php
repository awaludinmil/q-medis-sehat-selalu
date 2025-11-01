<?php

namespace App\Livewire\Shared;

use Livewire\Component;
use App\Services\Api\AuthApi;

class Sidebar extends Component
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

    public function render()
    {
        return view('livewire.shared.sidebar');
    }
}
