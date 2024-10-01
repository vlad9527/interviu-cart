<?php

namespace Controllers;

use Models\CartModel;
use Utilities\ErrorHandler;

class CartController
{
    private CartModel $cartModel;
    private float $shippingCost;
    private float $freeShippingThreshold;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $config = require dirname(__DIR__) . '/configs/config.php';

        $this->shippingCost = $config['shippingCost'];
        $this->freeShippingThreshold = $config['freeShippingThreshold'];
    }

    /**
     * Add an item to the cart and calculate totals.
     *
     * @param int $product_id
     * @param int $qty
     * @param float $price
     */
    public function addItemToCart(int $product_id, int $qty, float $price): void
    {
        $item = ['product_id' => $product_id, 'qty' => $qty, 'price' => $price];

        $errorMessage = ErrorHandler::validateItem($item);
        if ($errorMessage) {
            ErrorHandler::handleError($errorMessage);
            return;
        }
        $this->cartModel->addItem($item);
    }

    /**
     * Get the total value of the cart.
     *
     * @return float
     */
    public function getCartTotal(): float
    {
        $items = $this->cartModel->getItems();

        return array_reduce($items, function ($totalValue, $item) {
            return $totalValue + ($item['price'] * $item['qty']);
        }, 0);
    }

    /**
     * Calculate the shipping cost based on the total value of the cart.
     *
     * @return float
     */
    public function getShippingCost(): float
    {
        $totalValue = $this->getCartTotal();
        return ($totalValue > $this->freeShippingThreshold) ? 0 : $this->shippingCost;
    }

    /**
     * Display the cart's total value and shipping cost.
     */
    public function displayCart(): void
    {
        $totalValue = $this->getCartTotal();
        $shippingCost = $this->getShippingCost();
        $items = $this->cartModel->getItems();

        $this->renderView('cart', [
            'totalValue' => $totalValue,
            'shippingCost' => $shippingCost,
            'items' => $items,
            'grandTotal' => $totalValue + $shippingCost,
        ]);
    }

    /**
     * Extract data and send it to view.
     */
    private function renderView(string $view, array $data): void
    {
        extract($data);
        require_once dirname(__DIR__) . "/views/{$view}.php";
    }

    /**
     * Remove an item from the cart.
     *
     * @param int $product_id
     */
    public function removeItemFromCart(int $product_id): void
    {
        $this->cartModel->removeItem($product_id);
    }
}