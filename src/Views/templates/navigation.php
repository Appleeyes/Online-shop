<section id="header">
    <a href="#"><img src="/Online-shop/public/images/logo.png" class="logo" alt=""></a>

    <div>
        <ul id="navbar">
            <li><a class="<?php if ($activePage === '') echo 'active'; ?>" href="<?= BASE_URL ?>">Home</a></li>
            <li><a class="<?php if ($activePage === 'product') echo 'active'; ?>" href="<?= BASE_URL ?>product">Shop</a></li>
            <li><a class="<?php if ($activePage === 'about') echo 'active'; ?>" href="">About</a></li>
            <li><a class="<?php if ($activePage === 'contact') echo 'active'; ?>" href="">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <!-- User is logged in -->
                <li><a href="<?= BASE_URL ?>logout">Logout</a></li>
                <div class="user-thumb">
                    <?php
                    $thumbnailPath = BASE_URL . 'public/db-img/' . basename($_SESSION['user_thumbnail']);
                    ?>
                    <a href="#"><img src="<?= $thumbnailPath ?>" alt="User Thumbnail"></a>
                </div>
                <a href="#" id="close"><i class="fas fa-times"></i></a>
            <?php else : ?>
                <!-- User is not logged in -->
                <li><a href="<?= BASE_URL ?>login">Log-In</a></li>
                <li><a href="<?= BASE_URL ?>register">Register</a></li>
                <a href="#" id="close"><i class="fas fa-times"></i></a>
            <?php endif; ?>
            <li class='id="lg-ba"'><a class="<?php if ($activePage === 'cart') echo 'active'; ?>" href="<?php echo isset($_SESSION['user_id']) ? BASE_URL . 'cart' : BASE_URL . 'login'; ?>"><i class="fa-solid fa-bag-shopping"></i></a></li>
        </ul>
    </div>

    <div id="mobile">
        <a href="<?= BASE_URL ?>cart"><i class="fa-solid fa-bag-shopping"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>