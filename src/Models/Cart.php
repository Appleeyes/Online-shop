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

    public function removeCartItem($user_id, $cart_id)
    {
        $query = "DELETE FROM carts WHERE cart_id = :cart_id AND user_id = :user_id";
        $params = [
            ':cart_id' => $cart_id,
            ':user_id' => $user_id,
        ];

        try {
            return $this->db->delete($query, $params);
        } catch (\PDOException $e) {
            die('<p class="error">Failed to remove product from cart: ' . $e->getMessage() . '</p>');
        }
    }


    public function getUserCartItems($user_id)
    {
        $query = "SELECT carts.cart_id, products.thumbnail, products.name, carts.size, products.price, carts.quantity, (products.price * carts.quantity) AS subtotal
                  FROM carts
                  JOIN products ON carts.product_id = products.product_id
                  WHERE carts.user_id = :user_id";
        $params = [':user_id' => $user_id];

        return $this->db->fetchAll($query, $params);
    }

    public function getCartCount($user_id)
    {
        $query = "SELECT COUNT(*) as count FROM carts WHERE user_id = :user_id";
        $result = $this->db->fetch($query, ['user_id' => $user_id]);

        return $result->count;
    }

    
}
