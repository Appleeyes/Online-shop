<?php

namespace OnlineShop\Models;

class User
{
    public $user_id;
    public $fullname;
    public $thumbnail;
    public $email;
    private $password;
    public $is_admin;
    protected $db;

    /**
     * @__construct: database construction
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @getPassword: get users Password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @setPassword: set users Password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @register: add users to database
     */
    public function register()
    {
        $data = [
            'fullname' => $this->fullname,
            'thumbnail' => $this->thumbnail,
            'email' => $this->email,
            'password' => $this->getPassword(),
            'is_admin' => $this->is_admin,
        ];

        $db = new Database();
        try {
            return $db->insert('users', $data);
        } catch (\PDOException $e) {
            die('<p class="error">Users insertion failed: ' . $e->getMessage() . '</p>');
            return false;
        }
    }

    /**
     * @getUserByEmail: get User By Email from database
     */
    public static function getUserByEmail($email)
    {
        $db = new Database();
        $query = "SELECT * FROM users WHERE email = :email";
        $params = ['email' => $email];
        return $db->fetch($query, $params);
    }
}