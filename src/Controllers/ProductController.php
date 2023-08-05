<?php 

namespace OnlineShop\Controllers;
use OnlineShop\Models\Product;

class ProductController
{
    public function execute(): void
    {
        require_once __DIR__ . '/../Views/Products/products.php';
    }

    public function showAddProductForm(): void
    {
        $product = new Product();
        $categories = $product->getCategories();
        require_once __DIR__ . '/../Views/Products/addProduct.php';
    }

    public function addProduct()
    {
        var_dump($_POST);
        // Handle form submission to add product
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize input fields

            $product = new Product();
            $product->name = $_POST['name'];
            $product->thumbnail = $_POST['thumbnail'];
            $product->description = $_POST['description'];
            $product->price = $_POST['price'];
            $product->category_id = $_POST['category_id'];
            $product->is_featured = $_POST['is_featured'];

            $result = $product->create();

            if ($result) {
                header('location: '. BASE_URL . 'product/add');
                die();
            } else {
                echo "ERROR!!!";
            }
        }
    }
}
