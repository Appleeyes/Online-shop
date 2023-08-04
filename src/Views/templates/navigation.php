<section id="header">
    <a href="#"><img src="/Online-shop/public/images/logo.png" class="logo" alt=""></a>

    <div>
        <ul id="navbar">
            <li><a class="<?php if ($activePage === '') echo 'active'; ?>" href="<?= BASE_URL ?>">Home</a></li>
            <li><a class="<?php if ($activePage === 'product') echo 'active'; ?>" href="product">Shop</a></li>
            <li><a class="<?php if ($activePage === 'product') echo 'active'; ?>" href="blog.html">Blog</a></li>
            <li><a class="<?php if ($activePage === 'product') echo 'active'; ?>" href="about.html">About</a></li>
            <li><a class="<?php if ($activePage === 'product') echo 'active'; ?>" href="contact.html">Contact</a></li>
            <li class="<?php if ($activePage === 'product') echo 'active'; ?>" id="lg-ba"><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
            <a href="#" id="close"><i class="fas fa-times"></i></a>
        </ul>
    </div>

    <div id="mobile">
        <a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>