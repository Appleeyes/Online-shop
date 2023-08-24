<?php
$activePage = 'addCategory';
require_once __DIR__ . '/../../templates/header.php';
require_once __DIR__ . '/../../templates/navigation.php';
require_once __DIR__ . '/../../../../config/auth.php';


if (!authorizeAdmin()) {
    // User is not authorized, show an error message or redirect
    echo '<div class="alert alert-danger">You are not authorized to access this page.</div>';
} else {
?>

<div class="container my-5">
    <h1 class="my-5">ADD CATEGORY FORM</h1>
    <hr>
    <div style="display: flex; width: 80%; background-color: #e3e6f3; padding: 30px;">
        <div style="background-image: url('/Online-shop/public/images/banner/b2.jpg'); width: 40%; margin-right: 30px;">
        </div>
        <form style="width: 50%;" action="<?php echo BASE_URL; ?>admin/categories/add" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label style="font-weight: 800;" for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Category Title" required>
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="description" class="form-label">Description</label>
                <textarea class="form-control" rows="10" name="description" placeholder="Category Description" required></textarea>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button style="color: black; font-weight: 800;" class="btn btn-primary" type="submit">Create</button>
            </div>
        </form>
    </div>
    <hr>
</div>


<?php
require_once __DIR__ . '/../../templates/footer.php';
}
?>