<?php
require_once __DIR__ . '/../../templates/header.php';
require_once __DIR__ . '/../../templates/navigation.php';

// get back form data incase of error while filing the form
$email = $_SESSION['login-data']['email'] ?? null;
$password = $_SESSION['login-data']['password'] ?? null;

// delete session data
unset($_SESSION['login-data']);
?>

<div class="container my-5">
    <!-- Display error message -->
    <?php if (isset($_SESSION['error_message'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error_message']; ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
    <h1 class="my-5">LOGIN FORM</h1>
    <hr>
    <div style="display: flex; width: 80%; background-color: #e3e6f3; padding: 30px;">
        <div style="background-image: url('/Online-shop/public/images/banner/b2.jpg'); width: 40%; margin-right: 30px;">
        </div>
        <form style="width: 50%;" action="<?php echo BASE_URL; ?>login/add" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label style="font-weight: 800;" for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" placeholder="Your Email Address" required>
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?= $password ?>" placeholder="Your Password" required>
                <label style="display: inline-flex; align-items: center; font-size: 13px;">
                    <input type="checkbox" id="showPassword" style="margin-right: 5px; transform: scale(0.7);"> Show Password
                </label>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button style="color: black; font-weight: 800;" class="btn btn-primary" type="submit">Log In</button>
            </div>
            <strong style="font-size: 12px;">You don't have an account yet? <a style="text-decoration: none;" href="<?php echo BASE_URL; ?>register">Register.</a></strong>
        </form>
    </div>
    <hr>
</div>

<?php
require_once __DIR__ . '/../../templates/footer.php';
?>