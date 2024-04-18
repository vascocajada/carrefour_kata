<?php

namespace App\Service;

use App\Collection\ProductCollection;
use App\DTO\ProductDTO;
use App\Interface\ProductApiInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductApi implements ProductApiInterface
{
    const API_URL = 'https://fakestoreapi.com/products';

    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    public function fetchProducts(): ProductCollection
    {
        $response = $this->client->request('GET', self::API_URL);

        if (200 !== $response->getStatusCode()) {
            throw new \RuntimeException('Failed to fetch products');
        }

        $content = $response->toArray();

        $productCollection = new ProductCollection();

        foreach ($content as $product) {
            $productCollection->addProduct(new ProductDTO(
                id: $product['id'],
                name: $product['title'],
                price: $product['price'],
                // TODO store images on our server for better performance
                image: $product['image'],
            ));
        }

        return $productCollection;
    }
}