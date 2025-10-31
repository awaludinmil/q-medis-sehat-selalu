<?php

namespace App\Livewire\Display;

use Livewire\Component;
use App\Services\Api\DisplayApi;
use App\Services\Api\AntrianApi;

class Kiosk extends Component
{
    public array $lokets = [];
    public int|string $selected = '';

    public ?array $ticket = null;
    public ?string $error = null;
    public bool $loading = false;
    public ?string $successMessage = null;

    public function mount(): void
    {
        $this->refreshLokets();
    }

    public function refreshLokets(): void
    {
        $this->error = null;
        try {
            $api = app(DisplayApi::class);
            $resp = $api->lokets();
            $data = $resp['data'] ?? $resp['items'] ?? $resp;
            if (isset($data['data']) && is_array($data['data'])) {
                $data = $data['data'];
            }
            $this->lokets = is_array($data) ? array_values($data) : [];
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
            $this->lokets = [];
        }
    }

    public function select(int|string $id): void
    {
        $this->selected = $id;
        $this->successMessage = null;
        $this->ticket = null;
    }

    public function ambilNomor(): void
    {
        $this->error = null;
        $this->successMessage = null;
        $this->ticket = null;
        try {
            $id = (int) $this->selected;
            if ($id <= 0) {
                $this->error = 'Silakan pilih loket terlebih dahulu.';
                return;
            }
            $this->loading = true;
            $api = app(AntrianApi::class);
            $resp = $api->create(['loket_id' => $id]);
            $data = $resp['data'] ?? $resp['ticket'] ?? $resp;
            if (is_array($data)) {
                $this->ticket = $data;
                $number = data_get($data, 'queue_number') ?? data_get($data, 'number') ?? data_get($data, 'no') ?? data_get($data, 'code');
                if ($number) {
                    $this->successMessage = 'Nomor antrian Anda: ' . $number;
                } else {
                    $this->successMessage = 'Nomor antrian berhasil dibuat.';
                }
            }
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        } finally {
            $this->loading = false;
        }
    }

    public function render()
    {
        return view('livewire.display.kiosk');
    }
}
