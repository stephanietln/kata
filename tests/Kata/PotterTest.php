<?php

use App\Entity\Cart;
use App\Service\OrderService;
use PHPUnit\Framework\TestCase;

class PotterTest extends TestCase
{
    /**
     * @return array
     */
    public function getBasicsDiscounts(): array
    {
        return [
            [0, []],
            [8, [1]],
            [8, [2]],
            [8, [3]],
            [8, [4]],
            [8 * 3, [1, 1, 1]]
        ];
    }

    /**
     * @return array
     */
    public function getSimpleDiscounts(): array
    {
        return [
            [8 * 2 * 0.95, [0, 1]],
            [8 * 3 * 0.9, [0, 2, 4]],
            [8 * 4 * 0.8, [0, 1, 2, 4]],
            [8 * 5 * 0.75, [0, 1, 2, 3, 4]]
        ];
    }

    /**
     * @return array
     */
    public function getSeveralDiscounts(): array
    {
        return [
            [8 + (8 * 2 * 0.95), [0, 0, 1]],
            [2 * (8 * 2 * 0.95), [0, 0, 1, 1]],
            [(8 * 4 * 0.8) + (8 * 2 * 0.95), [0, 0, 1, 2, 2, 3]],
            [8 + (8 * 5 * 0.75), [0, 1, 1, 2, 3, 4]]
        ];
    }

    /**
     * @return array
     */
    public function getEdgeDiscounts(): array
    {
        return [
            [8 + (8 * 2 * 0.95), [0, 0, 1]],
            [2 * (8 * 2 * 0.95), [0, 0, 1, 1]],
            [(8 * 4 * 0.8) + (8 * 2 * 0.95), [0, 0, 1, 2, 2, 3]],
            [8 + (8 * 5 * 0.75), [0, 1, 1, 2, 3, 4]]
        ];
    }

    /**
     * @dataProvider getBasicsDiscounts
     */
    public function testBasicsDiscounts(float $total, array $products): void
    {
        $cart = new Cart();
        $cart->addProducts($products);

        $orderService = new OrderService();
        $orderService->checkout($cart);

        $this->assertEquals($total, $cart->getTotal());
    }

    /**
     * @dataProvider getSimpleDiscounts
     */
    public function testSimpleDiscounts(float $total, array $products): void
    {
        $cart = new Cart();
        $cart->addProducts($products);

        $orderService = new OrderService();
        $orderService->checkout($cart);

        $this->assertEquals($total, $cart->getTotal());
    }

    /**
     * @dataProvider getSeveralDiscounts
     */
    public function testSeveralDiscounts(float $total, array $products): void
    {
        $cart = new Cart();
        $cart->addProducts($products);

        $orderService = new OrderService();
        $orderService->checkout($cart);

        $this->assertEquals($total, $cart->getTotal());
    }

    /**
     * @dataProvider getEdgeDiscounts
     */
    public function testEdgeDiscounts(float $total, array $products): void
    {
        $cart = new Cart();
        $cart->addProducts($products);

        $orderService = new OrderService();
        $orderService->checkout($cart);

        $this->assertEquals($total, $cart->getTotal());
    }
}
