<?php

namespace App\Livewire\Lokets;

use Livewire\Component;
use App\Services\Api\LoketApi;

class Index extends Component
{
    public array $rows = [];
    public int $page = 1;
    public int $per_page = 10;
    public string $search = '';
    public string $order_by = 'id';
    public string $order_dir = 'asc';
    public ?string $error = null;

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
            $api = app(LoketApi::class);
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
        $loket = collect($this->rows)->firstWhere('id', $id);
        if ($loket) {
            $this->edit_id = $loket['id'];
            $this->nama_loket = $loket['nama_loket'] ?? '';
            $this->kode_prefix = $loket['kode_prefix'] ?? '';
            $this->deskripsi = $loket['deskripsi'] ?? '';
            $this->showEditModal = true;
        }
    }

    public function update(): void
    {
        $this->error = null;
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
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->error = null;
        try {
            if ($this->deleteId) {
                $api = app(LoketApi::class);
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
        return view('livewire.lokets.index');
    }
}
