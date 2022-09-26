<?php

namespace App\Service;

use App\Calculator\DiscountCalculator;
use App\Entity\Cart;

class OrderService
{
    /**
     * Process to the checkout of cart
     *
     * @param Cart $cart
     *
     * @return void
     */
    public function checkout(Cart $cart): void
    {
        $total = array_reduce($cart->getProducts(), function($total, $product) {
            return $total + $product->getPrice();
        });
        $cart->setTotal($total ?? 0);

        $discountCalultator = new DiscountCalculator();
        $discountCalultator->calculate($cart);
    }
}
