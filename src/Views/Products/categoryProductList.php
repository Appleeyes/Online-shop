<!-- categoryProducts.php -->
<?php
$activePage = 'products'; // Set the active page if needed
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';
?>

<section id="product1" class="section-p1">
    <h2><?php echo $category->title; ?></h2>
    <div class="pro-container">
        <?php if (empty($categoryProducts)) : ?>
            <div style="width: 100%;" class="alert alert-danger" role="alert">
                <p style="width: 50%; margin: 0 auto;">No products found.</p>
            </div>
        <?php else : ?>
            <?php foreach ($categoryProducts as $product) : ?>
                <div class="pro" onclick="window.location.href='<?= BASE_URL ?>product/details?id=<?php echo $product->product_id; ?>';">
                    <img src="<?= BASE_URL . 'public/db-img/' . basename($product->thumbnail) ?>" alt="<?= $product->name ?>">
                    <div class="des">
                        <span><?php echo $category->title; ?></span>
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
        <?php endif; ?>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>