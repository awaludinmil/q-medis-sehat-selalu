<?php

namespace App\Services\Api;

class DisplayApi extends BaseApi
{
    public function overview(): array
    {
        return $this->get('/api/display/overview');
    }

    public function lokets(): array
    {
        return $this->get('/api/display/lokets');
    }

    public function loket(int|string $id): array
    {
        return $this->get("/api/display/lokets/{$id}");
    }
}
