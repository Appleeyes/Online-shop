<?php

namespace OnlineShop\Models;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cart.php (model)
class Cart
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addProduct($user_id, $product_id, $size, $quantity)
    {
        $data = [
            'user_id' => $user_id,
            'product_id' => $product_id,
            'size' => $size,
            'quantity' => $quantity,
        ];

        $db = new Database();
        try {
            return $db->insert('carts', $data);
        } catch (\PDOException $e) {
            die('<p class="error">Failed to add product to cart: ' . $e->getMessage() . '</p>');
        }
    }
}
