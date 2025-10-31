<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Services\Api\UserApi;

class Index extends Component
{
    public array $rows = [];
    public int $page = 1;
    public int $per_page = 10;
    public string $search = '';
    public string $order_by = 'id';
    public string $order_dir = 'asc';
    public ?string $error = null;

    // Create form
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $role = '';

    public function mount(): void
    {
        $this->refresh();
    }

    public function updatingSearch(): void
    {
        $this->page = 1;
    }

    public function refresh(): void
    {
        $this->error = null;
        try {
            $api = app(UserApi::class);
            $resp = $api->list([
                'page' => $this->page,
                'per_page' => $this->per_page,
                'search' => $this->search,
                'order_by' => $this->order_by,
                'order_dir' => $this->order_dir,
            ]);
            $data = $resp['data'] ?? $resp['items'] ?? $resp;
            if (isset($data['data']) && is_array($data['data'])) {
                $data = $data['data'];
            }
            $this->rows = is_array($data) ? array_values($data) : [];
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
            $this->rows = [];
        }
    }

    public function create(): void
    {
        $this->error = null;
        try {
            $api = app(UserApi::class);
            $api->create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'role' => $this->role ?: null,
            ]);
            // reset form
            $this->name = $this->email = $this->password = $this->role = '';
            $this->refresh();
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function delete(int|string $id): void
    {
        $this->error = null;
        try {
            $api = app(UserApi::class);
            $api->delete($id);
            $this->refresh();
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function nextPage(): void
    {
        $this->page += 1;
        $this->refresh();
    }

    public function prevPage(): void
    {
        if ($this->page > 1) $this->page -= 1;
        $this->refresh();
    }

    public function render()
    {
        return view('livewire.users.index');
    }
}
