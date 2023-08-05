<?php 

namespace OnlineShop\Models;

error_reporting(E_ALL);
ini_set('display_errors', 1);


class Product
{
    public $product_id;
    public $name;
    public $thumbnail;
    public $description;
    public $price;
    public $category_id;
    public $is_featured;
    protected $db; // Add this property

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


    public function create()
    {
        $data = [
            'name' => $this->name,
            'thumbnail' => $this->thumbnail,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'is_featured' => $this->is_featured,
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

}


?>