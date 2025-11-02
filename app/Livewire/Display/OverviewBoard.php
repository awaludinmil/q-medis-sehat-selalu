<?php

namespace App\Livewire\Display;

use Livewire\Component;
use App\Services\Api\DisplayApi;

class OverviewBoard extends Component
{
    public array $items = [];
    public ?string $error = null;
    public string $currentTime = '';
    public string $currentDate = '';

    public function mount(): void
    {
        $this->refresh();
    }

    public function refresh(): void
    {
        $this->error = null;
        $this->currentTime = now()->format('H:i:s');
        $this->currentDate = now()->format('d M Y');
        
        try {
            $api = app(DisplayApi::class);
            $resp = $api->overview();
            $items = $resp['data'] ?? $resp;
            if (!is_array($items)) {
                $items = [];
            }
            $this->items = array_values($items);
        } catch (\Throwable $e) {
            $this->error = $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.display.overview-board');
    }
}
