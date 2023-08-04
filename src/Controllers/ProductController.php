<?php 

namespace OnlineShop\Controllers;

class ProductController
{
    public function execute(): void
    {
        require_once __DIR__ . '/../Views/Products/products.php';
    }

    public function showAddProductForm(): void
    {
        require_once __DIR__ . '/../Views/Products/addProduct.php';
    }
}
