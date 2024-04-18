<?php

namespace App\Service;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class CartService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getCart(): Cart
    {
        // TODO user authentication...
        // Get cart for the authenticated user
        $cart = $this->entityManager->getRepository(Cart::class)->findOneBy([], ['id' => 'DESC']);

        if (!$cart) {
            $user = new User();
            $user->setEmail('test@email.com');
            $user->setName('foo');

            $this->entityManager->persist($user);

            $cart = new Cart();
            $cart->setOwner($user);

            $this->entityManager->persist($cart);
            $this->entityManager->flush();
        }

        return $cart;
    }

    public function addProductToCart(Product $product, Cart $cart): void
    {
        $cartItem = new CartItem();
        $cartItem->setProduct($product);
        $cartItem->setCart($cart);

        $this->entityManager->persist($cartItem);
        $this->entityManager->flush();
    }
}

