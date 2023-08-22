<?php
$activePage = 'products';

require_once __DIR__ . '/../../templates/header.php';
require_once __DIR__ . '/../../templates/navigation.php';

?>

<section id="dashboard" class="padding-all">
    <!-- Display success message -->
    <?php if (isset($_SESSION['success_message'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success_message']; ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <!-- Display error message -->
    <?php if (isset($_SESSION['error_message'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error_message']; ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <div class="dashboard-container">
        <?php require_once __DIR__ . '/../../templates/aside.php'; ?>
        <main>
            <h2>List Of Products</h2>
            <section id="search-bar" class="padding-all" style="margin-bottom: 50px; margin-top: 0;">
                <form class="search-container" action="<?= BASE_URL ?>admin/products/search" method="GET">
                    <div>
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="search" name="search" placeholder="Search" />
                    </div>
                    <button type="submit" name="submit" class="btnn">Go</button>
                </form>
            </section>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Thumbnail</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th>New</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productData as $product) : ?>
                        <tr>
                            <td><?= $product->product_id ?></td>
                            <td><?= $product->name ?></td>
                            <td><img src="<?= BASE_URL . 'public/db-img/' . basename($product->thumbnail) ?>" alt="<?= $product->name ?>"></td>
                            <td>$<?= $product->price ?></td>
                            <td><?= $product->category_title ?></td>
                            <td><?= ($product->is_featured == 0) ? 'Yes' : 'No' ?></td>
                            <td><?= ($product->is_new == 0) ? 'Yes' : 'No' ?></td>
                            <td><a href="<?= BASE_URL ?>product/update?id=<?= $product->product_id ?>" class=" btnn">Edit</a></td>
                            <td><a class="btnn danger" href="<?= BASE_URL . 'admin/products/remove?product_id=' . $product->product_id ?>">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</section>

<?php
require_once __DIR__ . '/../../templates/footer.php';
?>