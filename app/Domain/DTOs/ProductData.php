<?php

namespace App\Domain\DTOs;

use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly float $price,
        public readonly string $description,
        public readonly string $category,
        public readonly string $image,
        public readonly ?ProductRatingData $rating = null,
    ) {}
}
