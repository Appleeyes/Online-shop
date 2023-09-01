<?php
$activePage = 'cart';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';

?>

<section style="margin: 30px auto; width: 60%;" id="success-page" class="section-p1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1>Payment Successful</h1>
                <p>Your payment has been successfully processed. Thank you for your order!</p>
                <form action="<?php echo BASE_URL . 'cart/confirm-paid'; ?>" method="POST">
                    <?php foreach ($productIds as $productId) { ?>
                        <input type="hidden" name="productIds[]" value="<?php echo $productId; ?>">
                    <?php } ?>
                    <button type="submit" class="btn btn-primary">Confirm Your Order</button>
                </form>
            </div>
        </div>
    </div>
</section>


<?php
require_once __DIR__ . '/../templates/footer.php';
?>