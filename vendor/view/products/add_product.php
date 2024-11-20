<?php

use model\vendor\products\AddNewProductModel;

$pageTitle = "Products";
require('view/vendor/page-fragments/Header.php');
?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/public/css/vendor/add_edit_products.css">
<main>
    <div class="container">
        <!-- Form Section -->
        <form class="form-container" method="POST" action="<?php echo BASE_URL; ?>/products/add-product" enctype="multipart/form-data" onsubmit="validateForm()">
            <div class="form-input">
                <h1>Add New Product</h1>
                <div class="header">Product Information</div>
                
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" required oninput="updatePreview()"
                           placeholder="Enter product name"
                           minlength="3" maxlength="50"
                           pattern=".*\S.*" 
                           title="Product Name cannot be empty or contain only spaces."
                           value="<?php echo htmlspecialchars($productData['prod_serv_name'] ?? ''); ?>"
                           onkeydown="restrictInvalidCharacters(event)">
                </div>

                <div class="form-group">
                    <label for="type">Product Type</label>
                    <select name="type" id="type" required onchange="updatePreview()">
                    <option value="" disabled selected>Select product type</option>
                        <option value="Item">Item</option>
                        <option value="Food">Food</option>
                        <option value="Service">Service</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" required oninput="updatePreview();"
                               placeholder="Enter price"
                               min="1" max="5000" step="1.00"
                               value="<?php echo htmlspecialchars($productData['price'] ?? ''); ?>">
                    </div>

                    <div class="form-group half-width">
                        <label for="status">Status</label>
                        <select name="status" id="status" onchange="updatePreview()">
                            <option value="In Stock" selected>In Stock</option>
                            <option value="Out of Stock">Out of Stock</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required oninput="updatePreview()"
                                placeholder="Enter product description"
                                minlength="10" maxlength="60"
                                pattern=".*\S.*"
                                title="Description cannot be empty or contain only spaces."><?php echo htmlspecialchars($productData['description'] ?? ''); ?></textarea>
                </div>

                <div class="form-group schedule-group">
                    <label>Schedule</label>
                    <table class="schedule-table">
                        <thead>
                        <tr>
                            <th>Select</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $model = new AddNewProductModel();
                        $schedules = $model->getSchedule();
                        if (!empty($schedules)) {
                            foreach ($schedules as $schedule) {
                                $date = $schedule['date'];
                                $startTime = $schedule['start_time'];
                                $endTime = $schedule['end_time'];
                                echo '<tr>';
                                echo '<td><input type="checkbox" name="schedule[]" value="' . htmlspecialchars($date) . '"></td>';
                                echo '<td>' . htmlspecialchars($date) . '</td>';
                                echo '<td>' . htmlspecialchars($startTime) . '</td>';
                                echo '<td>' . htmlspecialchars($endTime) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4">No schedules available for this week.</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>



            </div>

            <!-- Preview Section -->
            <div class="preview-container">
                <div class="header">Preview</div>
                
                <div class="file-upload">
                    <input name="file[]" type="file" id="file-input" multiple accept="image/*" onchange="previewImages()" style="display: none;">
                    <label for="file-input" class="btn-file">Upload Image</label>
                    <span>Choose images from computer</span>
                </div>

                <div class="image-preview" id="image-preview">
                    <div>Preview Photo</div>
                </div>

                <div class="preview-box">
                    <h3 id="preview-name">Product Name</h3>
                    <div>Category: <span id="preview-type">Select Category</span></div>
                    <div>Description: <span id="preview-description">Input description.</span></div>
                    <div>Price: <span id="preview-price">Php 0.00</span></div>
                    <div>Status: <span id="preview-status">Select Status</span></div>
                    <div>Schedule: <span id="preview-schedule">Select Schedule</span></div>
                </div>

                <div class="buttons">
                    <button class="btn cancel" type="button" onclick="confirmCancel()">Cancel</button>
                    <button class="btn add" type="submit">Add Product</button>
                </div>
            </div>
        </form>
    </div>
</main>
<?php require('vendor/view/page-fragments/Footer.php'); ?>

<script src="<?php echo BASE_URL?>/public/javascript/vendor/add_product.js" defer></script>
<script>
    function validateForm() {
        const nameInput = document.getElementById("name").value.trim();
        const descriptionInput = document.getElementById("description").value.trim();
        if (!nameInput || !descriptionInput) {
            alert("Product name and description cannot be empty or just spaces.");
            event.preventDefault();
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
    function confirmCancel() {
        if (confirm("Are you sure you want to cancel?")) {
            window.location.href = '/cs-312_boothlink/products';
        }
    }
    document.getElementById("name").addEventListener("keydown", restrictInvalidCharacters);
</script>

<?php if (isset($_SESSION['product_added']) && $_SESSION['product_added']): ?>
    <script type="text/javascript">
        // Set the flag for JavaScript alert in sessionStorage
        sessionStorage.setItem('productAdded', 'true');
    </script>
    <?php unset($_SESSION['product_added']); ?> <!-- Clear the session flag after use -->
<?php endif; ?>