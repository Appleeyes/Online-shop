<?php
$activePage = 'product';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';
?>

<!-- Display existing reviews -->
<section style="margin: 30px;" id="product-reviews">
    <h3 style="margin: 30px; font-weight: 800;">Product Reviews</h3>
    <?php if (empty($reviewPage)) : ?>
        <div style="width: 100%;" class="alert alert-danger" role="alert">
            <p style="width: 50%; margin: 0 auto;">No reviews.</p>
        </div>
    <?php else : ?>
        <?php foreach ($reviewPage as $review) : ?>
            <div class="review" style="margin-bottom: 20px;">
                <div class="user-info" style="display: flex; margin-bottom: 0;">
                    <div class="user-thumb">
                        <?php
                        $thumbnailPath = BASE_URL . 'public/db-img/' . basename($_SESSION['user_thumbnail']);
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
    <?php endif; ?>
</section>

<?php
require_once __DIR__ . '/../templates/newsletter.php';
require_once __DIR__ . '/../templates/footer.php';
?>