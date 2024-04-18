<?php

namespace App\Tests\Service;

use App\Entity\Product;
use App\Interface\ProductApiInterface;
use App\Repository\ProductRepository;
use App\Service\ProductService;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    public function testItGetsProductsFromDatabase(): void
    {
        $productRepositoryMock = $this->createMock(ProductRepository::class);
        $productRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn([new Product()]);

        $productApiMock = $this->createMock(ProductApiInterface::class);

        $productService = new ProductService($productRepositoryMock, $productApiMock);
        $products = $productService->getProducts();

        $this->assertIsArray($products);
        $this->assertNotEmpty($products);
    }

    public function testItFetchesProductsFromApiIfDatabaseEmpty(): void
    {
        $productRepositoryMock = $this->createMock(ProductRepository::class);
        $productRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn([]);

        $productApiMock = $this->createMock(ProductApiInterface::class);
        $productApiMock->expects($this->once())
            ->method('fetchProducts');

        $productService = new ProductService($productRepositoryMock, $productApiMock);
        $products = $productService->getProducts();

        $this->assertIsArray($products);
        $this->assertEmpty($products);
    }
}