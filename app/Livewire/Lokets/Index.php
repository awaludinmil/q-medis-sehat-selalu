<?php

namespace App\Livewire\Lokets;

use Livewire\Component;
use App\Services\Api\LoketApi;
use App\Services\Api\AuthApi;

class Index extends Component
{
    public array $rows = [];
    public int $page = 1;
    public int $per_page = 10;
    public string $search = '';
    public string $order_by = 'id';
    public string $order_dir = 'asc';
    public ?string $error = null;
    public ?array $user = null;
    public bool $isAdmin = false;
    public int $total = 0;
    public int $lastPage = 1;

    // Create/Update form
    public string $nama_loket = '';
    public string $kode_prefix = '';
    public string $deskripsi = '';
    public int|string $edit_id = '';

    // Modal states
    public bool $showAddModal = false;
    public bool $showEditModal = false;
    public bool $showDeleteModal = false;
    public int|string $deleteId = '';
    public int|string|null $openMenuId = null;

    public function mount(): void
    {
        // Check user role
        if (session('access_token')) {
            try {
                $response = app(AuthApi::class)->me();
                $this->user = $response['data'] ?? null;
                $this->isAdmin = (($this->user['role'] ?? '') === 'admin');
            } catch (\Throwable $e) {
                $this->user = null;
                $this->isAdmin = false;
            }
        }
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
            $api = app(LoketApi::class);
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
        if (!$this->isAdmin) {
            $this->error = 'Tidak diizinkan';
            return;
        }
        try {
            $api = app(LoketApi::class);
            $api->create([
                'nama_loket' => $this->nama_loket,
                'kode_prefix' => $this->kode_prefix,
                'deskripsi' => $this->deskripsi ?: null,
            ]);
            $this->nama_loket = $this->kode_prefix = $this->deskripsi = '';
            $this->showAddModal = false;
            $this->refresh();
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function openEditModal(int|string $id): void
    {
        if (!$this->isAdmin) {
            $this->error = 'Tidak diizinkan';
            return;
        }
        $loket = collect($this->rows)->firstWhere('id', $id);
        if ($loket) {
            $this->edit_id = $loket['id'];
            $this->nama_loket = $loket['nama_loket'] ?? '';
            $this->kode_prefix = $loket['kode_prefix'] ?? '';
            $this->deskripsi = $loket['deskripsi'] ?? '';
            $this->showEditModal = true;
            $this->openMenuId = null;
        }
    }

    public function update(): void
    {
        $this->error = null;
        if (!$this->isAdmin) {
            $this->error = 'Tidak diizinkan';
            return;
        }
        try {
            $id = (int) $this->edit_id;
            if ($id > 0) {
                $api = app(LoketApi::class);
                $api->update($id, [
                    'nama_loket' => $this->nama_loket,
                    'kode_prefix' => $this->kode_prefix,
                    'deskripsi' => $this->deskripsi ?: null,
                ]);
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
        $this->nama_loket = $this->kode_prefix = $this->deskripsi = '';
    }

    public function openDeleteModal(int|string $id): void
    {
        if (!$this->isAdmin) {
            $this->error = 'Tidak diizinkan';
            return;
        }
        $this->deleteId = $id;
        $this->showDeleteModal = true;
        $this->openMenuId = null;
    }

    public function delete(): void
    {
        $this->error = null;
        if (!$this->isAdmin) {
            $this->error = 'Tidak diizinkan';
            return;
        }
        try {
            if ($this->deleteId) {
                $api = app(LoketApi::class);
                $api->deleteLoket($this->deleteId);
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

    public function toggleMenu(int|string $id): void
    {
        $this->openMenuId = ($this->openMenuId === $id) ? null : $id;
    }

    public function closeMenu(): void
    {
        $this->openMenuId = null;
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
        return view('livewire.lokets.index');
    }
}
