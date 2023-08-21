<?php

use OnlineShop\Models\Cart;

$cartModel = new Cart();
$cartCount = 0; // Default value

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the cart count for the logged-in user
    $cartCount = $cartModel->getCartCount($_SESSION['user_id']);
}
?>

<section id="header">
    <a href="#"><img src="/Online-shop/public/images/logo.png" class="logo" alt=""></a>

    <div>
        <ul id="navbar">
            <li><a class="<?php if ($activePage === '') echo 'active'; ?>" href="<?= BASE_URL ?>">Home</a></li>
            <li><a class="<?php if ($activePage === 'product') echo 'active'; ?>" href="<?= BASE_URL ?>product">Shop</a></li>
            <li><a class="<?php if ($activePage === 'about') echo 'active'; ?>" href="">About</a></li>
            <li><a class="<?php if ($activePage === 'contact') echo 'active'; ?>" href="">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role']) : ?>
                    <!-- User is an admin -->
                    <?php if ($activePage === 'admin' || $activePage === 'paidOrders' || $activePage === 'addAdmin' || $activePage === 'categories'|| $activePage === 'addCategory'|| $activePage === 'updateCategory') : ?>
                        <li><a href="<?= BASE_URL ?>logout">Logout</a></li>
                        <div class="user-thumb">
                            <?php
                            $thumbnailPath = BASE_URL . 'public/db-img/' . basename($_SESSION['user_thumbnail']);
                            ?>
                            <a href="#"><img src="<?= $thumbnailPath ?>" alt="User Thumbnail"></a>
                        </div>
                        <a href="#" id="close"><i class="fas fa-times"></i></a>
                    <?php else : ?>
                        <li><a href="<?= BASE_URL ?>admin">Admin</a></li>
                        <div class="user-thumb">
                            <?php
                            $thumbnailPath = BASE_URL . 'public/db-img/' . basename($_SESSION['user_thumbnail']);
                            ?>
                            <a href="#"><img src="<?= $thumbnailPath ?>" alt="User Thumbnail"></a>
                        </div>
                        <a href="#" id="close"><i class="fas fa-times"></i></a>
                    <?php endif; ?>
                <?php else : ?>
                    <li><a href="<?= BASE_URL ?>logout">Logout</a></li>
                        <div class="user-thumb">
                            <?php
                            $thumbnailPath = BASE_URL . 'public/db-img/' . basename($_SESSION['user_thumbnail']);
                            ?>
                            <a href="#"><img src="<?= $thumbnailPath ?>" alt="User Thumbnail"></a>
                        </div>
                        <a href="#" id="close"><i class="fas fa-times"></i></a>
                <?php endif; ?>
            <?php else : ?>
                <!-- User is not logged in -->
                <li><a href="<?= BASE_URL ?>login">Log-In</a></li>
                <li><a href="<?= BASE_URL ?>register">Register</a></li>
                <a href="#" id="close"><i class="fas fa-times"></i></a>
            <?php endif; ?>

            <li id="lg-bag">
                <a class="<?php if ($activePage === 'cart') echo 'active'; ?>" href="<?php echo isset($_SESSION['user_id']) ? BASE_URL . 'cart' : BASE_URL . 'login'; ?>"><i class="fa-solid fa-bag-shopping"></i>
                    <?php echo $cartCount; ?>
                </a>
            </li>
        </ul>
    </div>

    <div id="mobile">
        <a class="<?php if ($activePage === 'cart') echo 'active'; ?>" href="<?php echo isset($_SESSION['user_id']) ? BASE_URL . 'cart' : BASE_URL . 'login'; ?>"><i class="fa-solid fa-bag-shopping"></i>
            <?php echo $cartCount; ?>
        </a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>