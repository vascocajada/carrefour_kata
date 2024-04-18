<?php

namespace App\DTO;

class ProductDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $price,
        public readonly string $image,
    ) {
    }
}