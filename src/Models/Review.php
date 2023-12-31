<?php

namespace OnlineShop\Models;

class Review
{
    protected $db;

    /**
     * @__construct: database construction
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @addReview: add Review to database
     */
    public function addReview($product_id, $user_id, $rating, $review)
    {
        $data = [
            'product_id' => $product_id,
            'user_id' => $user_id,
            'rating' => $rating,
            'review' => $review,
        ];
        $db = new Database();
        try {
            return $db->insert('reviews', $data);
        } catch (\PDOException $e) {
            die('<p class="error">Failed to add product review: ' . $e->getMessage() . '</p>');
        }
    }

    /**
     * @getProductReviews: get Product Reviews from database
     */
    public function getProductReviews($product_id)
    {
        $query = "SELECT r.*, u.fullname, u.thumbnail
                  FROM reviews r
                  JOIN users u ON r.user_id = u.user_id
                  WHERE r.product_id = :product_id ORDER BY r.created_at DESC";
        $params = [':product_id' => $product_id];
        return $this->db->fetchAll($query, $params);
    }

    /**
     * @getLimitedProductReviews: get limited Product Reviews from database
     */
    public function getLimitedProductReviews($product_id, $limit = 3)
    {
        $query = "SELECT r.*, u.fullname, u.thumbnail
              FROM reviews r
              JOIN users u ON r.user_id = u.user_id
              WHERE r.product_id = :product_id ORDER BY r.created_at DESC
              LIMIT 3";

        $params = [
            ':product_id' => $product_id, 
        ];

        return $this->db->fetchAll($query, $params);
    }

}
