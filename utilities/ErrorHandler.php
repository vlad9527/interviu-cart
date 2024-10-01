<?php

namespace Utilities;

class ErrorHandler
{
    /**
     * Handle errors for adding items to the cart.
     *
     * @param array $item
     * @return string|null
     */
    public static function validateItem(array $item): ?string
    {
        if (empty($item['product_id']) || $item['qty'] <= 0 || $item['price'] <= 0) {
            return "Invalid product data.";
        }

        return null;
    }

    /**
     * Handle generic error messages.
     *
     * @param string $message
     */
    public static function handleError(string $message): void
    {
        echo "<div style='color: red;'><strong>Error:</strong> $message</div>";
    }
}