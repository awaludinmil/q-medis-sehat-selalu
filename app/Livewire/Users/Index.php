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
    public int $total = 0;
    public int $lastPage = 1;

    // Create/Update form
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $role = '';
    public int|string $edit_id = '';

    // Modal states
    public bool $showAddModal = false;
    public bool $showEditModal = false;
    public bool $showDeleteModal = false;
    public int|string $deleteId = '';

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
            
            // Handle pagination
            if (isset($resp['data']['pagination'])) {
                $pagination = $resp['data']['pagination'];
                $this->total = $pagination['total'] ?? 0;
                $this->lastPage = $pagination['last_page'] ?? 1;
                $this->rows = is_array($resp['data']['data']) ? array_values($resp['data']['data']) : [];
            } elseif (isset($data['data']) && is_array($data['data'])) {
                $this->rows = array_values($data['data']);
                $this->total = count($this->rows);
                $this->lastPage = 1;
            } else {
                $this->rows = is_array($data) ? array_values($data) : [];
                $this->total = count($this->rows);
                $this->lastPage = 1;
            }
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
            $this->rows = [];
            $this->total = 0;
            $this->lastPage = 1;
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
            $this->showAddModal = false;
            $this->refresh();
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function openEditModal(int|string $id): void
    {
        $user = collect($this->rows)->firstWhere('id', $id);
        if ($user) {
            $this->edit_id = $user['id'];
            $this->name = $user['name'] ?? '';
            $this->email = $user['email'] ?? '';
            $this->role = $user['role'] ?? '';
            $this->password = '';
            $this->showEditModal = true;
        }
    }

    public function update(): void
    {
        $this->error = null;
        try {
            $id = (int) $this->edit_id;
            if ($id > 0) {
                $api = app(UserApi::class);
                $payload = [
                    'name' => $this->name,
                    'email' => $this->email,
                    'role' => $this->role ?: null,
                ];
                if ($this->password !== '') {
                    $payload['password'] = $this->password;
                }
                $api->update($id, $payload);
                $this->closeEditModal();
                $this->refresh();
            }
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function closeEditModal(): void
    {
        $this->showEditModal = false;
        $this->edit_id = '';
        $this->name = $this->email = $this->password = $this->role = '';
    }

    public function openDeleteModal(int|string $id): void
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->error = null;
        try {
            if ($this->deleteId) {
                $api = app(UserApi::class);
                $api->delete($this->deleteId);
                $this->closeDeleteModal();
                $this->refresh();
            }
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->deleteId = '';
    }

    public function nextPage(): void
    {
        if ($this->page < $this->lastPage) {
            $this->page++;
            $this->refresh();
        }
    }

    public function prevPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
            $this->refresh();
        }
    }
    
    public function firstPage(): void
    {
        $this->page = 1;
        $this->refresh();
    }
    
    public function lastPageAction(): void
    {
        $this->page = $this->lastPage;
        $this->refresh();
    }
    
    public function goToPage($pageNumber): void
    {
        $this->page = max(1, min((int)$pageNumber, $this->lastPage));
        $this->refresh();
    }
    
    public function updatingPerPage(): void
    {
        $this->page = 1;
    }

    public function render()
    {
        return view('livewire.users.index');
    }
}
