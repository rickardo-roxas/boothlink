<?php
$pageTitle = "Reservations";
require ('view/page-fragments/Header.php');
?>
    <link rel="stylesheet" href="<?php echo BASE_URL?>/public/css/vendor/products.css">
    <script src="<?php echo BASE_URL?>/public/javascript/vendor/reservations.js" defer></script>
    <main>
        <input type="hidden" id="reservations-data" value='<?php echo htmlspecialchars(json_encode($reservations), ENT_QUOTES); ?>'>
        <div class="main-table">
            <div class="table-header">
                <p>Reservations</p>
                <div class="action-buttons">
                    <form action = "<?php echo BASE_URL ?>/reservations" method = "GET">
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
                        <th>ID</th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Customer</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- This is where the table will be populated vis reservations.js -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

<?php require 'view/page-fragments/Footer.php'?>