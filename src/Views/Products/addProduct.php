<?php
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';
?>

<div class="container my-5">
    <h1 class="my-5">ADD NEW PRODUCT</h1>
    <hr>
    <div style="background-image: url('/Online-shop/public/images/banner/b18.jpg'); padding: 30px; width: 80%;">
        <form action="">
            <div class="mb-3">
                <label style="font-weight: 800;" for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Product Name">
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" placeholder="Product Description">
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" placeholder="Product Price">
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="price" class="form-label">Category</label>
                <select class="form-select" id="categories">
                    <option selected>Choose Category</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="mb-3">
                <label style="font-weight: 800;" for="price" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="inputGroupFile01">
            </div>
            <div>
                <label style="font-weight: 800;" for="price" class="form-label">Featured</label>
            </div>
            <div class="form-check form-check-inline">
                <input style="background-color: blue;" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                <label class="form-check-label" for="exampleRadios1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input style="background-color: blue;" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                <label class="form-check-label" for="exampleRadios1">No</label>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button style="color: black; font-weight: 800;" class="btn btn-primary" type="button">Submit</button>
            </div>
        </form>
    </div>
    <hr>
</div>


<?php
require_once __DIR__ . '/../templates/footer.php';
?>