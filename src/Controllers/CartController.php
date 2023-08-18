<?php

namespace OnlineShop\Controllers;
use OnlineShop\Models\Cart;
use OnlineShop\Models\PayPal;

class CartController
{
    public function execute(): void
    {
        $user_id = $_SESSION['user_id'];

        $cart = new Cart();
        $cartItems = $cart->getUserCartItems($user_id);
        $totalAmount = $this->calculateTotal();
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
                // Add the product to the order as well
                $orderController = new OrderController();
                $orderController->addProductToOrder($size, $quantity, $product_id);

                $_SESSION['success_message'] = 'Product added to cart successfully.';
                header('location: ' . BASE_URL . 'product');
                exit();
            }
        }
    }

    public function calculateTotal()
    {
        $cartModel = new Cart();
        $userId = $_SESSION['user_id'];

        // Get cart items for the logged-in user
        $cartItems = $cartModel->getUserCartItems($userId);

        // Calculate the total cart amount
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->subtotal;
        }

        return $totalAmount;
    }

    public function removeCartItem()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cart_id'])) {
            $user_id = $_SESSION['user_id'];
            $cart_id = $_GET['cart_id'];

            $cart = new Cart();
            $result = $cart->removeCartItem($user_id, $cart_id);

            if ($result) {
                $_SESSION['success_message'] = 'Cart item removed successfully.';
            } else {
                $_SESSION['error_message'] = 'Failed to remove cart item.';
            }

            header('Location: ' . BASE_URL . 'cart');
            exit();
        }
    }

    public function showCheckoutPage(): void
    {
        $cartModel = new Cart();
        $userId = $_SESSION['user_id'];
        $cartItems = $cartModel->getUserCartItems($userId);
        require_once __DIR__ . '/../Views/Cart/checkout.php';
    }

    public function processCheckout()
    {
        // Validate form data here

        // Store form data in the session for further processing
        $_SESSION['checkout_data'] = $_POST;

        // Redirect to payment gateway based on selected payment method
        if ($_POST['payment_method'] === 'paypal') {
            $totalAmount = $this->calculateTotal();
            $paypal = new PayPal();
            $order = $paypal->createOrder($totalAmount);
            
            if (isset($order['links'][1]['href'])) {
                // Redirect user to PayPal payment page
                header('Location: ' . $order['links'][1]['href']);
                exit();
            } else {
                $_SESSION['error_message'] = 'Error creating PayPal order.';
                header('Location: ' . BASE_URL . 'cart/checkout');
                exit();
            }
        }
    }
}


?>


