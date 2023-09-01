<?php
$activePage = 'product';
require_once __DIR__ . '/../../../config/utilities.php';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';
?>

<section id="product1" class="section-p1">
    <h2>Search Results</h2>
    <div class="pro-container">
        <?php if (empty($searchResults)) : ?>
            <div style="width: 100%;" class="alert alert-danger" role="alert">
                <p style="width: 50%; margin: 0 auto;">No results found.</p>
            </div>
        <?php else : ?>
            <?php foreach ($searchResults as $product) : ?>
                <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                <div class="pro" onclick="window.location.href='product/details?id=<?php echo $product->product_id; ?>';">
                    <img src="<?php echo BASE_URL . 'public/db-img/' . basename($product->thumbnail); ?>" alt="">
                    <div class="des">

                        <span><?php echo highlightKeywords($product->category_title, $keyword); ?></span>
                        <h5><?php echo highlightKeywords($product->name, $keyword); ?></h5>
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
<style>
    .highlight {
        background-color: yellow;
        font-weight: bold;
    }
</style>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>