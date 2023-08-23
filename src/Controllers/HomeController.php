<?php 

namespace OnlineShop\Controllers;
use OnlineShop\Models\Product;

class HomeController
{
    public function execute(): void
    {
        $productModel = new Product();
        $featuredProducts = $productModel->getFeaturedProducts(8);
        $newProducts = $productModel->getNewProducts(8);
        $product = new Product();
        $categories = $product->getCategories();
        require_once __DIR__ . '/../Views/Main/home.php';
    }
}


?>