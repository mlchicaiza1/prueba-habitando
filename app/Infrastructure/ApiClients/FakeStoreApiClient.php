<?php

namespace App\Infrastructure\ApiClients;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Exception;

class FakeStoreApiClient
{
    private string $baseUrl = 'https://fakestoreapi.com';

    public function get(string $endpoint, array $params = []): array
    {
        $cacheKey = 'fakestore_' . $endpoint . '_' . md5(serialize($params));
        $cacheTtl = $this->getCacheTtl($endpoint);

        return Cache::remember($cacheKey, $cacheTtl, function () use ($endpoint, $params) {
            $response = Http::timeout(10)
                ->retry(3, 100)
                ->get($this->baseUrl . $endpoint, $params);

            if ($response->failed()) {
                throw new Exception("FakeStore API request failed: {$response->status()}", $response->status());
            }

            return $response->json();
        });
    }

    public function post(string $endpoint, array $data = []): array
    {
        // No cache for POST requests
        $response = Http::timeout(10)
            ->retry(3, 100)
            ->post($this->baseUrl . $endpoint, $data);

        if ($response->failed()) {
            throw new Exception("FakeStore API POST failed: {$response->status()}", $response->status());
        }

        return $response->json();
    }

    private function getCacheTtl(string $endpoint): int
    {
        // If getting a list, cache for 5 min (300 seconds), if a single item, cache for 1 hour (3600)
        return preg_match('/\/[0-9]+$/', $endpoint) ? 3600 : 300;
    }
}
