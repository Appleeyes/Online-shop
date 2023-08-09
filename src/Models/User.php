<?php

namespace OnlineShop\Models;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class User
{
    public $user_id;
    public $fullname;
    public $thumbnail;
    public $email;
    private $password;
    public $is_admin;
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function register()
    {
        $data = [
            'fullname' => $this->fullname,
            'thumbnail' => $this->thumbnail,
            'email' => $this->email,
            'password' => $this->getPassword(),
        ];

        $db = new Database();
        try {
            return $db->insert('users', $data);
        } catch (\PDOException $e) {
            die('<p class="error">Users insertion failed: ' . $e->getMessage() . '</p>');
            return false;
        }
    }

    public static function getUserByEmail($email)
    {
        $db = new Database();
        $query = "SELECT * FROM users WHERE email = :email";
        $params = ['email' => $email];
        return $db->fetch($query, $params);
    }
}