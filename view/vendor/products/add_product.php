<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../../../public/css/vendor/add-edit-product.css">
</head>
<body>

    <div class="container">
        <!-- Form Section -->
        <div class="form-container">
            <h1>Add New Product</h1>
            <div class="header">Product Information</div>

            <form>
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" required oninput="updatePreview()">
                </div>

                <div class="form-group">
                    <label for="type">Product Type</label>
                    <select name="type" id="type" required onchange="updatePreview()">
                        <option value="Item">Item</option>
                        <option value="Food">Food</option>
                        <option value="Service">Service</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" required oninput="updatePreview()">
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
                    <textarea name="description" id="description" required oninput="updatePreview()"></textarea>
                </div>

                <div class="form-group schedule-group">
                    <label>Schedule</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox"> Date 1</label>
                        <label><input type="checkbox"> Date 2</label>
                        <label><input type="checkbox"> Date 3</label>
                        <label><input type="checkbox"> Date 4</label>
                        <label><input type="checkbox"> Date 5</label>
                    </div>
                </div>
            </form>
        </div>

        <!-- Preview Section -->
        <div class="preview-container">
            <div class="header">Preview</div>
            <div class="file-upload">
                <input type="file" id="file-input" multiple accept="image/*" onchange="previewImages()" style="display: none;">
                <label for="file-input" class="btn-file">Upload Image</label>
                <span>Choose images from computer (max. 3 images)</span>
            </div>

            <div class="image-preview">
                <div>Preview Photo</div>
                <div>Preview Photo</div>
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
                <button class="btn cancel">Cancel</button>
                <button class="btn add">Add Product</button>
            </div>
        </div>
    </div>

    <!-- JS to preview (to add) -->
    <script src="../../public/javascript/AddProduct.js"></script>
</body>
</html>