<?php

require_once 'models/CartModel.php';
require_once 'controllers/CartController.php';
require_once 'utilities/ErrorHandler.php';

use Controllers\CartController;

$cartController = new CartController();

$cartController->addItemToCart(1, 1, 5);
$cartController->addItemToCart(5, 3, 10);
$cartController->addItemToCart(1, 2, 5);

$cartController->displayCart();