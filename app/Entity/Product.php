<?php

namespace App\Entity;

class Product
{
    const PRICE = 8.00;

    /** @var string */
    public $slug;

    /** @var float */
    public $price = 0;

    /** @var int */
    public $quantity = 0;

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}
