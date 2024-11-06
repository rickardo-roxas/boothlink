<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../../../public/css/vendor/add_edit_products.css">
</head>
<body>

<div class="container">
    <!-- Form Section -->
    <form class="form-container" method="POST" action="/cs-312_boothlink/products/edit-product">
        <div class="form-input">
            <h1>Edit Product</h1>
            <div class="header">Product Information</div>
            <input type="hidden" name="prod_id" value="<?php echo htmlspecialchars($productData['prod_id'] ?? ''); ?>">

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" required
                       oninput="updatePreview()"
                       value="<?php echo htmlspecialchars($productData['prod_serv_name'] ?? ''); ?>"
                       placeholder="Enter product name">
            </div>

            <div class="form-group">
                <label for="type">Product Type</label>
                <select name="type" id="type" required onchange="updatePreview()">
                    <option value="Item" <?php echo (isset($productData['category']) && $productData['category'] == 'Item') ? 'selected' : ''; ?>>Item</option>
                    <option value="Food" <?php echo (isset($productData['category']) && $productData['category'] == 'Food') ? 'selected' : ''; ?>>Food</option>
                    <option value="Service" <?php echo (isset($productData['category']) && $productData['category'] == 'Service') ? 'selected' : ''; ?>>Service</option>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group half-width">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" required
                           oninput="updatePreview()"
                           value="<?php echo htmlspecialchars($productData['price'] ?? ''); ?>"
                           placeholder="Enter price">
                </div>

                <div class="form-group half-width">
                    <label for="status">Status</label>
                    <select name="status" id="status" onchange="updatePreview()">
                        <option value="In Stock" <?php echo (isset($productData['status']) && $productData['status'] == 'In Stock') ? 'selected' : ''; ?>>In Stock</option>
                        <option value="Out of Stock" <?php echo (isset($productData['status']) && $productData['status'] == 'Out of Stock') ? 'selected' : ''; ?>>Out of Stock</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" required
                          oninput="updatePreview()"
                          placeholder="Enter product description"><?php echo htmlspecialchars($productData['description'] ?? ''); ?></textarea>
            </div>
            <div class="buttons">
                <button class="btn cancel" type="button" onclick="window.location.href='/cs-312_boothlink/products'">Cancel</button>
                <button class="btn add" type="submit">Save Changes</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>