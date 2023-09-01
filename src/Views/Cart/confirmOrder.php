<?php
$activePage = 'cart';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';


if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}
?>

<section style="margin: 30px auto; width: 60%;" id="success-page" class="section-p1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1>ORDER CONFIRMATION</h1>
                <p>Your order has been confirmed and being processed. Keep an eye on your mail for order status!</p>
            </div>
            <a class="btn btn-primary" href="<?= BASE_URL ?>product">Back To Shopping</a>
        </div>
    </div>
</section>


<?php
require_once __DIR__ . '/../templates/footer.php';
?>