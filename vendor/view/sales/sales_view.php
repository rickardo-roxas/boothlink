<?php
$pageTitle = "Sales";
require(__DIR__ . '/../page-fragments/Header.php');
?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/public/css/vendor/sales.css">


<!-- Hidden Data to populate the javascript file -->
<input type="hidden" id="productList" value='<?php echo htmlspecialchars(json_encode($productList), ENT_QUOTES); ?>'>
<input type="hidden" id="dataSalesToday" value='<?php echo htmlspecialchars(json_encode($salesToday), ENT_QUOTES); ?>'>
<input type="hidden" id="dataSalesWeek" value='<?php echo htmlspecialchars(json_encode($salesWeek), ENT_QUOTES); ?>'>
<input type="hidden" id="dataXValues" value='<?php echo htmlspecialchars(json_encode($xValues), ENT_QUOTES); ?>'>
<input type="hidden" id="dataLabels" value='<?php echo htmlspecialchars(json_encode($labels), ENT_QUOTES); ?>'>


<!-- Javascript file to handle populate this view -->
<script src="<?php echo BASE_URL?>/public/javascript/vendor/sales.js" defer></script>


<main class = "sales">

    <!-- Parent grid which holds the three different boxes in the view -->
    <div class="grid-container">

        <!-- Product sales box template -->
        <section id = "product-sales" class = "card">

            <!-- The header of the Product sales section and the form functionality -->
            <div class="product-sales-head">
                <h1>Product Sales</h1>
                <div class = "product-sales-right-head">
                    <form name = "filter-form" action="<?php echo BASE_URL . "/sales" ?>"  method="GET">
                        <label class="toggle-button">
                            <button class="toggle-options" name="status" value="In Stock" >In stock</button>
                            <button class="toggle-options" name="status" value="Out of Stock" >Out of Stock</button>
                        </label>
                        <label>
                            <select class="category-select" name="category" onchange="this.form.submit()">
                                <option value="" disabled selected>Category</option>
                                <option value="item"> Item</option>
                                <option value = "service">Service</option>
                                <option value = "food">Food</option>
                            </select>
                        </label>
                        <button name="category" class="text-button" value="all">View All</button>
                    </form>
                </div>
            </div>

            <table id = product-sales-table>

                <!-- The table headers for the product sales -->
                <thead>
                <tr>
                    <th class = "product">Product</th>
                    <th class = "description">Price</th>
                    <th class = "description">Category</th>
                    <th class = "description">Sold</th>
                    <th class = "description">Status</th>
                </tr>
                </thead>

                <!-- The body of the table to be populated by the JS -->
                <tbody id="tbody"></tbody>

            </table>
        </section>

        <!-- Sales Performance Box -->
        <section id = "sales-performance" class = "card">
            <h1>Sales Performance</h1>
            <h2>Today:</h2>

            <!-- Tag that holds the sales today which will be populated by JS -->
            <h4 id="todayTag"></h4>

            <h2>This Week:</h2>

            <!-- Tag that holds the sales this week which will be populated by JS -->
            <h4 id="weekTag"></h4>
        </section>

        <!-- Box that holds the sales comparison -->
        <section id = "sales-comparison" class = "card">
            <h1>Sales Comparison</h1>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

            <!-- Canvas which holds the graphs that will be populated by the JS -->
            <canvas id="sales-chart"></canvas>
        </section>

    </div>
</main>
<?php require(__DIR__ . '/../../vendor/page-fragments/Footer.php'); ?>
