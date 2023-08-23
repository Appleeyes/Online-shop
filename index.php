<?php
declare(strict_types=1);
define('BASE_URL', '/Online-shop/');

use OnlineShop\App\Router;
use OnlineShop\Controllers\HomeController;
use OnlineShop\Controllers\ProductController;
use OnlineShop\Controllers\CartController;
use OnlineShop\Controllers\UserController;
use OnlineShop\Controllers\OrderController;
use OnlineShop\Controllers\AdminController;


session_start();
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/config/database.php";

$router = new Router();

$router->get(path: BASE_URL, handler:HomeController::class . '::execute');
$router->get(path: BASE_URL . 'product', handler: ProductController::class . '::execute');
$router->get(path: BASE_URL . 'product/add', handler: ProductController::class . '::showAddProductForm');
$router->post(path: BASE_URL . 'product/add', handler: ProductController::class . '::addProduct');
$router->get(path: BASE_URL . 'product/update', handler: ProductController::class . '::showUpdateProductForm');
$router->post(path: BASE_URL . 'product/update', handler: ProductController::class . '::UpdateProduct');
$router->get(path: BASE_URL . 'product/details', handler: ProductController::class . '::showProductDetails');
$router->get(path: BASE_URL . 'product/search', handler: ProductController::class. '::userSearch');
$router->get(path: BASE_URL . 'product/category', handler: ProductController::class . '::showCategoryProduct');
$router->get(path: BASE_URL . 'register', handler: UserController::class . '::showUserRegisterForm');
$router->post(path: BASE_URL . 'register/add', handler: UserController::class . '::registerUser');
$router->get(path: BASE_URL . 'login', handler: UserController::class . '::showUserLoginForm');
$router->get(path: BASE_URL . 'logout', handler: UserController::class . '::logoutUser');
$router->post(path: BASE_URL . 'login/add', handler: UserController::class . '::loginUser');
$router->get(path: BASE_URL . 'cart', handler: CartController::class . '::execute');
$router->post(path: BASE_URL . 'cart/add', handler: CartController::class . '::addProductToCart');
$router->get(path: BASE_URL . 'cart/remove', handler: CartController::class . '::removeCartItem');
$router->get(path: BASE_URL . 'cart/checkout', handler: CartController::class . '::showCheckoutpage');
$router->post(path: BASE_URL . 'cart/process-checkout', handler: CartController::class . '::processCheckout');
$router->get(path: BASE_URL . 'cart/success', handler: OrderController::class . '::showSuccessPage');
$router->get(path: BASE_URL . 'cart/confirm-page', handler: OrderController::class . '::showConfirmPage');
$router->post(path: BASE_URL . 'cart/confirm-paid', handler: OrderController::class . '::confirmPaid');
$router->get(path: BASE_URL . 'admin', handler: AdminController::class . '::execute');
$router->get(path: BASE_URL . 'admin/add', handler: AdminController::class . '::showAddAdminForm');
$router->post(path: BASE_URL . 'admin/addAdmin', handler: AdminController::class . '::addAdmin');
$router->get(path: BASE_URL . 'admin/paidOrders', handler: AdminController::class . '::showPaidOrders');
$router->get(path: BASE_URL . 'admin/remove', handler: AdminController::class . '::removeUsers');
$router->get(path: BASE_URL . 'admin/categories', handler: AdminController::class . '::showCategories');
$router->get(path: BASE_URL . 'admin/category-form', handler: AdminController::class . '::showCategoryForm');
$router->post(path: BASE_URL . 'admin/categories/add', handler: AdminController::class . '::addCategories');
$router->get(path: BASE_URL . 'admin/categories/update', handler: AdminController::class . '::showUpdateCategoryForm');
$router->post(path: BASE_URL . 'admin/categories/update', handler: AdminController::class . '::updateCategories');
$router->get(path: BASE_URL . 'admin/categories/remove', handler: AdminController::class . '::removeCategories');
$router->get(path: BASE_URL . 'admin/products', handler: AdminController::class . '::showProductTable');
$router->get(path: BASE_URL . 'admin/products/remove', handler: AdminController::class . '::removeProducts');
$router->get(path: BASE_URL . 'admin/products/search', handler: AdminController::class . '::adminSearch');












$router->get(BASE_URL . 'about', function () {
    echo 'About Page';
});

$router->addNotFoundHandler(function () {
    require_once __DIR__ . '/src/Views/templates/404.php';
});

$router->run();




?>