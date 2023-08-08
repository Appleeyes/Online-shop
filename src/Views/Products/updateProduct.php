<?php
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';
?>

<div class="container my-5">
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
    <h1 class="my-5">ADD NEW PRODUCT</h1>
    <hr>
    <div style="display: flex; width: 80%; background-color: #e3e6f3;; padding: 30px;">
        <div style="background-image: url('/Online-shop/public/images/banner/b18.jpg'); width: 50%; margin-right: 30px;">
        </div>
        <form style="width: 50%;" action="<?php echo BASE_URL; ?>product/update" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="hidden" name="product_id" value="<?php echo $productData->product_id; ?>">
                <input type="hidden" name="previous_thumbnail_name" value="<?php echo $productData->thumbnail; ?>">
                <label style="font-weight: 800;" for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" value="<?php echo $productData->name; ?>" required>
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Product Description" value="<?php echo $productData->description; ?>" required>
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="Product Price" value="<?php echo $productData->price; ?>" required>
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="price" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="" disabled selected>Select a category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category->category_id; ?>"><?php echo $category->title; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="price" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" required>
            </div>
            <div>
                <label style="font-weight: 800;" for="price" class="form-label">Featured</label>
            </div>
            <div class="form-check form-check-inline">
                <input style="background-color: blue;" class="form-check-input" type="radio" name="is_featured" value="0" id="is_featured" checked>
                <label class="form-check-label" for="is_featured">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input style="background-color: blue;" class="form-check-input" type="radio" name="is_featured" value="1" id="is_featured">
                <label class="form-check-label" for="is_featured">No</label>
            </div>
            <div>
                <label style="font-weight: 800;" for="price" class="form-label">New Collection</label>
            </div>
            <div class="form-check form-check-inline">
                <input style="background-color: blue;" class="form-check-input" type="radio" name="is_new" value="0" id="is_new" checked>
                <label class="form-check-label" for="is_new">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input style="background-color: blue;" class="form-check-input" type="radio" name="is_new" value="1" id="is_new">
                <label class="form-check-label" for="is_new">No</label>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button style="color: black; font-weight: 800;" class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
    <hr>
</div>


<?php
require_once __DIR__ . '/../templates/footer.php';
?>