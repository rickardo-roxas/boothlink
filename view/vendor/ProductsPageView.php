<?php 
include '../../model/VendorQueries.php';
$product1 = new VendorQueries();
$products = $product1->getProducts($org_id)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
</head>
<body>
    <header>
        <h1>HEADER SAMPLE BOOTHLINK</h1>
    </header>
    <main>
        <div class="main-table">
            <div class="table-header">
                <p>PRODUCT LISTING</p>
                
                <a href="AddNewProduct.html">
                    <button>Add</button>
                </a>
                <select>Category</select>
            </div>
            <div class="table-products">
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Availability</th>
                        <th>Category</th>
                    </tr>
                    <?php if (!empty($products)): ?>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo htmlspecialchars($product['prod_serv_name']); ?></td>
            <td><?php echo htmlspecialchars($product['price']); ?></td>
            <td><?php echo htmlspecialchars($product['description']); ?></td>
            <td><?php echo htmlspecialchars($product['status']); ?></td>
            <td>
                <span class="<?php echo strtolower(htmlspecialchars($product['category'])); ?>">
                    <?php echo htmlspecialchars($product['category']); ?>
                </span>
            </td>
            <td style="text-align: right;">
                <!-- Edit Button -->
                <a href="edit_product.php?id=<?php echo $product['prod_serv_id']; ?>" class="edit">
edit
                </a>

                <a href="delete_product.php?id=<?php echo $product['prod_serv_id']; ?>" 
                   onclick="return confirm('Are you sure you want to delete this product?');" class="delete">
                   delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="6">No products available</td>
    </tr>
<?php endif; ?>


                </table>
            </div>
        </div>
    </main>
</body>
</html>