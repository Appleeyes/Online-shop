<?php

namespace OnlineShop\Models;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class Admin
{
    public $title;
    public $description;
    public $category_id;
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

    public function getUsersById($user_id)
    {
        $query = "SELECT * FROM users WHERE user_id = ?";
        return $this->db->fetch($query, [$user_id]);
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

    public function createCategories()
    {
        $data = [
            'title' => $this->title,
            'description' => $this->description,
        ];

        $db = new Database();
        try {
            return $db->insert('categories', $data);
        } catch (\PDOException $e) {
            die('<p class="error">Categories insertion failed: ' . $e->getMessage() . '</p>');
            return false;
        }
    }

    public function fetchCategoryById($category_id)
    {
        $query = "SELECT * FROM categories WHERE category_id = ?";
        return $this->db->fetch($query, [$category_id]);
    }

    public function updateCategory(): bool
    {
        $data = [
            'title' => $this->title,
            'description' => $this->description,
        ];

        $condition = "category_id = :category_id";
        $data['category_id'] = $this->category_id;

        $db = new Database();
        return $db->update('categories', $data, $condition);
    }

    public function removeCategory($category_id)
    {
        $query = "DELETE FROM categories WHERE category_id = :category_id";
        $params = [
            ':category_id' => $category_id,
        ];

        try {
            return $this->db->delete($query, $params);
        } catch (\PDOException $e) {
            die('<p class="error">Failed to remove category from base: ' . $e->getMessage() . '</p>');
        }
    }
}