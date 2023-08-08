<?php

namespace OnlineShop\Models;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class Product
{
    public $product_id;
    public $name;
    public $thumbnail;
    public $description;
    public $price;
    public $category_id;
    public $is_featured;
    public $is_new;
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getCategories()
    {
        $query = "SELECT * FROM categories";
        $categories = $this->db->fetchAll($query);
        return $categories;
    }

    public function getProducts(){
        $query = "SELECT p.*, c.title AS category_title
              FROM products AS p
              JOIN categories AS c ON p.category_id = c.category_id";
        $products = $this->db->fetchAll($query);
        return $products;
    }

    public function getFeaturedProducts($limit = 8)
    {
        $query = "SELECT p.*, c.title as category_title 
          FROM products p 
          JOIN categories c ON p.category_id = c.category_id 
          WHERE p.is_featured = 0 
          LIMIT 8";
        $featuredProducts = $this->db->fetchAll($query);
        return $featuredProducts;
    }

    public function getNewProducts($limit = 8)
    {
        $query = "SELECT p.*, c.title as category_title 
          FROM products p 
          JOIN categories c ON p.category_id = c.category_id 
          WHERE p.is_new = 0 
          LIMIT 8";
        $newProducts = $this->db->fetchAll($query);
        return $newProducts;
    }

    public function create()
    {
        $data = [
            'name' => $this->name,
            'thumbnail' => $this->thumbnail,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'is_featured' => $this->is_featured,
            'is_new' => $this->is_new,
        ];

        $db = new Database();
        try {
            return $db->insert('products', $data);
        } catch (\PDOException $e) {
            // Handle the error, e.g. log it or display a user-friendly message
            die('<p class="error">Product insertion failed: ' . $e->getMessage() . '</p>');
            return false;
        }
    }

    public function fetchProductById($product_id)
    {
        $query = "SELECT * FROM products WHERE product_id = ?";
        return $this->db->fetch($query, [$product_id]);
    }

    public function update()
    {
        $data = [
            'name' => $this->name,
            'thumbnail' => $this->thumbnail,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'is_featured' => $this->is_featured,
            'is_new' => $this->is_new,
        ];

        $condition = "product_id = :product_id";
        $data['product_id'] = $this->product_id;

        $db = new Database();
        return $db->update('products', $data, $condition);
    }
}
