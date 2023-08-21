<?php
$activePage = 'addAdmin';
require_once __DIR__ . '/../../templates/header.php';
require_once __DIR__ . '/../../templates/navigation.php';

// get back form data incase of error while filing the form
$fullname = $_SESSION['user-data']['fullname'] ?? null;
$email = $_SESSION['user-data']['email'] ?? null;
$password = $_SESSION['user-data']['password'] ?? null;
$confirm_password = $_SESSION['user-data']['confirm_password'] ?? null;

// delete session data
unset($_SESSION['user-data']);
?>

<div class="container my-5">
    <!-- Display error message -->
    <?php if (isset($_SESSION['error_message'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error_message']; ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
    <h1 class="my-5">REGISTER FORM</h1>
    <hr>
    <div style="display: flex; width: 80%; background-color: #e3e6f3; padding: 30px;">
        <div style="background-image: url('/Online-shop/public/images/banner/b2.jpg'); width: 40%; margin-right: 30px;">
        </div>
        <form style="width: 50%;" action="<?php echo BASE_URL; ?>admin/addAdmin" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label style="font-weight: 800;" for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $fullname ?>" placeholder="Your Full Name" required>
            </div>
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
            <div class="mb-3">
                <label style="font-weight: 800;" for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?= $confirm_password ?>" placeholder="Confirm Your Password" required>
                <label style="display: inline-flex; align-items: center; font-size: 13px;">
                    <input type="checkbox" id="showPassword1" style="margin-right: 5px; transform: scale(0.7);"> Show Password
                </label>
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="password" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" required>
            </div>
            <div class="form-check form-check-inline">
                <input style="background-color: blue;" class="form-check-input" type="radio" name="is_admin" value="1" id="is_admin" checked>
                <label class="form-check-label" for="is_admin">Yes</label>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button style="color: black; font-weight: 800;" class="btn btn-primary" type="submit">Register</button>
            </div>
            <strong style="font-size: 12px;">Already have an account? <a style="text-decoration: none;" href="<?php echo BASE_URL; ?>login">Log In.</a></strong>
        </form>
    </div>
    <hr>
</div>


<?php
require_once __DIR__ . '/../../templates/footer.php';
?>