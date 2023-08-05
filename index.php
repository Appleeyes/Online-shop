<?php
declare(strict_types=1);
define('BASE_URL', '/Online-shop/');

use OnlineShop\App\Router;
use OnlineShop\Controllers\HomeController;
use OnlineShop\Controllers\ProductController;


session_start();
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/config/database.php";

$router = new Router();

$router->get(path:BASE_URL, handler:HomeController::class . '::execute');
$router->get(path: BASE_URL . 'product', handler: ProductController::class . '::execute');
$router->get(path: BASE_URL . 'product/add', handler: ProductController::class . '::showAddProductForm');
$router->post(path: BASE_URL . 'product/add', handler: ProductController::class . '::addProduct');

$router->get(BASE_URL . 'about', function () {
    echo 'About Page';
});

$router->addNotFoundHandler(function () {
    require_once __DIR__ . '/src/Views/templates/404.php';
});

$router->run();




?>