<?php

namespace App\Service;

use App\Entity\Product;
use App\Interface\ProductApiInterface;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository,
        private ProductApiInterface $productApi,
    ) {
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        $products = $this->productRepository->findAll();

        // TODO this should be done in a scheduled job or cron
        // We should have some sync job too
        // Caching the data is also a good idea
        if (empty($products)) {
            $products = $this->fetchProductsFromExternalApi();
        }

        return $products;
    }

    public function fetchProductsFromExternalApi(): array
    {
        $productCollection = $this->productApi->fetchProducts();
        $products = [];

        // TODO create mapper service to map DTO to Entity
        // Implement some sort of queue to handle large amount of data
        foreach ($productCollection as $productDTO) {
            $product = new Product();
            $product->setName($productDTO->name);
            $product->setPrice($productDTO->price);
            $product->setImage($productDTO->image);

            $this->productRepository->save($product);

            $products[] = $product;
        }

        $this->productRepository->flush();

        return $products;
    }
}