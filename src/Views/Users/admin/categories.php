<?php
$activePage = 'categories';
require_once __DIR__ . '/../../templates/header.php';
require_once __DIR__ . '/../../templates/navigation.php';
require_once __DIR__ . '/../../../../config/auth.php';


if (!authorizeAdmin()) {
    // User is not authorized, show an error message or redirect
    echo '<div class="alert alert-danger">You are not authorized to access this page.</div>';
} else {
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
                <h2>Manage Categories</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category) : ?>
                            <tr>
                                <td><?= $category->category_id ?></td>
                                <td><?= $category->title ?></td>
                                <td><?= $category->description ?></td>
                                <td><a href="<?= BASE_URL ?>admin/categories/update?id=<?= $category->category_id ?>" class=" btnn">Edit</a></td>
                                <td><a href="<?= BASE_URL . 'admin/categories/remove?category_id=' . $category->category_id ?>" class="btnn danger">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </section>

<?php
    require_once __DIR__ . '/../../templates/footer.php';
}
?>