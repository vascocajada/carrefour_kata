<?php

namespace App\Collection;

use App\DTO\ProductDTO;
use Countable;
use Iterator;

class ProductCollection implements Countable, Iterator
{
    private array $products;
    private int $position;

    public function __construct()
    {
        $this->position = 0;
    }

    public function current(): ProductDTO
    {
        return $this->products[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->products[$this->position]) && $this->products[$this->position] instanceof ProductDTO;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function toArray(): array
    {
        return array_map(function (ProductDTO $product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
            ];
        }, $this->products);
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function addProduct(ProductDTO $product): void
    {
        $this->products[] = $product;
    }

    public function count(): int
    {
        return count($this->products);
    }
}