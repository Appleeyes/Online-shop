<?php 

namespace OnlineShop\Controllers;
use OnlineShop\Models\Order;
use OnlineShop\Models\Product;

ini_set('display_errors', 1);
error_reporting(E_ALL);


class OrderController
{
    public function addProductToOrder($size, $quantity, $product_id)
    {
        $productModel = new Product;
        $productDetails = $productModel->fetchProductById($product_id);
        if (!$productDetails) {
            return false;
        }

        $productPrice = $productDetails->price;
        $subtotal = $productPrice * $quantity;

        $order = new Order();
        $result = $order->addOrder($size, $quantity, $subtotal, $product_id);

        if ($result) {
            return true;
        }

        return false;
    }


    
}