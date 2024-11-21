<?php
$pageTitle = "Products";
require('vendor/view/page-fragments/Header.php');
?>
<link rel="stylesheet" href="<?php echo BASE_URL ?>/vendor/public/css/add_edit_products.css">
<main>
    <div class="container">
        <!-- Form Section -->
        <form class="form-container" method="POST" action="/cs-312_boothlink/products/edit-product" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-input">
                <h1>Edit Product</h1>
                <div class="header">Product Information</div>
                <input type="hidden" name="prod_id" value="<?php echo htmlspecialchars($productData['prod_id'] ?? ''); ?>">
                <input type="hidden" name="org_id" value="<?php echo htmlspecialchars($productData['org_id'] ?? ''); ?>">
                <!-- Product Name -->
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" required oninput="updatePreview()"
                           value="<?php echo htmlspecialchars($productData['prod_serv_name'] ?? ''); ?>"
                           placeholder="Enter product name" minlength="3" maxlength="50"
                           pattern=".*\S.*"
                           title="Product Name cannot be empty or contain only spaces."
                           onkeydown="restrictInvalidCharacters(event)">
                </div>

                <!-- Product Type -->
                <div class="form-group">
                    <label for="type">Product Type</label>
                    <select name="type" id="type" required onchange="updatePreview()">
                        <option value="" disabled selected>Select product type</option>
                        <option value="Item" <?php echo (isset($productData['category']) && $productData['category'] === 'Item') ? 'selected' : ''; ?>>Item</option>
                        <option value="Food" <?php echo (isset($productData['category']) && $productData['category'] === 'Food') ? 'selected' : ''; ?>>Food</option>
                        <option value="Service" <?php echo (isset($productData['category']) && $productData['category'] === 'Service') ? 'selected' : ''; ?>>Service</option>
                    </select>
                </div>

                <!-- Price and Status -->
                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" required oninput="updatePreview()"
                               value="<?php echo htmlspecialchars($productData['price'] ?? ''); ?>"
                               placeholder="Enter price" min="1" max="5000" step="0.01">
                    </div>

                    <div class="form-group half-width">
                        <label for="status">Status</label>
                        <select name="status" id="status" onchange="updatePreview()">
                            <option value="In Stock" <?php echo (isset($productData['status']) && $productData['status'] === 'In Stock') ? 'selected' : ''; ?>>In Stock</option>
                            <option value="Out of Stock" <?php echo (isset($productData['status']) && $productData['status'] === 'Out of Stock') ? 'selected' : ''; ?>>Out of Stock</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required oninput="updatePreview()"
                              placeholder="Enter product description" minlength="10" maxlength="60"
                              pattern=".*\S.*"
                              title="Description cannot be empty or contain only spaces."><?php echo htmlspecialchars($productData['description'] ?? ''); ?></textarea>
                </div>

                <!-- Schedule Table -->
                <div class="form-group">
                    <label for="schedule">Schedule</label>
                    <table class="schedule-table">
                        <thead>
                        <tr>
                            <th>Select</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Stall Number</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        use model\vendor\products\EditProductsModel;

                        $model = new EditProductsModel();
                        $schedules = $model->getSchedule();
                        $associatedSchedule = $productData['schedule_ids'] ?? [];

                        if (!empty($schedules)) {
                            foreach ($schedules as $schedule) {
                                $isChecked = in_array($schedule['sched_id'], $associatedSchedule) ? 'checked' : '';
                                echo '<tr>';
                                echo '<td><input type="checkbox" name="schedule_ids[]" value="' . htmlspecialchars($schedule['sched_id']) . '" ' . $isChecked . '></td>';
                                echo '<td>' . htmlspecialchars($schedule['date']) . '</td>';
                                echo '<td>' . htmlspecialchars($schedule['loc_room'] ?? 'Unknown Location') . '</td>';
                                echo '<td>' . htmlspecialchars($schedule['stall_number']) . '</td>';
                                echo '<td>' . htmlspecialchars($schedule['start_time']) . '</td>';
                                echo '<td>' . htmlspecialchars($schedule['end_time']) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="6">No schedules available for this week.</td></tr>';
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
                    <h3 id="preview-name"><?php echo htmlspecialchars($productData['prod_serv_name'] ?? 'Product Name'); ?></h3>
                    <div>Category: <span id="preview-type"><?php echo htmlspecialchars($productData['category'] ?? 'Select Category'); ?></span></div>
                    <div>Description: <span id="preview-description"><?php echo htmlspecialchars($productData['description'] ?? 'Input description.'); ?></span></div>
                    <div>Price: <span id="preview-price"><?php echo 'Php ' . number_format($productData['price'], 2) ?? 'Php 0.00'; ?></span></div>
                    <div>Status: <span id="preview-status"><?php echo htmlspecialchars($productData['status'] ?? 'Select Status'); ?></span></div>
                    <div>Schedule: <span id="preview-schedule">Select Schedule</span></div>
                </div>

                <div class="buttons">
                    <button class="btn cancel" type="button" onclick="confirmCancel()">Cancel</button>
                    <button class="btn add" type="submit">Save Changes</button>
                </div>

            </div>
        </form>
    </div>
</main>

<?php require 'vendor/view/page-fragments/Footer.php'; ?>

<script>
    function validateForm() {
        const name = document.getElementById("name").value.trim();
        const description = document.getElementById("description").value.trim();
        if (!name || !description) {
            alert("Product name and description cannot be empty or just spaces.");
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

    document.querySelector('form').addEventListener('submit', function(event) {
        // Get all the checkboxes with the name 'schedule_ids[]'
        var checkboxes = document.querySelectorAll('input[name="schedule_ids[]"]');
        var checked = false;

        // Loop through all checkboxes to check if at least one is checked
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checked = true;
            }
        });

        // If none are checked, show an alert and prevent form submission
        if (!checked) {
            alert("Please select at least one schedule.");
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

