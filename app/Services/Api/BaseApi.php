<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Services\Api\AuthApi;

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

    protected function requestWithAutoRefresh(callable $operation): array
    {
        try {
            return $operation();
        } catch (RequestException $e) {
            $response = $e->response;
            if ($response && $response->status() === 401) {
                $refresh = session('refresh_token');
                if ($refresh) {
                    try {
                        $auth = app(AuthApi::class);
                        $resp = $auth->refresh($refresh);
                        $data = is_array($resp) ? ($resp['data'] ?? $resp) : [];
                        $newAccess = $data['access_token'] ?? null;
                        if ($newAccess) {
                            session([
                                'access_token' => $newAccess,
                            ]);
                            return $operation();
                        }
                    } catch (\Throwable $te) {
                    }
                }
                session()->forget(['access_token', 'refresh_token']);
                throw new HttpResponseException(redirect()->route('auth.login'));
            }
            throw $e;
        }
    }

    public function get(string $path, array $params = []): array
    {
        return $this->requestWithAutoRefresh(function () use ($path, $params) {
            $client = $this->withAuth($this->client());
            $json = $client->get($path, $params)->throw()->json();
            return is_array($json) ? $json : [];
        });
    }

    public function post(string $path, array $data = []): array
    {
        return $this->requestWithAutoRefresh(function () use ($path, $data) {
            $client = $this->withAuth($this->client());
            $json = $client->post($path, $data)->throw()->json();
            return is_array($json) ? $json : [];
        });
    }

    public function put(string $path, array $data = []): array
    {
        return $this->requestWithAutoRefresh(function () use ($path, $data) {
            $client = $this->withAuth($this->client());
            $json = $client->put($path, $data)->throw()->json();
            return is_array($json) ? $json : [];
        });
    }

    public function delete(string $path): array
    {
        return $this->requestWithAutoRefresh(function () use ($path) {
            $client = $this->withAuth($this->client());
            $response = $client->delete($path)->throw();
            $json = $response->json();
            if (is_array($json)) {
                return $json;
            }
            return ['status' => $response->status(), 'success' => $response->successful()];
        });
    }

    /**
     * Public GET request without authentication (for public endpoints like display)
     */
    public function getPublic(string $path, array $params = []): array
    {
        try {
            $json = $this->client()->get($path, $params)->throw()->json();
            return is_array($json) ? $json : [];
        } catch (RequestException $e) {
            throw $e;
        }
    }
}

