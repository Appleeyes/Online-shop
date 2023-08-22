<?php
$activePage = 'search';
require_once __DIR__ . '/../../../../config/utilities.php';
require_once __DIR__ . '/../../templates/header.php';
require_once __DIR__ . '/../../templates/navigation.php';
?>

<section id="dashboard" class="padding-all">
    <!-- Display success message and error message here -->
    <!-- ... -->

    <div class="dashboard-container">
        <?php require_once __DIR__ . '/../../templates/aside.php'; ?>
        <main>
            <?php if (!empty($searchResults)) : ?>
                <h2>Search Results</h2>
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
                        <?php foreach ($searchResults as $product) : ?>
                            <tr>
                                <td><?= $product->product_id ?></td>
                                <td><?= highlightKeywords($product->name, $keyword) ?></td>
                                <td><img src="<?= BASE_URL . 'public/db-img/' . basename($product->thumbnail) ?>" alt="<?= $product->name ?>"></td>
                                <td>$<?= $product->price ?></td>
                                <td><?= highlightKeywords($product->category_title, $keyword) ?></td>
                                <td><?= ($product->is_featured == 0) ? 'Yes' : 'No' ?></td>
                                <td><?= ($product->is_new == 0) ? 'Yes' : 'No' ?></td>
                                <td><a href="<?= BASE_URL ?>product/update?id=<?= $product->product_id ?>" class=" btnn">Edit</a></td>
                                <td><a class="btnn danger" href="<?= BASE_URL . 'admin/products/remove?product_id=' . $product->product_id ?>">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h1>No result found</h1>
            <?php endif; ?>
        </main>
    </div>
</section>
<style>
    .highlight {
        background-color: yellow;
        font-weight: bold;
    }
</style>
<?php
require_once __DIR__ . '/../../templates/footer.php';
?>