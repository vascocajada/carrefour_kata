<?php

namespace App\Tests\Controller;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Product;

class ProductControllerTest extends ApiTestCase
{
    public function testItGetsProductsFromDatabase(): void
    {
        $entityManager = $this->getContainer()->get('doctrine')->getManager();

        $entityManager->createQuery('DELETE FROM App\Entity\Product')->execute();

        $product = new Product();
        $product->setName('Product 1');
        $product->setPrice(10);
        $product->setImage('product1.jpg');

        $entityManager->persist($product);
        $entityManager->flush();

        static::createClient()->request('GET', '/products');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([['name' => 'Product 1', 'price' => '10.00', 'image' => 'product1.jpg']]);
    }

    public function testItGetsProductsFromExternalApiIfDatabaseEmpty(): void
    {
        $entityManager = $this->getContainer()->get('doctrine')->getManager();

        // delete all products
        $entityManager->createQuery('DELETE FROM App\Entity\Product')->execute();

        static::createClient()->request('GET', '/products');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([['name' => 'Fjallraven - Foldsack No. 1 Backpack, Fits 15 Laptops']]);
    }
}
