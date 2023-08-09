<?php
$activePage = 'product';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';
?>

<section id="prodetails" class="section-p1">
    <div class="single-pro-image">
        <img src="<?php echo BASE_URL . 'public/db-img/' . basename($productDetails->thumbnail); ?>" width="100%" id="MainImg" alt="">
        <div class="small-img-group">
            <div class="small-img-col">
                <img src="<?php echo BASE_URL . 'public/db-img/' . basename($productDetails->thumbnail); ?>" width="100%" class="small-img" alt="">
            </div>
            <div class=" small-img-col">
                <img src="<?php echo BASE_URL . 'public/db-img/' . basename($productDetails->thumbnail); ?>" width="100%" class="small-img" alt="" style="filter: hue-rotate(60deg);">
            </div>
            <div class=" small-img-col">
                <img src="<?php echo BASE_URL . 'public/db-img/' . basename($productDetails->thumbnail); ?>" width="100%" class="small-img" alt="" style="filter: hue-rotate(150deg);">
            </div>
            <div class=" small-img-col">
                <img src="<?php echo BASE_URL . 'public/db-img/' . basename($productDetails->thumbnail); ?>" width="100%" class="small-img" alt="" style="filter: hue-rotate(200deg);">
            </div>
        </div>
    </div>

    <div class=" single-pro-details">
        <h6><?php echo $productDetails->category_title; ?></h6>
        <h4><?php echo $productDetails->name; ?></h4>
        <h2>$<?php echo $productDetails->price; ?></h2>
        <select>
            <option>Select Size</option>
            <option>XL</option>
            <option>XXL</option>
            <option>Small</option>
            <option>Large</option>
        </select>
        <input type="number" value="1">
        <button class="normal">Add To Cart</button>
        <h4>Product Details</h4>
        <span><?php echo $productDetails->description; ?></span>
    </div>
</section>

<section id="product1" class="section-p1">
    <h2>Featured products</h2>
    <p>Summer Collection New Morden Design</p>
    <div class="pro-container">
        <?php foreach ($featuredProducts as $product) : ?>
            <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
            <div class="pro" onclick="window.location.href='/Online-shop/product/details?id=<?php echo $product->product_id; ?>';">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImg = document.getElementById('MainImg');
        const smallImgs = document.querySelectorAll('.small-img');

        smallImgs.forEach(smallImg => {
            smallImg.addEventListener('click', () => {
                mainImg.src = smallImg.src;
            });
        });
    });
</script>



<?php
require_once __DIR__ . '/../templates/newsletter.php';
require_once __DIR__ . '/../templates/footer.php';
?>