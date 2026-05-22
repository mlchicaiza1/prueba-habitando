<?php

namespace App\Infrastructure\Repositories;

use App\Domain\DTOs\ProductData;
use App\Domain\DTOs\ProductRatingData;
use App\Domain\Interfaces\ProductRepositoryInterface;
use App\Infrastructure\ApiClients\FakeStoreApiClient;
use Illuminate\Support\Collection;

class ApiProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private readonly FakeStoreApiClient $apiClient
    ) {}

    public function getAll(?string $search = null, ?string $category = null, ?string $sortPrice = null): Collection
    {
        $data = $this->apiClient->get('/products');
        
        $collection = collect($data)->map(function ($item) {
            return $this->mapToDto($item);
        });

        if ($category) {
            $collection = $collection->where('category', $category);
        }

        if ($search) {
            $search = strtolower($search);
            $collection = $collection->filter(function (ProductData $product) use ($search) {
                return str_contains(strtolower($product->title), $search) || 
                       str_contains(strtolower($product->description), $search);
            });
        }

        if ($sortPrice === 'asc') {
            $collection = $collection->sortBy('price');
        } elseif ($sortPrice === 'desc') {
            $collection = $collection->sortByDesc('price');
        }

        return $collection->values();
    }

    public function getCategories(): array
    {
        $data = $this->apiClient->get('/products/categories');
        
        return $data;
    }

    public function getById(int $id): ProductData
    {
        $data = $this->apiClient->get("/products/{$id}");
        
        return $this->mapToDto($data);
    }

    public function create(array $data): ProductData
    {
        $response = $this->apiClient->post('/products', $data);
        
        return $this->mapToDto($response);
    }

    private function mapToDto(array $data): ProductData
    {
        $rating = null;
        if (isset($data['rating'])) {
            $rating = new ProductRatingData(
                rate: (float) ($data['rating']['rate'] ?? 0),
                count: (int) ($data['rating']['count'] ?? 0)
            );
        }

        return new ProductData(
            id: (int) ($data['id'] ?? 0),
            title: $data['title'] ?? '',
            price: (float) ($data['price'] ?? 0),
            description: $data['description'] ?? '',
            category: $data['category'] ?? '',
            image: $data['image'] ?? '',
            rating: $rating
        );
    }
}
