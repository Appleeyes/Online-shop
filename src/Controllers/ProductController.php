<?php 

namespace OnlineShop\Controllers;
use OnlineShop\Models\Product;

ini_set('display_errors', 1);
error_reporting(E_ALL);


class ProductController
{
    public function execute(): void
    {
        $product = new Product();
        $products = $product->getProducts();
        $categories = $product->getCategories();
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
        // Handle form submission to add product
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize input fields

            $product = new Product();
            $product->name = $_POST['name'];
            $product->description = $_POST['description'];
            $product->price = $_POST['price'];
            $product->category_id = $_POST['category_id'];
            $product->is_featured = $_POST['is_featured'];
            $product->is_new = $_POST['is_new'];

            // Handle image upload
            if ($_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $tempFilePath = $_FILES['thumbnail']['tmp_name'];
                $fileName = $_FILES['thumbnail']['name'];
                $product->thumbnail = 'images/' . $fileName; // Save relative path in the database

                // Make sure the destination directory exists
                $destinationPath = __DIR__ . '/../../../Online-shop/public/db-img/';
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // make sure the file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $product->thumbnail);
                $extension = end($extension);
                if (in_array($extension, $allowed_files)) {
                    // make sure image size is not too big
                    if ($_FILES['thumbnail']['size'] < 3000000){
                        // upload image
                        move_uploaded_file($tempFilePath, $destinationPath . $fileName);
                    } else {
                        $_SESSION['error_message'] = "File size is too big. Should be less than 3mb";
                    }
                } else {
                    $_SESSION['error_message'] = "File should be png, jpg, or jpeg";
                }
            } else {
                $_SESSION['error_message'] = "No image uploaded";
            }

            // incase of error redirect back with form data
            if (isset($_SESSION['error_message'])) {
                $_SESSION['product-data'] = $_POST;
                header('location: ' . BASE_URL . 'product/add');
                die();
            } else {
                $result = $product->create();

                if ($result) {
                    $_SESSION['success_message'] = 'Product added successfully.';
                    header('location: ' . BASE_URL . 'product/add');
                    die();
                }
            }            
        }
    }


    public function showUpdateProductForm()
    {
        $product_id = $_GET['id']; // Get product ID from query parameter
        $product = new Product();
        $categories = $product->getCategories();
        $productData = $product->fetchProductById($product_id); // Fetch product data by ID
        require_once __DIR__ . '/../Views/Products/updateProduct.php';
    }

    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize input fields

            $product = new Product();
            $product->product_id = $_POST['product_id'];
            $product->name = $_POST['name'];
            $product->description = $_POST['description'];
            $product->price = $_POST['price'];
            $product->category_id = $_POST['category_id'];
            $product->is_featured = $_POST['is_featured'];
            $product->is_new = $_POST['is_new'];
            $previous_thumbnail_path = $_POST['previous_thumbnail_name'];

            $previous_thumbnail_name = basename($previous_thumbnail_path);
            // delete existing thumbnail if new one is uploaded
            $previous_thumbnail_full_path = __DIR__ . '/../../../Online-shop/public/db-img/' . $previous_thumbnail_name;

            // Perform the deletion operation
            if (file_exists($previous_thumbnail_full_path)) {
                try {
                    if (unlink($previous_thumbnail_full_path)) {
                        // Successfully deleted
                        error_log("Image deleted successfully: $previous_thumbnail_full_path");
                    } else {
                        $error = error_get_last();
                        $_SESSION['error_message'] = "Error deleting previous image: " . $error['message'];
                        error_log("Error deleting previous image: " . $error['message']);
                    }
                } catch (\PDOException $e) {
                    $_SESSION['error_message'] = "Exception during image deletion: " . $e->getMessage();
                    error_log("Exception during image deletion: " . $e->getMessage());
                }
            }

            if ($_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                // handle new image upload
                $tempFilePath = $_FILES['thumbnail']['tmp_name'];
                $fileName = $_FILES['thumbnail']['name'];
                $product->thumbnail = 'images/' . $fileName; // Save relative path in the database

                // Make sure the destination directory exists
                $destinationPath = __DIR__ . '/../../../Online-shop/public/db-img/';
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // make sure the file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $product->thumbnail);
                $extension = end($extension);
                if (in_array($extension, $allowed_files)) {
                    // make sure image size is not too big
                    if ($_FILES['thumbnail']['size'] < 3000000) {
                        // upload image
                        move_uploaded_file($tempFilePath, $destinationPath . $fileName);
                    } else {
                        $_SESSION['error_message'] = "File size is too big. Should be less than 3mb";
                    }
                } else {
                    $_SESSION['error_message'] = "File should be png, jpg, or jpeg";
                }
            } else {
                $_SESSION['error_message'] = "No image uploaded";
            }

            // Update the product and handle errors
            if (isset($_SESSION['error_message'])) {
                header('location: ' . BASE_URL . 'product/update?id=' . $product->product_id);
                die();
            } else {
                $result = $product->update();

                if ($result) {
                    $_SESSION['success_message'] = 'Product updated successfully.';
                    header('location: ' . BASE_URL .'product/update?id=' . $product->product_id);
                    die();
                }
            }
        }
    }
}
