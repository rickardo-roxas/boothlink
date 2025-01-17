<?php
$pageTitle = "Products";
require('view/page-fragments/Header.php');
?>
    <link rel="stylesheet" href="/public/css/add_edit_products.css">
    <link rel="stylesheet" href="/public/css/products.css">
    <script src="/public/js/products.js" defer></script>
    <main>
        <input type="hidden" id="products-data" value='<?php echo htmlspecialchars(json_encode($products), ENT_QUOTES); ?>'>
        <div class="main-table">
            <div class="table-header">
                <div class="heading-container">
                    <img id="shopping-cart" src="/shared/assets/icons/shopping-cart.png" alt="shopping cart">
                    <h2>Product/Service Listing</h2>
                </div>
                <div class="action-buttons">
                    <a href="/products/add-product">
                        <button class="add-button">
                            <img src="/shared/assets/icons/add-blue-outline.png" alt="Add Icon" class="add-icon">
                            Add
                        </button>
                    </a>

                    <form action = "/products" method = "GET">
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

<?php require('view/page-fragments/Footer.php'); ?>
