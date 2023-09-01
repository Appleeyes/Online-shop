<?php

namespace OnlineShop\Models;

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

    /**
     * @__construct: database construction
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @getCategories: get Categories from database
     */
    public function getCategories(): array
    {
        $query = "SELECT * FROM categories";
        $categories = $this->db->fetchAll($query);
        return $categories;
    }

    /**
     * @getProducts: get products from database
     */
    public function getProducts(): array
    {
        $query = "SELECT p.*, c.title AS category_title
              FROM products AS p
              JOIN categories AS c ON p.category_id = c.category_id ORDER BY p.name ASC";
        $products = $this->db->fetchAll($query);
        return $products;
    }

    /**
     * @getFeaturedProducts: get featured products from database
     */
    public function getFeaturedProducts($limit = 8): array
    {
        $query = "SELECT p.*, c.title as category_title 
          FROM products p 
          JOIN categories c ON p.category_id = c.category_id 
          WHERE p.is_featured = 0 ORDER BY p.name ASC
          LIMIT 8";
        $featuredProducts = $this->db->fetchAll($query);
        return $featuredProducts;
    }

    /**
     * @getNewProducts: get new products from database
     */
    public function getNewProducts($limit = 8): array
    {
        $query = "SELECT p.*, c.title as category_title 
          FROM products p 
          JOIN categories c ON p.category_id = c.category_id 
          WHERE p.is_new = 0 ORDER BY p.name ASC
          LIMIT 8";
        $newProducts = $this->db->fetchAll($query);
        return $newProducts;
    }

    /**
     * @create: insert new products into database
     */
    public function create(): bool
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
            die('<p class="error">Product insertion failed: ' . $e->getMessage() . '</p>');
            return false;
        }
    }

    /**
     * @fetchProductById: get products by their id from database
     */
    public function fetchProductById($product_id)
    {
        $query = "SELECT p.*, c.title as category_title FROM products p JOIN categories c ON p.category_id = c.category_id WHERE p.product_id = ?";
        return $this->db->fetch($query, [$product_id]);
    }

    /**
     * @update: update products from database
     */
    public function update(): bool
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

    /**
     * @getPaginatedProducts: get Paginated Products from database
     */
    public function getPaginatedProducts($page = 1, $perPage = 12): array
    {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT p.*, c.title AS category_title
              FROM products AS p
              JOIN categories AS c ON p.category_id = c.category_id
              LIMIT $perPage OFFSET $offset";
        $products = $this->db->fetchAll($query);
        return $products;
    }

    /**
     * @searchProducts: search Products using keywords from database
     */
    public function searchProducts($keyword): array
    {
        $query = "SELECT p.*, c.title as category_title 
              FROM products p 
              JOIN categories c ON p.category_id = c.category_id 
              WHERE p.name LIKE :keyword OR c.title LIKE :keyword";
        $params = [
            ':keyword' => '%' . $keyword . '%',
        ];
        $products = $this->db->fetchAll($query, $params);
        return $products;
    }

    /**
     * @fetchProductsByCategoryId: fetch Products By Category Id from database
     */
    public function fetchProductsByCategoryId($category_id)
    {
        $query = "SELECT * FROM products WHERE category_id = ?";
        return $this->db->fetchAll($query, [$category_id]);
    }
}
