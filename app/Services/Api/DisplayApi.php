<?php

namespace App\Services\Api;

class DisplayApi extends BaseApi
{
    /**
     * Get overview of all lokets with queue data (public endpoint)
     */
    public function overview(): array
    {
        return $this->getPublic('/api/display/overview');
    }

    /**
     * Get list of all lokets (public endpoint)
     */
    public function lokets(): array
    {
        return $this->getPublic('/api/display/lokets');
    }

    /**
     * Get display data for specific loket (public endpoint)
     */
    public function loket(int|string $id): array
    {
        return $this->getPublic("/api/display/lokets/{$id}");
    }
}
