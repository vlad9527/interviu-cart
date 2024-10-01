<?php

namespace Models;

class CartModel
{
    private array $items = [];

    /**
     * Add an item to the cart without doing any business logic.
     *
     * @param array $item
     */
    public function addItem(array $item): void
    {
        if (isset($this->items[$item['product_id']])) {
            $this->items[$item['product_id']]['qty'] += $item['qty'];
        } else {
            $this->items[$item['product_id']] = $item;
        }
    }

    /**
     * Get all items in the cart.
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Remove an item from the cart.
     *
     * @param int $product_id
     */
    public function removeItem(int $product_id): void
    {
        if (isset($this->items[$product_id])) {
            unset($this->items[$product_id]);
        }
    }
}