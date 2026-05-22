<?php

namespace App\Domain\DTOs;

use Spatie\LaravelData\Data;

class ProductRatingData extends Data
{
    public function __construct(
        public readonly float $rate,
        public readonly int $count,
    ) {}
}
