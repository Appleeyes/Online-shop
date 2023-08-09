<section id="header">
    <a href="#"><img src="/Online-shop/public/images/logo.png" class="logo" alt=""></a>

    <div>
        <ul id="navbar">
            <li><a class="<?php if ($activePage === '') echo 'active'; ?>" href="<?= BASE_URL ?>">Home</a></li>
            <li><a class="<?php if ($activePage === 'product') echo 'active'; ?>" href="<?= BASE_URL ?>product">Shop</a></li>
            <li><a class="<?php if ($activePage === 'blog') echo 'active'; ?>" href="">Blog</a></li>
            <li><a class="<?php if ($activePage === 'about') echo 'active'; ?>" href="">About</a></li>
            <li><a class="<?php if ($activePage === 'contact') echo 'active'; ?>" href="">Contact</a></li>
            <li class='id="lg-ba"'><a class="<?php if ($activePage === 'cart') echo 'active'; ?>" href="<?= BASE_URL ?>cart"><i class="fa-solid fa-bag-shopping"></i></a></li>
            <a href="#" id="close"><i class="fas fa-times"></i></a>
        </ul>
    </div>

    <div id="mobile">
        <a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>