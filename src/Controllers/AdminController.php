<?php

namespace OnlineShop\Controllers;
use OnlineShop\Models\User;
use OnlineShop\Models\Admin;



class AdminController
{
    public function execute(): void
    {
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

    
}