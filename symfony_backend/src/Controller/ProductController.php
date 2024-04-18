<?php

namespace App\Controller;

use App\Service\ProductService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProductController extends AbstractFOSRestController
{
    #[Rest\Get('/products', name: 'product_list')]
    public function getProductsAction(ProductService $productService)
    {
        try {
            $products = $productService->getProducts();
        } catch (\RuntimeException $e) {
            return $this->view(['error' => $e->getMessage()], 500);
        }

        return $this->view($products, 200);
    }
}