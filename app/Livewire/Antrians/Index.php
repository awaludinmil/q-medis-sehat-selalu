<?php

namespace App\Livewire\Antrians;

use Livewire\Component;
use App\Services\Api\AntrianApi;
use App\Services\Api\AuthApi;
class Index extends Component
{
    public array $rows = [];
    public int $page = 1;
    public int $per_page = 10;
    public string $search = '';
    public string $order_by = 'id';
    public string $order_dir = 'desc';
    public ?string $error = null;

    public ?array $user = null;
    public bool $canUpdate = false;

    // Create form
    public $loket_id = '';

    // Update form
    public $update_id = '';
    public string $status = '';

    // Modal states
    public bool $showEditModal = false;

    public function mount(): void
    {
        // determine role and permissions
        if (session('access_token')) {
            try {
                $resp = app(AuthApi::class)->me();
                $this->user = $resp['data'] ?? null;
                $role = (string) ($this->user['role'] ?? '');
                $this->canUpdate = in_array($role, ['admin','petugas'], true);
            } catch (\Throwable $e) {
                $this->user = null;
                $this->canUpdate = false;
            }
        }
        $this->refresh();
    }

    public function refresh(): void
    {
        $this->error = null;
        try {
            $api = app(AntrianApi::class);
            $resp = $api->list([
                'page' => $this->page,
                'per_page' => $this->per_page,
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
            $api = app(AntrianApi::class);
            $api->createPublic([
                'loket_id' => (int) $this->loket_id,
            ]);
            $this->loket_id = '';
            $this->refresh();
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function openEditModal($id): void
    {
        if (! $this->canUpdate) {
            return;
        }
        $antrian = collect($this->rows)->firstWhere('id', $id);
        if ($antrian) {
            $this->update_id = $antrian['id'];
            $this->status = $antrian['status'] ?? 'menunggu';
            $this->showEditModal = true;
        }
    }

    public function updateStatus(): void
    {
        $this->error = null;
        try {
            if (! $this->canUpdate) {
                $this->error = 'Tidak diizinkan';
                return;
            }
            $id = (int) $this->update_id;
            if ($id > 0 && $this->status !== '') {
                $api = app(AntrianApi::class);
                $api->update($id, ['status' => $this->status]);
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
        $this->update_id = '';
        $this->status = '';
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
        return view('livewire.antrians.index');
    }
}
