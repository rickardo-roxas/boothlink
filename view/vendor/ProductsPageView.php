<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoothLink | Products</title>
    <link rel="stylesheet" href="../../public/css/vendor/products.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>
<body>

    <?php
    include (__DIR__.'/page-fragments/Header.php');
    ?>

   
    <main>
        <div class="main-table">
            <div class="table-header">
                <p>Product Listing</p>
                
                <div class="action-buttons">
                <a href="EditProduct.php">
                        <button class="edit-button">
                            <img src="../../assets/icons/edit-blue-fill.png" alt="Edit Icon" class="edit-icon">
                            Edit
                        </button>
                    </a>
                    <a href="AddNewProduct.php">
                        <button class="add-button">
                            <img src="../../assets/icons/add-blue-outline.png" alt="Add Icon" class="add-icon">
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
                    <?php 
                    $products = unserialize($_GET['products']);
                    if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['prod_serv_name']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><?php echo $product['description']; ?></td>
                                <td><?php echo $product['status'];?></td>
                                <td><?php echo $product['category']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No products available</td>
                        </tr>
                    <?php endif; ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>