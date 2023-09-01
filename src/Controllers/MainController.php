<?php 

namespace OnlineShop\Controllers;
use OnlineShop\Models\Product;

class MainController
{
    /**
     * @execute: show home page
     * @getFeaturedProducts: get Featured Products method
     * @getNewProducts: get New Products method
     * @getCategories: get Categories method
     * return: void
     */
    public function execute(): void
    {
        $productModel = new Product();
        $featuredProducts = $productModel->getFeaturedProducts(8);
        $newProducts = $productModel->getNewProducts(8);
        $product = new Product();
        $categories = $product->getCategories();
        require_once __DIR__ . '/../Views/Main/home.php';
    }

    /**
     * @showAboutPage: show About Page
     * return: void
     */
    public function showAboutPage(): void
    {
        
        require_once __DIR__ . '/../Views/Main/about.php';
    }

    /**
     * @showContactPage: show Contact Page
     * return: void
     */
    public function showContactPage(): void
    {

        require_once __DIR__ . '/../Views/Main/contact.php';
    }
}


?>