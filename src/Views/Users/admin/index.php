<?php
$activePage = 'admin';
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
            <h2>Manage Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><a href="" class="btnn">Edit</a></td>
                        <td><a href="" class="btnn danger">Delete</a></td>
                    </tr>
                </tbody>
            </table>
            <div class="alert-message error"><?= "No Posts Found" ?></div>
        </main>
    </div>
</section>

<?php
require_once __DIR__ . '/../../templates/footer.php';
?>