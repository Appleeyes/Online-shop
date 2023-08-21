<?php

namespace OnlineShop\Models;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class Admin
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getOrders()
    {
        $query = "SELECT orders.order_id, products.thumbnail, products.name, orders.size, products.price, orders.quantity, orders.subtotal
                  FROM orders
                  JOIN products ON orders.product_id = products.product_id
                  WHERE orders.is_paid = 1";
        return $this->db->fetchAll($query);
    }

    public function getUsers()
    {
        $current_admin = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE NOT user_id=$current_admin";
        return $this->db->fetchAll($query);
    }

    public function removeUsers($user_id)
    {
        $query = "DELETE FROM users WHERE user_id = :user_id";
        $params = [
            ':user_id' => $user_id,
        ];

        try {
            return $this->db->delete($query, $params);
        } catch (\PDOException $e) {
            die('<p class="error">Failed to remove users from base: ' . $e->getMessage() . '</p>');
        }
    }
}