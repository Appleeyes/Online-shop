<?php
require_once __DIR__ . '/../templates/header.php';
// require_once __DIR__ . '/../templates/navigation.php';

?>

<div class="container my-5">
    <h1 class="my-5">ADD NEW PRODUCT</h1>
    <hr>
    <div style="display: flex; width: 80%; background-color: #e3e6f3;; padding: 30px;">
        <div style="background-image: url('/Online-shop/public/images/banner/b18.jpg'); width: 50%; margin-right: 30px;">
        </div>
        <form style="width: 50%;" action="<?php echo BASE_URL; ?>product/add" method="POST">
            <div class="mb-3">
                <label style="font-weight: 800;" for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Product Description">
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="Product Price">
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="price" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="" disabled selected>Select a category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category->category_id; ?>"><?php echo $category->title; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="price" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
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
            <div class="d-grid gap-2 col-6 mx-auto">
                <button style="color: black; font-weight: 800;" class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
    <hr>
</div>


<?php
require_once __DIR__ . '/../templates/footer.php';
?>