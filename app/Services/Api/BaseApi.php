<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class BaseApi
{
    protected function client(): PendingRequest
    {
        return Http::baseUrl(config('api.base_url'))
            ->acceptJson()
            ->asJson()
            ->timeout((int) config('api.timeout', 5));
    }

    protected function withAuth(PendingRequest $client): PendingRequest
    {
        // If you later store JWT in session, attach here
        $token = session('access_token');
        if ($token) {
            $client = $client->withToken($token, 'Bearer');
        }
        return $client;
    }

    public function get(string $path, array $params = []): array
    {
        $client = $this->withAuth($this->client());
        $json = $client->get($path, $params)->throw()->json();
        return is_array($json) ? $json : [];
    }

    public function post(string $path, array $data = []): array
    {
        $client = $this->withAuth($this->client());
        $json = $client->post($path, $data)->throw()->json();
        return is_array($json) ? $json : [];
    }

    public function put(string $path, array $data = []): array
    {
        $client = $this->withAuth($this->client());
        $json = $client->put($path, $data)->throw()->json();
        return is_array($json) ? $json : [];
    }

    public function delete(string $path): array
    {
        $client = $this->withAuth($this->client());
        $response = $client->delete($path)->throw();
        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }
        // Handle empty/204 responses
        return ['status' => $response->status(), 'success' => $response->successful()];
    }
}
