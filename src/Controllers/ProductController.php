<?php

namespace OnlineShop\Controllers;

use OnlineShop\Models\Product;
use OnlineShop\Models\Admin;
use OnlineShop\Models\Review;


class ProductController
{
    /**
     * @execute: show product page
     * @getProducts: get product method
     * @getPaginatedProducts: get Paginated Products method
     * @getCategories: get product Categories
     * return: void
     */
    public function execute(): void
    {
        $product = new Product();
        $perPage = 12;
        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

        $totalProducts = count($product->getProducts());
        $totalPages = ceil($totalProducts / $perPage);

        $products = $product->getPaginatedProducts($currentPage, $perPage);

        $product = new Product();
        $categories = $product->getCategories();

        require_once __DIR__ . '/../Views/Products/products.php';
    }

    /**
     * @showCategoryProduct: show Category Product page
     * @fetchProductsByCategoryId: get product by category method
     * @fetchCategoryById: get category id method
     */
    public function showCategoryProduct($params)
    {
        $category_id = $params['category_id'];

        $product = new Product();
        $categoryProducts = $product->fetchProductsByCategoryId($category_id);

        $admin = new Admin;
        $category = $admin->fetchCategoryById($category_id);

        require_once __DIR__ . '/../Views/Products/categoryProductList.php';
    }

    /**
     * @showAddProductForm: show Add Product Form
     * @getCategories: get category method
     * return: void
     */
    public function showAddProductForm(): void
    {
        $product = new Product();
        $categories = $product->getCategories();
        require_once __DIR__ . '/../Views/Products/addProduct.php';
    }

    /**
     * @addProduct:  Add Product to database
     * @create: create method
     * return: void
     */
    public function addProduct(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $product = new Product();
            $product->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $product->description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $product->price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
            $product->category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
            $product->is_featured = filter_input(INPUT_POST, 'is_featured', FILTER_SANITIZE_NUMBER_INT);
            $product->is_new = filter_input(INPUT_POST, 'is_new', FILTER_SANITIZE_NUMBER_INT);

            if ($_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $tempFilePath = $_FILES['thumbnail']['tmp_name'];
                $fileName = $_FILES['thumbnail']['name'];
                $product->thumbnail = 'images/' . $fileName;

                $destinationPath = __DIR__ . '/../../../Online-shop/public/db-img/';
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $product->thumbnail);
                $extension = end($extension);
                if (in_array($extension, $allowed_files)) {
                    if ($_FILES['thumbnail']['size'] < 3000000) {
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

            if (isset($_SESSION['error_message'])) {
                $_SESSION['product-data'] = $_POST;
                header('location: ' . BASE_URL . 'product/add');
                die();
            } else {
                $result = $product->create();

                if ($result) {
                    $_SESSION['success_message'] = 'Product added successfully.';
                    header('location: ' . BASE_URL . 'admin/products');
                    die();
                }
            }
        }
    }

    /**
     * @showUpdateProductForm: show Update Product Form
     * @getCategories: get category method
     * @fetchProductById: fetch Product By Id method
     */
    public function showUpdateProductForm()
    {
        $product_id = $_GET['id'];
        $product = new Product();
        $categories = $product->getCategories();
        $productData = $product->fetchProductById($product_id);
        require_once __DIR__ . '/../Views/Products/updateProduct.php';
    }

    /**
     * @updateProduct: Update Product from database
     * @update: update method
     */
    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $product = new Product();
            $product->product_id = $_POST['product_id'];
            $product->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $product->description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $product->price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
            $product->category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
            $product->is_featured = filter_input(INPUT_POST, 'is_featured', FILTER_SANITIZE_NUMBER_INT);
            $product->is_new = filter_input(INPUT_POST, 'is_new', FILTER_SANITIZE_NUMBER_INT);
            $previous_thumbnail_path = $_POST['previous_thumbnail_name'];

            $previous_thumbnail_name = basename($previous_thumbnail_path);
            $previous_thumbnail_full_path = __DIR__ . '/../../../Online-shop/public/db-img/' . $previous_thumbnail_name;

            if (file_exists($previous_thumbnail_full_path)) {
                try {
                    if (unlink($previous_thumbnail_full_path)) {
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
                $tempFilePath = $_FILES['thumbnail']['tmp_name'];
                $fileName = $_FILES['thumbnail']['name'];
                $product->thumbnail = 'images/' . $fileName; 
                $destinationPath = __DIR__ . '/../../../Online-shop/public/db-img/';
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $product->thumbnail);
                $extension = end($extension);
                if (in_array($extension, $allowed_files)) {
                    if ($_FILES['thumbnail']['size'] < 3000000) {
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

            if (isset($_SESSION['error_message'])) {
                header('location: ' . BASE_URL . 'product/update?id=' . $product->product_id);
                die();
            } else {
                $result = $product->update();

                if ($result) {
                    $_SESSION['success_message'] = 'Product updated successfully.';
                    header('location: ' . BASE_URL . 'admin/products');
                    die();
                }
            }
        }
    }

    /**
     * @showProductDetails: show Product Details page
     * @fetchProductById: fetch Product By Id method
     * @getFeaturedProducts: get Featured Products method
     * @getLimitedProductReviews: get Limited Product Reviews method
     */
    public function showProductDetails()
    {
        $product_id = $_GET['id'];
        $product = new Product();
        $productDetails = $product->fetchProductById($product_id);
        $featuredProducts = $product->getFeaturedProducts(8);

        $review = new Review;
        $reviews = $review->getLimitedProductReviews($product_id, 3);
        require_once __DIR__ . '/../Views/Products/productDetails.php';
    }

    /**
     * @showReviewPage: show Review Page
     * @getProductReviews: get Product Reviews method
     */
    public function  showReviewPage()
    {
        $product_id = $_GET['id'];
        $user_id = $_SESSION['user_id'];

        $review = new Review;
        $reviewPage = $review->getProductReviews($product_id);
        require_once __DIR__ . '/../Views/Products/reviews.php';
    }

    /**
     * @addReview: add Review 
     * @addReview: add Review method
     */
    public function addReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'];
            $product_id = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
            $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);
            $review = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $reviewModel = new Review;
            $result = $reviewModel->addReview($product_id, $user_id, $rating, $review);

            if ($result) {
                $_SESSION['success_message'] = 'Review added successfully.';
                header('location: ' . BASE_URL .'product/details?id=' . $product_id);
                exit();
            }
        }
    }

    /**
     * @userSearch: user Search 
     * @searchProducts: search Products method
     */
    public function userSearch()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['submit']) && isset($_GET['search'])) {
            $keyword = $_GET['search'];

            $product = new Product();
            $searchResults = $product->searchProducts($keyword);

            require_once __DIR__ . '/../Views/Products/userSearchResults.php';
        }
    }
}
