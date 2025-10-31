<?php

namespace App\Services\Api;

class UserApi extends BaseApi
{
    public function list(array $params = []): array
    {
        return $this->get('/api/users', $params);
    }

    public function create(array $data): array
    {
        return $this->post('/api/users', $data);
    }

    public function getById(int|string $id): array
    {
        return $this->get("/api/users/{$id}");
    }

    public function update(int|string $id, array $data): array
    {
        return $this->put("/api/users/{$id}", $data);
    }

    public function delete(int|string $id): array
    {
        return $this->delete("/api/users/{$id}");
    }
}
