<?php

namespace App\Application\UseCases;

use App\Domain\DTOs\ProductData;
use App\Domain\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductUseCase
{
    public function __construct(
        private readonly ProductRepositoryInterface $repository
    ) {}

    /**
     * @return Collection<int, ProductData>
     */
    public function getAll(?string $search = null, ?string $category = null, ?string $sortPrice = null): Collection
    {
        return $this->repository->getAll($search, $category, $sortPrice);
    }

    public function getCategories(): array
    {
        return $this->repository->getCategories();
    }

    public function getById(int $id): ProductData
    {
        return $this->repository->getById($id);
    }

    public function create(array $data): ProductData
    {
        return $this->repository->create($data);
    }
}
