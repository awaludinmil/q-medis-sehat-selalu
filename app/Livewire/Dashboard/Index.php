<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Services\Api\DashboardApi;
use App\Services\Api\AuthApi;

class Index extends Component
{
    public ?array $dashboardData = null;
    public ?array $user = null;
    public ?string $error = null;
    public bool $loading = true;
    public bool $isAdmin = false;

    public function mount(): void
    {
        $this->fetchData();
    }

    public function fetchData(): void
    {
        $this->loading = true;
        $this->error = null;
        
        try {
            // Get user info
            $userResponse = app(AuthApi::class)->me();
            $this->user = $userResponse['data'] ?? null;
            $this->isAdmin = ($this->user['role'] ?? '') === 'admin';

            // Get dashboard data
            $response = app(DashboardApi::class)->getData();
            $this->dashboardData = $response['data'] ?? null;
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
            $this->dashboardData = null;
        } finally {
            $this->loading = false;
        }
    }

    public function refresh(): void
    {
        $this->fetchData();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
