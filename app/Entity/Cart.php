<?php

namespace App\Entity;

class Cart
{
    /** @var array */
    public $products = [];

    /** @var float */
    public $total = 0;

    public function addProducts(array $books)
    {
        $products = [];
        $books = array_count_values($books);
        if (!empty($books)) {
            foreach ($books as $key => $qty) {
                $product = new Product();
                $product->setSlug('PRODUCT-' . $key);
                $product->setPrice(Product::PRICE * $qty);
                $product->setQuantity($qty);

                $products[] = $product;
            }
        }

        $this->setProducts($products);
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): void
    {
        $this->total = round($total, 2);
    }
}
