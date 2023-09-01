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
        <form action="<?php echo BASE_URL . 'cart/add'; ?>" method="post">
            <input type="hidden" name="product_id" value="<?php echo $productDetails->product_id; ?>">
            <select name="size">
                <option>Select Size</option>
                <option>XL</option>
                <option>XXL</option>
                <option>Small</option>
                <option>Large</option>
            </select>
            <input type="number" name="quantity" value="1">
            <button type="submit" class="normal">Add To Cart</button>
        </form>
        <h4>Product Details</h4>
        <span><?php echo $productDetails->description; ?></span>
    </div>
</section>

<!-- Display success message -->
<?php if (isset($_SESSION['success_message'])) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<div style="background-color: rgb(128, 128, 128, 0.2); padding: 15px; margin-bottom: 20px;">
    <!-- Display product details here -->
    <div style="display: flex; width: 100%; justify-content: space-around; margin-top: 20px;">
        <!-- Form to add a new review -->
        <section style="width: 40%;" id="add-review">
            <h3 style="margin-bottom: 20px; font-weight: 800;">Add Your Review</h3>
            <form action="<?= BASE_URL ?>product/review" method="post">
                <div class="mb-3">
                    <input type="hidden" name="product_id" value="<?php echo $productDetails->product_id; ?>">
                    <label for="rating" style="font-weight: 800;" class="form-label">Rating:</label>
                    <select class="form-select" id="category_id" name="rating" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="review" style="font-weight: 800;" class="form-label">Comment:</label>
                    <textarea name="review" class="form-control" rows="5" placeholder="Drop Some Review"></textarea>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button style="color: black; font-weight: 800;" class="btn btn-primary" type="submit">Submit Review</button>
                </div>
            </form>
        </section>

        <!-- Display existing reviews -->
        <section style="width: 40%;" id="product-reviews">
            <h3 style="margin-bottom: 20px; font-weight: 800;">Product Reviews</h3>
            <?php if (empty($reviews)) : ?>
                <div style="width: 100%;" class="alert alert-danger" role="alert">
                    <p style="width: 50%; margin: 0 auto;">No reviews.</p>
                </div>
            <?php else : ?>
                <?php foreach ($reviews as $review) : ?>
                    <div class="review" style="margin-bottom: 20px;">
                        <div class="user-info" style="display: flex; margin-bottom: 0;">
                            <div class="user-thumb">
                                <?php
                                $thumbnailPath = BASE_URL . 'public/db-img/' . basename($review->thumbnail); 
                                ?>
                                <a href="#"><img src="<?= $thumbnailPath ?>" alt="User Thumbnail"></a>
                            </div>
                            <div class="review-details">
                                <h6><strong><?= $review->fullname ?></strong> | <?= $review->created_at ?></h6>
                                <p>Rating: <?= $review->rating ?>/5</p>
                                <p><?= $review->review ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <a class="btn btn-primary" href="<?= BASE_URL . 'product/all-reviews?id=' . $productDetails->product_id ?>">See more reviews</a>
            <?php endif; ?>

        </section>
    </div>
</div>

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