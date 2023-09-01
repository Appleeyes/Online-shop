<?php
$activePage = 'cart';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';

?>


<section id="checkout" class="section-p1">
    <!-- Display error message -->
    <?php if (isset($_SESSION['error_message'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error_message']; ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
    <div style="display: flex; width: 100%; justify-content: space-between;">
        <div class="container" style="background-color:beige; padding: 30px; width: 60%;">
            <h2>Checkout</h2>
            <form style="width: 80%;" action="<?php echo BASE_URL; ?>cart/process-checkout" method="POST">
                <div class="payment-methods my-5">
                    <h3>Payment Method</h3>
                    <label>
                        <input type="radio" name="payment_method" value="paypal" checked>
                        PayPal
                    </label>
                </div>

                <div class="user-details">
                    <h3>User Details</h3>
                    <div class="mb-3">
                        <label style="font-weight: 800;" for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Email Address" required>
                    </div>
                    <div class="mb-3">
                        <label style="font-weight: 800;" for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email Address" required>
                    </div>
                    <div class="mb-3">
                        <label style="font-weight: 800;" for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Your Delivery Address" required>
                    </div>
                    <div class="mb-3">
                        <label style="font-weight: 800;" for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Your City" required>
                    </div>
                    <div class="mb-3">
                        <label style="font-weight: 800;" for="zip" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="Your Zip Code" required>
                    </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button style="color: black; font-weight: 800;" class="btn btn-primary" type="submit">Place Order</button>
                </div>
            </form>
        </div>
        <div class="img" style="width: 30%;">
            <img src="/Online-shop/public/images/button.png" alt="">
            <img src="/Online-shop/public/images/features/f4.png" alt="">
            <img src="/Online-shop/public/images/features/f3.png" alt="">
            <img src="/Online-shop/public/images/button.png" alt="">
            <img src="/Online-shop/public/images/button.png" alt="">
            <img src="/Online-shop/public/images/features/f6.png" alt="">
            <img src="/Online-shop/public/images/features/f5.png" alt="">
            <img src="/Online-shop/public/images/button.png" alt="">
            <img src="/Online-shop/public/images/button.png" alt="">
            <img src="/Online-shop/public/images/features/f2.png" alt="">
            <img src="/Online-shop/public/images/features/f1.png" alt="">
            <img src="/Online-shop/public/images/button.png" alt="">
            <img src="/Online-shop/public/images/button.png" alt="">
            <img src="/Online-shop/public/images/features/f3.png" alt="">
            <img src="/Online-shop/public/images/features/f4.png" alt="">
        </div>
    </div>
</section>


<?php
require_once __DIR__ . '/../templates/footer.php';
?>