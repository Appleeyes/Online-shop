<?php
$activePage = 'cart';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>



<section id="page-header" class="about-header">
    <h2>#let's_talk</h2>
    <p>LEAVE A MESSAGE, We love to hear from you!</p>
</section>

<section id="cart" class="section-p1">
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
    <table width="100%">
        <thead>
            <tr>
                <td>Remove</td>
                <td>Image</td>
                <td>Product</td>
                <td>Size</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item) : ?>
                <tr>
                    <td><a href="<?= BASE_URL . 'cart/remove?cart_id=' . $item->cart_id ?>"><i class="far fa-times-circle"></i></a></td>
                    <td><img src="<?= BASE_URL . 'public/db-img/' . basename($item->thumbnail) ?>" alt="<?= $item->name ?>"></td>
                    <td><?= $item->name ?></td>
                    <td><?= $item->size ?></td>
                    <td>$<?= $item->price ?></td>
                    <td><input type="number" value="<?= $item->quantity ?>"></td>
                    <td>$<?= $item->subtotal ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<section id="cart-add" class="section-p1">
    <div id="coupon">
        <h3>Apply Coupon</h3>
        <div>
            <input type="text" placeholder="Enter Your Coupon">
            <button class="normal">Apply</button>
        </div>
    </div>

    <div id="subtotal">
        <h3>Cart Totals</h3>
        <table>
            <tr>
                <td>Cart Subtotal</td>
                <td>$<?php echo $totalAmount; ?></td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>Free</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong>$<?php echo $totalAmount; ?></strong></td>
            </tr>
        </table>
        <form action="<?php echo BASE_URL . 'cart/checkout'; ?>">
            <button type="submit" class="normal">Proceed to checkout</button>
        </form>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>