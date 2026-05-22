<?php

namespace App\Domain\Interfaces;

use App\Domain\DTOs\ProductData;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    /**
     * @return Collection<int, ProductData>
     */
    public function getAll(?string $search = null, ?string $category = null, ?string $sortPrice = null): Collection;

    /**
     * @return array<int, string>
     */
    public function getCategories(): array;

    public function getById(int $id): ProductData;

    public function create(array $data): ProductData;
}
