<?php
$pageTitle = "Products";
require 'view/vendor/page-fragments/Header.php';
?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/public/css/vendor/add_edit_products.css">
<main>
<div class="container">
    <!-- Form Section -->
    <form class="form-container" method="POST" action="/cs-312_boothlink/products/edit-product" onsubmit="return validateForm()">
    <div class="form-input">
            <h1>Edit Product</h1>
            <div class="header">Product Information</div>
            <input type="hidden" name="prod_id" value="<?php echo htmlspecialchars($productData['prod_id'] ?? ''); ?>">

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" required
                       oninput="updatePreview()" 
                       value="<?php echo htmlspecialchars($productData['prod_serv_name'] ?? ''); ?>"
                       placeholder="Enter product name" 
                       minlength="3" maxlength="50"
                       pattern=".*\S.*" 
                       title="Product Name cannot be empty or contain only spaces."
                       onkeydown="restrictInvalidCharacters(event)">
            </div>

            <div class="form-group">
                <label for="type">Product Type</label>
                <select name="type" id="type" required onchange="updatePreview()">
                <option value="" disabled selected>Select product type</option>
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
                           placeholder="Enter price"
                           min="1" max="5000" step="0.01" 
                           title="Price must be between 1 and 5000.">
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
                          placeholder="Enter product description" 
                          minlength="10" maxlength="60"
                          pattern=".*\S.*"
                          title="Description cannot be empty or contain only spaces."><?php echo htmlspecialchars($productData['description'] ?? ''); ?></textarea>
            </div>
            <div class="buttons">
                <button class="btn cancel" type="button" onclick="window.location.href='/cs-312_boothlink/products'">Cancel</button>
                <button class="btn add" type="submit">Save Changes</button>
            </div>
        </div>
    </form>
</div>
</main>
<?php require 'view/vendor/page-fragments/Footer.php'; ?>

<script>
    function validateForm() {
    const name = document.getElementById("name").value.trim();
    const description = document.getElementById("description").value.trim();

    const nameRegex = /^[A-Za-z\s]+$/;

    if (!name || !description) {
        alert("Product name and description cannot be empty or just spaces.");
        return false;
    }

    if (!nameRegex.test(name)) {
        alert("Product name cannot contain numbers.");
        return false;
    }

    return true; 
}

function restrictInvalidCharacters(event) {
    const key = event.key;
    
    const isAllowedKey = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(key);
    const isValidChar = /^[A-Za-z\s\-]$/.test(key);

    if (!isAllowedKey && !isValidChar) {
        event.preventDefault();
    }
}

document.getElementById("name").addEventListener("keydown", restrictInvalidCharacters);
</script>
