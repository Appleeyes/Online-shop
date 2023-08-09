<?php 

namespace OnlineShop\Controllers;
use OnlineShop\Models\User;

ini_set('display_errors', 1);
error_reporting(E_ALL);


class UserController
{
    public function showUserRegisterForm(): void
    {
        require_once __DIR__ . '/../Views/Users/users/register.php';
    }

    public function registerUser(): void
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
                header('location: ' . BASE_URL . 'register');
                die();
            } else {
                $result = $user->register();

                if ($result) {
                    $_SESSION['success_message'] = 'User successfully registered.';
                    header('location: ' . BASE_URL . 'register');
                    die();
                }
            }     
        } 
    }

    public function showUserLoginForm(): void
    {
        require_once __DIR__ . '/../Views/Users/users/login.php';
    }

    public function loginUser():void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Fetch user by email
            $user = User::getUserByEmail($email);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['user_fullname'] = $user->fullname;
                $_SESSION['success_message'] = 'You are successfully logeed in.';
                header('Location: ' . BASE_URL . 'product');
                exit();
            } else {
                $_SESSION['error_message'] = 'Invalid email or password.';
            }

            if (isset($_SESSION['error_message'])) {
                $_SESSION['login-data'] = $_POST;
                header('location: ' . BASE_URL . 'login');
                die();
            }
        }
    }
}