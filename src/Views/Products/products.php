<?php
$activePage = 'product';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';
?>

<section id="page-header">
    <h2>#stayhome</h2>
    <p>Save more with coupons & up to 70% off!</p>
</section>

<section id="product1" class="section-p1">
    <!-- Display success message -->
    <?php if (isset($_SESSION['success_message'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success_message']; ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    <div style="background-color: rgb(128, 128, 128, 0.2); padding: 15px; margin-bottom: 20px;">
        <div>
            <section id="search-bar" class="padding-all" style="margin-bottom: 50px; margin-top: 0;">
                <form class="search-container" action="<?= BASE_URL ?>product/search" method="GET">
                    <div>
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="search" name="search" placeholder="Search" />
                    </div>
                    <button type="submit" name="submit" class="btnn">Go</button>
                </form>
            </section>
        </div>
    </div>

    <?php require_once __DIR__ . '/../templates/category.php'; ?>

    <div class="pro-container">
        <?php foreach ($products as $product) : ?>
            <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
            <div class="pro" onclick="window.location.href='<?= BASE_URL ?>product/details?id=<?php echo $product->product_id; ?>';">
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


<section id="pagination" class="section-p1">
    <?php
    $visiblePages = 3;
    $startPage = max(1, $currentPage - 1);
    $endPage = min($totalPages, $startPage + $visiblePages - 1);

    if ($currentPage > 1) {
        echo '<a href="' . BASE_URL . 'product?page=' . ($currentPage - 1) . '"><i class="fa-solid fa-caret-left"></i></a>';
    }

    for ($i = $startPage; $i <= $endPage; $i++) {
        $activeClass = $i === $currentPage ? 'active' : '';
        echo '<a class="' . $activeClass . '" href="' . BASE_URL . 'product?page=' . $i . '">' . $i . '</a>';
    }

    if ($currentPage < $totalPages) {
        echo '<a href="' . BASE_URL . 'product?page=' . ($currentPage + 1) . '"><i class="fa-solid fa-caret-right"></i></i></a>';
    }
    ?>
</section>

<?php
require_once __DIR__ . '/../templates/newsletter.php';
require_once __DIR__ . '/../templates/footer.php';
?>