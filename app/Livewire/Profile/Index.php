<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Services\Api\AuthApi;
use App\Services\Api\UserApi;

class Index extends Component
{
    public array $user = [];
    public ?string $error = null;
    public ?string $success = null;

    // Form fields
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = '';
    public ?string $avatar = null;

    // Modal states
    public bool $showEditModal = false;

    public function mount(): void
    {
        $this->loadProfile();
    }

    public function loadProfile(): void
    {
        $this->error = null;
        try {
            $api = app(AuthApi::class);
            $resp = $api->me();
            $data = $resp['data'] ?? $resp;
            
            $this->user = is_array($data) ? $data : [];
            
            // Populate form fields
            $this->name = $this->user['name'] ?? '';
            $this->email = $this->user['email'] ?? '';
            $this->role = $this->user['role'] ?? '';
            $this->avatar = $this->user['avatar'] ?? null;
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
            $this->user = [];
        }
    }

    public function openEditModal(): void
    {
        $this->showEditModal = true;
        $this->password = '';
        $this->password_confirmation = '';
        $this->error = null;
        $this->success = null;
    }

    public function closeEditModal(): void
    {
        $this->showEditModal = false;
        $this->password = '';
        $this->password_confirmation = '';
        $this->error = null;
        $this->success = null;
    }

    public function updateProfile(): void
    {
        $this->error = null;
        $this->success = null;

        try {
            $userId = $this->user['id'] ?? null;
            if (!$userId) {
                $this->error = 'User ID tidak ditemukan';
                return;
            }

            // Validation
            if ($this->password !== '' && $this->password !== $this->password_confirmation) {
                $this->error = 'Password dan konfirmasi password tidak cocok';
                return;
            }

            if ($this->password !== '' && strlen($this->password) < 6) {
                $this->error = 'Password minimal 6 karakter';
                return;
            }

            $api = app(UserApi::class);
            $payload = [
                'name' => $this->name,
                'email' => $this->email,
            ];

            if ($this->password !== '') {
                $payload['password'] = $this->password;
            }

            $api->update($userId, $payload);
            
            $this->success = 'Profile berhasil diperbarui';
            $this->closeEditModal();
            $this->loadProfile();
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.profile.index');
    }
}
