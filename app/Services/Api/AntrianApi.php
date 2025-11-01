<?php

namespace App\Services\Api;

class AntrianApi extends BaseApi
{
    public function list(array $params = []): array
    {
        return $this->get('/api/antrians', $params);
    }

    public function create(array $data): array
    {
        return $this->post('/api/antrians', $data);
    }

    public function getById(int|string $id): array
    {
        return $this->get("/api/antrians/{$id}");
    }

    public function update(int|string $id, array $data): array
    {
        return $this->put("/api/antrians/{$id}", $data);
    }

    public function createPublic(array $data): array
    {
        $json = $this->client()->post('/api/display/antrians', $data)->throw()->json();
        return is_array($json) ? $json : [];
    }
}
