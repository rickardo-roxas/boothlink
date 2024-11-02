<?php include ('view/page-fragments/header.php'); ?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/public/css/vendor/products.css"</link>
<script src="<?php echo BASE_URL?>/public/javascript/vendor/products.js" defer></script>
<main>
    <div class="main-table">
        <div class="table-header">
            <p>Product Listing</p>
            <div class="action-buttons">
                <a href="add_product.php">
                    <button class="add-button">
                        <img src="../../../assets/icons/add-blue-outline.png" alt="Add Icon" class="add-icon">
                        Add
                    </button>
                </a>
                <select class="category-filter">
                    <option value="">Category</option>
                    <option value="Item">Item</option>
                    <option value="Service">Service</option>
                    <option value="Food">Food</option>
                </select>
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