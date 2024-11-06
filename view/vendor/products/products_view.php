<?php
$pageTitle = "Products";
require ('view/page-fragments/header.php');
?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/public/css/vendor/products.css"></link>
<script src="<?php echo BASE_URL?>/public/javascript/vendor/products.js" defer></script>
<main>
    <input type="hidden" id="products-data" value='<?php echo htmlspecialchars(json_encode($products), ENT_QUOTES); ?>'>
    <div class="main-table">
        <div class="table-header">
            <p>Product Listing</p>
            <div class="action-buttons">
                <a href="<?php echo BASE_URL; ?>/products/add-product">
                    <button class="add-button">
                        <img src="<?php echo BASE_URL; ?>/assets/icons/add-blue-outline.png" alt="Add Icon" class="add-icon">
                        Add
                    </button>
                </a>

                <form action = "<?php echo BASE_URL ?>/products" method = "GET">
                     <label>
                        <select class="category-filter" name="category" onchange="this.form.submit()">
                            <option value="" disabled selected>Category</option>
                            <option value="item">Item</option>
                            <option value="service">Service</option>
                            <option value="food">Food</option>
                        </select>
                     </label>
                </form>
            </div>
        </div>
        <div class="table-products">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- This is where the table will be populated vis products.js -->
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require 'view/page-fragments/Footer.php'?>