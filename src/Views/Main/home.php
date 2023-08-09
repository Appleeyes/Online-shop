<?php
$activePage = '';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<section id="hero">
    <h4>Trade-in-offer</h4>
    <h2>Super value deals</h2>
    <h1>On all products</h1>
    <p>Save more with coupons & up to 70% off!</p>
    <button>Shop Now</button>
</section>

<section id="feature" class="section-p1">
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f1.png" alt="">
        <h6>Free Shipping</h6>
    </div>
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f2.png" alt="">
        <h6>Online Order</h6>
    </div>
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f3.png" alt="">
        <h6>Save Money</h6>
    </div>
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f4.png" alt="">
        <h6>Promotions</h6>
    </div>
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f5.png" alt="">
        <h6>Happy Shell</h6>
    </div>
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f6.png" alt="">
        <h6>F24/7 Support</h6>
    </div>
</section>

<section id="product1" class="section-p1">
    <h2>Featured products</h2>
    <p>Summer Collection New Morden Design</p>
    <div class="pro-container">
        <?php foreach ($featuredProducts as $product) : ?>
            <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
            <div class="pro" onclick="window.location.href='product/details?id=<?php echo $product->product_id; ?>';">
                <img src="<?php echo BASE_URL . 'public/db-img/' . basename($product->thumbnail); ?>" alt="">
                <div class="des">
                    <span><?php echo $product->category_title; ?></span>
                    <h5><?php echo $product->name; ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$<?php echo $product->price; ?></h4>
                </div>
                <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="banner" class="section-m1">
    <h4>Repair Services</h4>
    <h2>Up to <span>75% Off</span> - All t-Shirts & Accessories</h2>
    <button class="normal">Explore More</button>
</section>

<section id="product1" class="section-p1">
    <h2>New Arrivals</h2>
    <p>Summer Collection New Morden Design</p>
    <div class="pro-container">
        <?php foreach ($newProducts as $products) : ?>
            <input type="hidden" name="product_id" value="<?php echo $products->product_id; ?>">
            <div class="pro" onclick="window.location.href='product/details?id=<?php echo $products->product_id; ?>';">
                <img src="<?php echo BASE_URL . 'public/db-img/' . basename($products->thumbnail); ?>" alt="">
                <div class="des">
                    <span><?php echo $products->category_title; ?></span>
                    <h5><?php echo $products->name; ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$<?php echo $products->price; ?></h4>
                </div>
                <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="sm-banner" class="section-p1">
    <div class="banner-box">
        <h4>crazy deals</h4>
        <h2>buy 1 get 1 free</h2>
        <span>The best classic dress is on sale at cara</span>
        <button class="white">Learn More</button>
    </div>
    <div class="banner-box banner-box2">
        <h4>spring/summer</h4>
        <h2>upcoming seasons</h2>
        <span>The best classic dress is on sale at cara</span>
        <button class="white">Collection</button>
    </div>
</section>

<section id="banner3">
    <div class="banner-box">
        <h2>SEASONAL SALE</h2>
        <h3>Winter Collection -50% OFF</h3>
    </div>
    <div class="banner-box banner-box2">
        <h2>NEW FOOTWEAR COLLECTION</h2>
        <h3>Spring / Summer 2022</h3>
    </div>
    <div class="banner-box banner-box3">
        <h2>T_SHIRTS</h2>
        <h3>New Trendy Prints</h3>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/newsletter.php';
require_once __DIR__ . '/../templates/footer.php';
?>