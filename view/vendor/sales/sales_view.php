<?php
$pageTitle = "Sales";
require (__DIR__ . '/../../page-fragments/Header.php');
?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/public/css/vendor/sales.css">


<input type="hidden" id="productList" value='<?php echo htmlspecialchars(json_encode($productList), ENT_QUOTES); ?>'>
<input type="hidden" id="dataSalesToday" value='<?php echo htmlspecialchars(json_encode($salesToday), ENT_QUOTES); ?>'>
<input type="hidden" id="dataSalesWeek" value='<?php echo htmlspecialchars(json_encode($salesWeek), ENT_QUOTES); ?>'>

<script src="<?php echo BASE_URL?>/public/javascript/vendor/sales.js" defer></script>

<main class = "sales">
    <div class="grid-container">
        <section id = "product-sales" class = "card">
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

            <!--Script used for the highlight, switch to external if needed-->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const toggleOptions = document.querySelectorAll('.toggle-options');
                    toggleOptions.forEach(button => {
                        button.addEventListener('click', function(event) {
                            event.preventDefault();
                            toggleOptions.forEach(btn => btn.classList.remove('highlighted'));
                            this.classList.toggle('highlighted');
                        });
                    });
                });
                document.getElementById('filter-form").submit();
            </script>

            <table id = product-sales-table>
                <thead>
                <tr>
                    <th class = "product">Product</th>
                    <th class = "description">Price</th>
                    <th class = "description">Category</th>
                    <th class = "description">Sold</th>
                    <th class = "description">Status</th>
                </tr>
                </thead>

                <tbody id="tbody">
                </tbody>

            </table>
        </section>

        <section id = "sales-performance" class = "card">
            <h1>Sales Performance</h1>
            <h2>Today:</h2>
            <h4 id="todayTag"></h4>

            <h2>This Week:</h2>
            <h4 id="weekTag"></h4>
        </section>

        <section id = "sales-comparison" class = "card">
            <h1>Sales Comparison</h1>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
            <canvas id="sales-chart"></canvas>
            <script>
                let datum = <?php echo json_encode($xValues) ?>;
                new Chart("sales-chart", {
                    type: "bar",
                    data: {
                        labels: <?php echo json_encode($labels) ?>,
                        datasets: [{
                            label: '',
                            backgroundColor: "#1EBDEF",
                            data: datum,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                title: {
                                    display: true,
                                    text: 'Amount'
                                }
                            },
                            beginAtZero: true
                        },
                        legend: {
                            display: false
                        }

                    }
                });
            </script>

        </section>
    </div>
</main>
<?php require (__DIR__ . '/../../page-fragments/Footer.php'); ?>


