<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoothLink | Products</title>
    <link rel="stylesheet" href="../../../public/css/vendor/products.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon_io/site.webmanifest">
    <script src="public/javascript/vendor/products.js" defer></script>
</head>
<body>

<?php
include(__DIR__ . '/../../../view/page-fragments/header.php');
?>

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
</body>
</html>