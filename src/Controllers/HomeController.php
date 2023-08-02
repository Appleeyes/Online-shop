<?php 

namespace OnlineShop\Controllers;

class HomeController
{
    public function execute(): void
    {
        require_once __DIR__ . '/../Views/Main/home.php';
    }
}


?>