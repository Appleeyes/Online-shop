<?php 

namespace OnlineShop\Controllers;
use OnlineShop\Models\Order;
use OnlineShop\Models\Product;
use OnlineShop\Models\Cart;

ini_set('display_errors', 1);
error_reporting(E_ALL);


class OrderController
{
    public function addProductToOrder($size, $quantity, $product_id, $user_id)
    {
        $productModel = new Product;
        $productDetails = $productModel->fetchProductById($product_id);
        if (!$productDetails) {
            return false;
        }

        $productPrice = $productDetails->price;
        $subtotal = $productPrice * $quantity;

        $order = new Order();
        $result = $order->addOrder($size, $quantity, $subtotal, $product_id, $user_id);

        if ($result) {
            return true;
        }
        return false;
    }

    public function showSuccessPage()
    {
        $user_id = $_SESSION['user_id'];
        $cartModel = new Cart();
        $productIds = $cartModel->getUserCartProductIds($user_id);
        require_once __DIR__ . '/../Views/Cart/successPage.php';
    }

    public function showConfirmPage()
    {  
        require_once __DIR__ . '/../Views/Cart/confirmOrder.php';
    }


    public function confirmPaid()
    {
        $user_id = $_SESSION['user_id'];
        $productIds = $_POST['productIds']; // Retrieve product IDs from form submission
        $orderModel = new Order();

        foreach ($productIds as $product_id) {
            $orderModel->markOrderAsPaid($user_id, $product_id);
        }

        $cartModel = new Cart();
        $cartModel->clearUserCart($user_id);

        // Redirect to the confirmation page
        $_SESSION['success_message'] = 'Order Confirmed successfully.';
        header('Location: ' . BASE_URL . 'cart/confirm-page');
        exit();
    }



    





}