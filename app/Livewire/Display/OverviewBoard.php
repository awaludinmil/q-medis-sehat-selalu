<?php

namespace App\Livewire\Display;

use Livewire\Component;
use App\Services\Api\DisplayApi;

class OverviewBoard extends Component
{
    public array $items = [];
    public ?string $error = null;

    public function mount(): void
    {
        $this->refresh();
    }

    public function refresh(): void
    {
        $this->error = null;
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
