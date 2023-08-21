<?php
$activePage = 'paidOrders';

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
            <h2>Paid Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Thumbnail</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paidOrders as $orders) : ?>
                        <tr>
                            <td><?= $orders->name ?></td>
                            <td><img src="<?= BASE_URL . 'public/db-img/' . basename($orders->thumbnail) ?>" alt="<?= $orders->name ?>"></td>
                            <td><?= $orders->size ?></td>
                            <td>$<?= $orders->price ?></td>
                            <td><?= $orders->quantity ?></td>
                            <td>$<?= $orders->subtotal ?></td>
                            <td><a href="<?= BASE_URL ?>admin/delete-user.php?Id=<?= $user['Id'] ?>" class="btnn danger">Delete</a></td>
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