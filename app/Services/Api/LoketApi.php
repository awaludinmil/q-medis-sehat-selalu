<?php

namespace App\Services\Api;

class LoketApi extends BaseApi
{
    public function list(array $params = []): array
    {
        return $this->get('/api/lokets', $params);
    }

    public function create(array $data): array
    {
        return $this->post('/api/lokets', $data);
    }

    public function getById(int|string $id): array
    {
        return $this->get("/api/lokets/{$id}");
    }

    public function update(int|string $id, array $data): array
    {
        return $this->put("/api/lokets/{$id}", $data);
    }

    public function delete(int|string $id): array
    {
        return $this->delete("/api/lokets/{$id}");
    }
}
