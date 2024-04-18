<?php

namespace App\Tests\Service;

use App\Collection\ProductCollection;
use App\DTO\ProductDTO;
use App\Service\ProductApi;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class ProductApiTest extends TestCase
{
    public function testItFetchesProductsCorrectly(): void
    {
        $clientMock = $this->createMock(HttpClientInterface::class);

        $productApi = new ProductApi($clientMock);

        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('toArray')
            ->willReturn([
                ['id' => 1, 'title' => 'Product 1', 'price' => 10, 'image' => 'product1.jpg'],
                ['id' => 2, 'title' => 'Product 2', 'price' => 20, 'image' => 'product2.jpg'],
                ['id' => 3, 'title' => 'Product 3', 'price' => 30, 'image' => 'product3.jpg'],
            ]);
        $responseMock->method('getStatusCode')
            ->willReturn(200);

        $clientMock->expects($this->once())
            ->method('request')
            ->with('GET', 'https://fakestoreapi.com/products')
            ->willReturn($responseMock);

        $productCollection = $productApi->fetchProducts();

        $this->assertSame(ProductCollection::class, $productCollection::class);
        $this->assertSame(ProductDTO::class, $productCollection->current()::class);
        $this->assertCount(3, $productCollection);
    }

    public function testItFailsToFetchProducts(): void
    {
        $clientMock = $this->createMock(HttpClientInterface::class);

        $productApi = new ProductApi($clientMock);

        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('getStatusCode')
            ->willReturn(500);

        $clientMock->expects($this->once())
            ->method('request')
            ->with('GET', 'https://fakestoreapi.com/products')
            ->willReturn($responseMock);

        $this->expectException(\RuntimeException::class);
        $productApi->fetchProducts();
    }
}