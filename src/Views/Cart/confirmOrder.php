<?php
$activePage = 'cart';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';



error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}
?>

<section id="success-page" class="section-p1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1>ORDER CONFIRMATION</h1>
                <p>Your order has been confirmed and being processed. Keep eye on your mail for order status!</p>
            </div>
        </div>
    </div>
</section>


<?php
require_once __DIR__ . '/../templates/footer.php';
?>