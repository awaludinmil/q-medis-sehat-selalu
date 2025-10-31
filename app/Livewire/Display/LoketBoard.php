<?php

namespace App\Livewire\Display;

use Livewire\Component;
use App\Services\Api\DisplayApi;

class LoketBoard extends Component
{
    public int|string $loketId;

    public ?array $loket = null;
    public ?array $current = null;
    public array $next = [];
    public ?string $error = null;

    public function mount(int|string $loketId): void
    {
        $this->loketId = $loketId;
        $this->refresh();
    }

    public function refresh(): void
    {
        $this->error = null;
        try {
            $api = app(DisplayApi::class);
            $resp = $api->loket($this->loketId);
            $data = $resp['data'] ?? $resp;
            if (is_array($data)) {
                $this->loket = $data['loket'] ?? null;
                $this->current = $data['current'] ?? null;
                $this->next = $data['next'] ?? [];
            }
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.display.loket-board');
    }
}
