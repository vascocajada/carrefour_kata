<?php

namespace App\Interface;

use App\Collection\ProductCollection;

interface ProductApiInterface
{
    public function fetchProducts(): ProductCollection;
}