<?php 

namespace OnlineShop\Controllers;
use OnlineShop\Models\User;

class UserController
{
    /**
     * @showUserRegisterForm: show User Register Form 
     * return: void
     */
    public function showUserRegisterForm(): void
    {
        require_once __DIR__ . '/../Views/Users/users/register.php';
    }

    /**
     * @registerUser: user registration
     * @getPassword: get users password
     * @register: register method
     * return: void
     */
    public function registerUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $user->fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $user->is_admin = ($_POST['is_admin'] = 0);
            $confirmPassword = $_POST['confirm_password'];

            if (!password_verify($confirmPassword, $user->getPassword())) {
                $_SESSION['error_message'] = "Passwords do not match.";
            }

            if ($_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                $tempFilePath = $_FILES['thumbnail']['tmp_name'];
                $fileName = $_FILES['thumbnail']['name'];
                $user->thumbnail = 'images/' . $fileName;

                $destinationPath = __DIR__ . '/../../../Online-shop/public/db-img/';
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $user->thumbnail);
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
                $_SESSION['user-data'] = $_POST;
                header('location: ' . BASE_URL . 'register');
                die();
            } else {
                $result = $user->register();

                if ($result) {
                    $_SESSION['success_message'] = 'User successfully registered, please log in.';
                    header('location: ' . BASE_URL . 'login');
                    die();
                }
            }     
        } 
    }

    /**
     * @showUserLoginForm: show User Login Form
     * return: void
     */
    public function showUserLoginForm(): void
    {
        require_once __DIR__ . '/../Views/Users/users/login.php';
    }

    /**
     * @loginUser: users login
     * @getUserByEmail: get User By Email method
     * return: void
     */
    public function loginUser():void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $user = new User();
            $userData = $user->getUserByEmail($email);

            if ($userData && password_verify($password, $userData->password)) {
                $_SESSION['user_id'] = $userData->user_id;
                $_SESSION['user_thumbnail'] = $userData->thumbnail;
                $_SESSION['user_fullname'] = $userData->fullname;
                if ($userData->is_admin == 1) {
                    $_SESSION['user_role'] = true;
                } else {
                    $_SESSION['user_role'] = false;
                }
                $_SESSION['success_message'] = 'You are successfully logged in.';
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

    /**
     * @logoutUser: users logout
     * return: void
     */
    public function logoutUser(): void
    {
        session_start();
        $_SESSION = array();

        session_destroy();

        header('Location: ' . BASE_URL . 'product');
        exit();
    }

}