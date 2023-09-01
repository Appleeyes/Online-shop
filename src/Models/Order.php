<?php

namespace OnlineShop\Models;

class Order
{
    public $product_id;
    protected $db;

    /**
     * @__construct: database construction
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @addOrder: add Order to database
     */
    public function addOrder($size, $quantity, $subtotal, $product_id, $user_id)
    {
        $data = [
            'size' => $size,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'product_id' => $product_id,
            'user_id' => $user_id,
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

    /**
     * @markOrderAsPaid: mark Order As Paid in database
     */
    public function markOrderAsPaid($user_id, $product_id)
    {
        $data = ['is_paid' => 1];
        $condition = 'user_id = :user_id AND product_id = :product_id';
        $data['user_id'] = $user_id;
        $data['product_id'] = $product_id;
        $db = new Database();
        return $db->update('orders', $data, $condition);
    }

}