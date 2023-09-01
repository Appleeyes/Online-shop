<?php

namespace OnlineShop\Models;

class Admin
{
    public $title;
    public $description;
    public $category_id;
    protected $db;

    /**
     * @__construct: database construction
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @getOrders: get orders from database
     */
    public function getOrders()
    {
        $query = "SELECT orders.order_id, products.thumbnail, products.name, orders.size, products.price, orders.quantity, orders.subtotal
                  FROM orders
                  JOIN products ON orders.product_id = products.product_id
                  WHERE orders.is_paid = 1";
        return $this->db->fetchAll($query);
    }

    /**
     * @getUsers: get users from database
     */
    public function getUsers()
    {
        $current_admin = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE NOT user_id=$current_admin";
        return $this->db->fetchAll($query);
    }

    /**
     * @getUsersById: get users by their id from database
     */
    public function getUsersById($user_id)
    {
        $query = "SELECT * FROM users WHERE user_id = ?";
        return $this->db->fetch($query, [$user_id]);
    }

    /**
     * @removeUesrs: remove users from database
     */
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

    /**
     * @createCategories: add categories to database
     */
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

    /**
     * @fetchCategoryByid: get categories by their id from database
     */
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

    /**
     * @removeCategory: remove category from database
     */
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

    /**
     * @removeProduct: remove product from database
     */
    public function removeProduct($product_id)
    {
        $query = "DELETE FROM products WHERE product_id = :product_id";
        $params = [
            ':product_id' => $product_id,
        ];

        try {
            return $this->db->delete($query, $params);
        } catch (\PDOException $e) {
            die('<p class="error">Failed to remove product from base: ' . $e->getMessage() . '</p>');
        }
    }
}