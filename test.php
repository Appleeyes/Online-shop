<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/database.php'; 
try {
    $db = new \OnlineShop\Models\Database();
    echo 'Database connection successful.';
} catch (\PDOException $e) {
    echo 'Database connection failed: ' . $e->getMessage();
}
