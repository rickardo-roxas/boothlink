<?php
$pageTitle = "Reservations";
require('view/page-fragments/Header.php');
?>
    <link rel="stylesheet" href="/public/css/reservations.css">
    <script src="/public/js/reservations.js" defer></script>
    <main>
        <input type="hidden" id="reservations-data" value='<?php echo htmlspecialchars(json_encode($reservations), ENT_QUOTES); ?>'>
        <div class="main-table">
            <div class="table-header">
                <div class="heading-container">
                    <img id="shopping-cart" src="/shared/assets/icons/shopping-cart.png" alt="shopping cart">
                    <h2>Reservations</h2>
                </div>
                <div class="action-buttons">
                    <form action = "/reservations" method = "GET">
                        <label>
                            <select class="category-filter" name="status" onchange="this.form.submit()">
                                <option value="" disabled selected>Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </label>
                        <button class="text-button">View All</button>
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
                    <!-- This will be populated by reservations.js -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

<?php require('view/page-fragments/Footer.php'); ?>
