<?php

namespace OnlineShop\Models;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class Order
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addOrder($size, $quantity, $subtotal,$product_id)
    {
        $data = [
            'size' => $size,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'product_id' => $product_id,
        ];

        $db = new Database();
        try {
            $db->beginTransaction();

            $inserted = $db->insert('orders', $data);

            if ($inserted) {
                $db->commit();
                return true;
            } else {
                $db->rollBack();
                return false;
            }
        } catch (\PDOException $e) {
            $db->rollBack();
            die('<p class="error">Failed to add orders: ' . $e->getMessage() . '</p>');
        }
    }

}