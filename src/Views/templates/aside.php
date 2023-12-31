<aside>
    <ul>
        <li>
            <a href="<?= BASE_URL ?>product/add"><i class="fa-solid fa-pencil"></i>
                <h5>Add Product</h5>
            </a>
        </li>
        <li>
            <a class="<?php if ($activePage === 'products') echo 'active'; ?>" href="<?= BASE_URL ?>admin/products"><i class="fa-regular fa-paste"></i>
                <h5>Manage Product</h5>
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>admin/add"><i class="fa-solid fa-user-plus"></i>
                <h5>Add Admin</h5>
            </a>
        </li>
        <li>
            <a class="<?php if ($activePage === 'admin') echo 'active'; ?>" href="<?= BASE_URL ?>admin"><i class="fa-solid fa-user-group"></i>
                <h5>Manage Users</h5>
            </a>
        </li>
        <li>
            <a class="<?php if ($activePage === 'paidOrders') echo 'active'; ?>" href="<?= BASE_URL ?>admin/paidOrders"><i class="fa-regular fa-paste"></i>
                <h5>Manage Order</h5>
            </a>
        </li>
        <li>
            <a href="<?= BASE_URL ?>admin/category-form"><i class="fa-regular fa-pen-to-square"></i>
                <h5>Add Category</h5>
            </a>
        </li>
        <li>
            <a class="<?php if ($activePage === 'categories') echo 'active'; ?>" href="<?= BASE_URL ?>admin/categories"><i class="fa-solid fa-list-ul"></i>
                <h5>Manage Category</h5>
            </a>
        </li>
    </ul>
</aside>