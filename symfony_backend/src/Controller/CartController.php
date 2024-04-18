<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Product;
use App\Entity\User;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class CartController extends AbstractFOSRestController
{
    #[Rest\Get('/cart', name: 'cart')]
    public function getCartAction(CartService $cartService)
    {
        $cart = $cartService->getCart();

        return $this->view($cart, 200);
    }

    #[Rest\Post('/cart-item/{id}', name: 'cart_item_add')]
    public function postCartAction(Product $product, CartService $cartService)
    {
        $cart = $cartService->getCart();
        $cartService->addProductToCart($product, $cart);

        return $this->view($cart, 201);
    }
}