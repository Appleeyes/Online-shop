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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Thumbnail</th>
                        <th>Admin</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Users as $user) : ?>
                        <tr>
                            <td><?= $user->fullname ?></td>
                            <td><?= $user->email ?></td>
                            <td><img src="<?= BASE_URL . 'public/db-img/' . basename($user->thumbnail) ?>" alt="<?= $user->name ?>"></td>
                            <td><?= ($user->is_admin == 1) ? 'Yes' : 'No' ?></td>
                            <td><a class="btnn danger" href="<?= BASE_URL . 'admin/remove?user_id=' . $user->user_id ?>"><i class="far fa-times-circle"></i></a></td>
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