<?php

namespace OnlineShop\Controllers;
use OnlineShop\Models\Cart;
use OnlineShop\Models\PayPal;

class CartController
{
    /**
     * @execute: show cart page
     * @getUserCartItems: get users cart items from database
     * calculateTotal: calculate total amount
     * return: void
     */
    public function execute(): void
    {
        $user_id = $_SESSION['user_id'];

        $cart = new Cart();
        $cartItems = $cart->getUserCartItems($user_id);
        $totalAmount = $this->calculateTotal();
        require_once __DIR__ . '/../Views/Cart/cart.php';
    }

    /**
     * @addProductToCart: add product to cart in database
     * @addProduct: add product method
     * addProductToOrder: add product to order table
     */
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
                $orderController = new OrderController();
                $orderController->addProductToOrder($size, $quantity, $product_id, $user_id);

                $_SESSION['success_message'] = 'Product added to cart successfully.';
                header('location: ' . BASE_URL . 'product');
                exit();
            }
        }
    }

    /**
     * @calculateTotal: calculate total amount
     * @getUserCartItems: get cart items from database
     */
    public function calculateTotal()
    {
        $cartModel = new Cart();
        $userId = $_SESSION['user_id'];

        $cartItems = $cartModel->getUserCartItems($userId);

        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->subtotal;
        }

        return $totalAmount;
    }

    /**
     * @removeCartItem: remove items from cart
     * @removeCartItem: remover items mtehod
     */
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

    /**
     * @showCheckoutPage: show checkout page
     * @getUserCartItems: get user cart items to checkout
     * return: void
     */
    public function showCheckoutPage(): void
    {
        $cartModel = new Cart();
        $userId = $_SESSION['user_id'];
        $cartItems = $cartModel->getUserCartItems($userId);
        require_once __DIR__ . '/../Views/Cart/checkout.php';
    }

    /**
     * @processCheckout: process checkout
     * @calculateTotal: calculate total method
     * @createOrder: create order for paypal
     */
    public function processCheckout()
    {
        
        $_SESSION['checkout_data'] = $_POST;

        if ($_POST['payment_method'] === 'paypal') {
            $totalAmount = $this->calculateTotal();
            $returnUrl = 'http://localhost:3000/Online-shop/cart/success';

            $paypal = new PayPal();
            $order = $paypal->createOrder($totalAmount, $returnUrl, 'USD');
            if (isset($order['id'])) {
                $_SESSION['paypal_order_id'] = $order['id'];

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


