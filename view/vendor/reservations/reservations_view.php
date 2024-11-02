<?php require(__DIR__ . '/../../page-fragments/Header.php'); ?>

<main>
    <div id="reservations">
        <div class="main-table">
            <div class="container">
                <h2>Reservations</h2>
                <div class="action-buttons">
                    <button>Pending</button>
                    <button>Completed</button>
                    <label>
                        <select class="category-filter">
                            <option value="Category">Category</option>
                            <option value="Item">Food</option>
                            <option value="Service">Item</option>
                            <option value="Food">Service</option>
                        </select>
                    </label>
                    <button class="refresh-btn">View All</button>
                </div>
            </div>
            <div class="table-products">
                <table>
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</main>

<?php require(__DIR__ . '/../../page-fragments/footer.php'); ?>

