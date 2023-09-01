<?php

namespace OnlineShop\Models;

class Cart
{
    protected $db;

    /**
     * @__construct: database construction
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @addProduct: add products to database
     */
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

    /**
     * @removeCartItem: remove Cart Item from database
     */
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

    /**
     * @clearUserCart: clear User Cart Items from database
     */
    public function clearUserCart($user_id)
    {
        $query = "DELETE FROM carts WHERE user_id = :user_id";
        $params = [':user_id' => $user_id];

        $db = new Database();
        return $db->delete($query, $params);
    }

    /**
     * @getUserCartItems: get User Cart Items from database
     */
    public function getUserCartItems($user_id)
    {
        $query = "SELECT carts.cart_id, products.thumbnail, products.name, carts.size, products.price, carts.quantity, (products.price * carts.quantity) AS subtotal
                  FROM carts
                  JOIN products ON carts.product_id = products.product_id
                  WHERE carts.user_id = :user_id";
        $params = [':user_id' => $user_id];

        return $this->db->fetchAll($query, $params);
    }

    /**
     * @getUserCartProductIds: get User Cart Items by id from database
     */
    public function getUserCartProductIds($user_id)
    {
        $query = "SELECT product_id FROM carts WHERE user_id = :user_id";
        $params = [':user_id' => $user_id];

        $result = $this->db->fetchArray($query, $params);

        $productIds = [];
        foreach ($result as $row) {
            $productIds[] = $row['product_id'];
        }

        return $productIds;
    }

    /**
     * @getCartCount: get User Cart Items count from database
     */
    public function getCartCount($user_id)
    {
        $query = "SELECT COUNT(*) as count FROM carts WHERE user_id = :user_id";
        $result = $this->db->fetch($query, ['user_id' => $user_id]);

        return $result->count;
    }

    
}
