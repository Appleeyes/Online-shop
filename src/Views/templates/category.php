<section id="category-main" class="padding-all">
    <div class="category-container">
        <?php foreach ($categories as $category) : ?>
            <a href="<?= BASE_URL ?>product/category?category_id=<?= $category->category_id ?>" class="category-button">
                <?= $category->title ?>
            </a>

        <?php endforeach; ?>
    </div>
</section>