<?php

namespace App\Livewire\Lokets;

use Livewire\Component;
use App\Services\Api\LoketApi;
use App\Services\Api\AntrianApi;
use App\Services\Api\AuthApi;

class Show extends Component
{
    public $loketId;
    public ?array $loket = null;
    public array $antrians = [];
    public ?string $error = null;
    public ?array $user = null;
    public bool $canUpdate = false;

    // Pagination & Filter
    public int $page = 1;
    public int $perPage = 50;
    public string $search = '';
    public int $total = 0;
    public int $lastPage = 1;

    public function mount($id): void
    {
        $this->loketId = $id;
        
        // Check user role
        if (session('access_token')) {
            try {
                $response = app(AuthApi::class)->me();
                $this->user = $response['data'] ?? null;
                $role = (string) ($this->user['role'] ?? '');
                $this->canUpdate = in_array($role, ['admin', 'petugas'], true);
            } catch (\Throwable $e) {
                $this->user = null;
                $this->canUpdate = false;
            }
        }
        
        $this->loadLoket();
        $this->loadAntrians();
    }

    public function loadLoket(): void
    {
        $this->error = null;
        try {
            $api = app(LoketApi::class);
            $resp = $api->getById($this->loketId);
            $this->loket = $resp['data'] ?? null;
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
            $this->loket = null;
        }
    }

    public function loadAntrians(): void
    {
        try {
            $api = app(AntrianApi::class);
            $params = [
                'loket_id' => $this->loketId,
                'page' => $this->page,
                'per_page' => $this->perPage,
            ];
            
            if ($this->search !== '') {
                $params['search'] = $this->search;
            }
            
            $resp = $api->list($params);
            $data = $resp['data'] ?? $resp['items'] ?? $resp;
            
            // Handle pagination
            if (isset($resp['data']['pagination'])) {
                $pagination = $resp['data']['pagination'];
                $this->total = $pagination['total'] ?? 0;
                $this->lastPage = $pagination['last_page'] ?? 1;
                $this->antrians = is_array($resp['data']['data']) ? array_values($resp['data']['data']) : [];
            } elseif (isset($data['data']) && is_array($data['data'])) {
                $this->antrians = array_values($data['data']);
                $this->total = count($this->antrians);
                $this->lastPage = 1;
            } else {
                $this->antrians = is_array($data) ? array_values($data) : [];
                $this->total = count($this->antrians);
                $this->lastPage = 1;
            }
        } catch (\Throwable $e) {
            $this->antrians = [];
            $this->total = 0;
            $this->lastPage = 1;
        }
    }
    
    public function updatingSearch(): void
    {
        $this->page = 1;
    }
    
    
    
    public function updatingPerPage(): void
    {
        $this->page = 1;
    }
    
    public function goToPage($pageNumber): void
    {
        $this->page = max(1, min((int)$pageNumber, $this->lastPage));
        $this->loadAntrians();
    }
    
    public function nextPage(): void
    {
        if ($this->page < $this->lastPage) {
            $this->page++;
            $this->loadAntrians();
        }
    }
    
    public function previousPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
            $this->loadAntrians();
        }
    }
    
    public function firstPage(): void
    {
        $this->page = 1;
        $this->loadAntrians();
    }
    
    public function lastPageAction(): void
    {
        $this->page = $this->lastPage;
        $this->loadAntrians();
    }

    public function callAntrian($id): void
    {
        if (!$this->canUpdate) {
            $this->error = 'Tidak diizinkan';
            return;
        }

        $this->error = null;
        try {
            $api = app(AntrianApi::class);
            $api->update($id, ['status' => 'dipanggil']);
            $this->loadAntrians();
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function finishAntrian($id): void
    {
        if (!$this->canUpdate) {
            $this->error = 'Tidak diizinkan';
            return;
        }

        $this->error = null;
        try {
            $api = app(AntrianApi::class);
            $api->update($id, ['status' => 'selesai']);
            $this->loadAntrians();
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function refresh(): void
    {
        $this->loadLoket();
        $this->loadAntrians();
    }

    public function render()
    {
        return view('livewire.lokets.show');
    }
}
