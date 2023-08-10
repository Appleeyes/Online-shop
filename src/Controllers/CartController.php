<?php

namespace OnlineShop\Controllers;
use OnlineShop\Models\Cart;

class CartController
{
    public function execute(): void
    {
        $user_id = $_SESSION['user_id'];

        $cart = new Cart();
        $cartItems = $cart->getUserCartItems($user_id);
        
        require_once __DIR__ . '/../Views/Cart/cart.php';
    }

    public function addProductToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'];
            $product_id = $_POST['product_id'];
            $size = $_POST['size'];
            $quantity = $_POST['quantity'];

            $cart = new Cart();
            $result = $cart->addProduct($user_id, $product_id, $size, $quantity);

            if ($result) {
                $_SESSION['success_message'] = 'Product added to cart successfully.';
                header('location: ' . BASE_URL . 'product');
                exit();
            }
        }
    }
}


?>