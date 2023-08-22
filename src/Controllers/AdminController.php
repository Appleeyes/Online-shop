<?php

namespace OnlineShop\Controllers;
use OnlineShop\Models\User;
use OnlineShop\Models\Admin;
use OnlineShop\Models\Product;



class AdminController
{
    public function execute(): void
    {
        $admin = new Admin();
        $Users = $admin->getUsers();
        require_once __DIR__ . '/../Views/Users/admin/index.php';
    }

    public function showAddAdminForm()
    {
        require_once __DIR__ . '/../Views/Users/admin/addAdmin.php';
    }

    public function addAdmin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $user->fullname = $_POST['fullname'];
            $user->email = $_POST['email'];
            $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $user->is_admin = $_POST['is_admin'];
            $confirmPassword = $_POST['confirm_password'];

            if (!password_verify($confirmPassword, $user->getPassword())) {
                $_SESSION['error_message'] = "Passwords do not match.";
            }

            // Handle image upload
            if ($_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $tempFilePath = $_FILES['thumbnail']['tmp_name'];
                $fileName = $_FILES['thumbnail']['name'];
                $user->thumbnail = 'images/' . $fileName; // Save relative path in the database

                // Make sure the destination directory exists
                $destinationPath = __DIR__ . '/../../../Online-shop/public/db-img/';
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // make sure the file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $user->thumbnail);
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

            // incase of error redirect back with form data
            if (isset($_SESSION['error_message'])) {
                $_SESSION['user-data'] = $_POST;
                header('location: ' . BASE_URL . 'admin/add');
                die();
            } else {
                $result = $user->register();

                if ($result) {
                    $_SESSION['success_message'] = 'Admin successfully registered.';
                    header('location: ' . BASE_URL . 'admin');
                    die();
                }
            }
        }
    }
    
    public function showPaidOrders()
    {
        $admin = new Admin();
        $paidOrders = $admin->getOrders();
        require_once __DIR__ . '/../Views/Users/admin/paidOrders.php';
    }

    public function removeUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];

            $admin = new Admin();
            $user = $admin->getUsersById($user_id); // Fetch user data

            if ($user) {
                $result = $admin->removeUsers($user_id);

                $thumbnailPath = __DIR__ . '/../../../Online-shop/public/db-img/';
                $thumbnailName = basename($user->thumbnail);
                // Construct the full path to the thumbnail
                $fullThumbnailPath = $thumbnailPath . $thumbnailName;

                // Check if the thumbnail file exists and delete it
                if (file_exists($fullThumbnailPath)) {
                    if (unlink($fullThumbnailPath)) {
                        $_SESSION['success_message'] .= ' Thumbnail deleted.';
                    } else {
                        $_SESSION['error_message'] .= ' Unable to delete thumbnail.';
                    }
                } else {
                    $_SESSION['error_message'] .= ' Thumbnail not found.';
                }

                if ($result) {
                    $_SESSION['success_message'] = 'User deleted successfully.';
                } else {
                    $_SESSION['error_message'] = 'Unable to delete user.';
                }
            } else {
                $_SESSION['error_message'] = 'User not found.';
            }

            header('Location: ' . BASE_URL . 'admin');
            exit();
        }
    }


    public function showCategories(): void
    {
        $products = new Product();
        $categories = $products->getCategories();
        require_once __DIR__ . '/../Views/Users/admin/categories.php';
    }

    public function showCategoryForm(): void
    {
        require_once __DIR__ . '/../Views/Users/admin/addcategories.php';
    }

    public function addCategories(): void
    {
        // Handle form submission to add product
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize input fields

            $admin = new Admin();
            $admin->title = $_POST['title'];
            $admin->description = $_POST['description'];

            $result = $admin->createCategories();
            if ($result) {
                $_SESSION['success_message'] = 'Category added successfully.';
                header('location: ' . BASE_URL . 'admin/categories');
                exit();
            }

        }
    }

    public function showUpdateCategoryForm()
    {
        $category_id = $_GET['id'];
        $admin = new Admin();
        $categoryData = $admin->fetchCategoryById($category_id);
        require_once __DIR__ . '/../Views/Users/admin/updateCategory.php';
    }

    public function updateCategories(): void
    {
        // Handle form submission to add product
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize input fields

            $admin = new Admin();
            $admin->category_id = $_POST['category_id'];
            $admin->title = $_POST['title'];
            $admin->description = $_POST['description'];

            $result = $admin->updateCategory();

            if ($result) {
                $_SESSION['success_message'] = 'Category updated successfully.';
                header('location: ' . BASE_URL . 'admin/categories');
                die();
            }
        }
    }

    public function removeCategories()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];

            $admin = new Admin();
            $result = $admin->removeCategory($category_id);

            if ($result) {
                $_SESSION['success_message'] = 'Category deleted successfully.';
            } else {
                $_SESSION['error_message'] = 'Unable to delete Category.';
            }

            header('Location: ' . BASE_URL . 'admin/categories');
            exit();
        }
    }

    public function showProductTable()
    {
        $product = new Product;
        $productData = $product->getProducts();
        require_once __DIR__ . '/../Views/Users/admin/products.php';
    }

    public function removeProducts()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];

            $product = new Product();
            $products = $product->fetchProductById($product_id); // Fetch user data

            if ($products) {
                $admin = new Admin();
                $result = $admin->removeProduct($product_id);

                $thumbnailPath = __DIR__ . '/../../../Online-shop/public/db-img/';
                $thumbnailName = basename($products->thumbnail);
                // Construct the full path to the thumbnail
                $fullThumbnailPath = $thumbnailPath . $thumbnailName;

                // Check if the thumbnail file exists and delete it
                if (file_exists($fullThumbnailPath)) {
                    if (unlink($fullThumbnailPath)) {
                        $_SESSION['success_message'] .= ' Thumbnail deleted.';
                    } else {
                        $_SESSION['error_message'] .= ' Unable to delete thumbnail.';
                    }
                } else {
                    $_SESSION['error_message'] .= ' Thumbnail not found.';
                }

                if ($result) {
                    $_SESSION['success_message'] = 'Product deleted successfully.';
                } else {
                    $_SESSION['error_message'] = 'Unable to delete Product.';
                }
            } else {
                $_SESSION['error_message'] = 'Product not found.';
            }

            header('Location: ' . BASE_URL . 'admin/products');
            exit();
        }
    }

    public function adminSearch()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['submit']) && isset($_GET['search'])) {
            $keyword = $_GET['search'];

            $product = new Product();
            $searchResults = $product->searchProducts($keyword);

            if ($searchResults) {
                require_once __DIR__ . '/../Views/Users/admin/adminSearchResults.php';
                exit();
            }
        }
    }
}