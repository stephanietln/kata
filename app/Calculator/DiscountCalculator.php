<?php

namespace App\Calculator;

use App\Entity\Cart;

class DiscountCalculator
{
    protected static $discounts = [
        1 => 0,
        2 => 0.8,
        3 => 2.4,
        4 => 6.4,
        5 => 10
    ];

    /**
     * Calculate total of cart and apply discount if necessary
     *
     * @param Cart $cart
     *
     * @return void
     */
    public function calculate(Cart $cart): void
    {
        $products = $cart->getProducts();
        $total = $cart->getTotal();
        if (empty($products) || $total < 0) {
            return;
        }

        $groups = [];
        $groupKey = 0;
        foreach ($products as $key => $product) {
            $productQuantity = $product->getQuantity();
            $productSlug = $product->getSlug();

            for ($i = 1; $i <= $productQuantity; $i++) {
                if (!empty($groups[$groupKey])) {
                    if (in_array($productSlug, $groups[$groupKey]) || count($groups[$groupKey]) === 5) {
                        $groupKey++;
                    } elseif (!in_array($productSlug, $groups[$groupKey]) && $groupKey > 0) {
                        $groupKey--;
                    }
                }
                $groups[$groupKey][] = $product->getSlug();
            }
        }

        foreach ($groups as $group) {
            $discount = static::$discounts[count($group)] ?? 0;
            if (!empty($discount)) {
                $total -= round($discount, 2);
            }
        }

        $cart->setTotal($total);
    }
}
