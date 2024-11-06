<?php
$pageTitle = "Sales";
require (__DIR__ . '/../../page-fragments/Header.php');
?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/public/css/vendor/sales.css">
<script src="/public/javascript/vendor/sales.js"></script>

<main class = "sales">
    <div class="grid-container">

        <section id = "product-sales" class = "card">
            <div class="product-sales-head">

                <h1>Product Sales</h1>

                <div class = "product-sales-right-head">
                    <form name = "filter-form" action=" ../../../controller/vendor/sales/SalesController.php" method="GET">
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
            <style>
            </style>
            <?php
            $encoded = null;
            if (isset($_GET['productList'])) {
                $productList = unserialize($_GET['productList']);
                $encoded = json_encode($productList);
            }
            ?>
            <script>
                let table = document.getElementById('product-sales');
                let body = document.getElementById('tbody');

                var productList = <?php echo $encoded ?>;

                for (let index in productList) {
                    let row = document.createElement('tr');
                    row.style.height = "8vh";



                    let product = document.createElement('td');
                    product.classList.add('product-td');
                    product.innerHTML = productList[index].img_src;


                    let price = document.createElement('td');
                    price.innerHTML =   productList[index].price + ".00";

                    let category = document.createElement('td');
                    category.innerHTML = productList[index].category;

                    let sold = document.createElement('td');
                    sold.innerHTML = productList[index].sold;

                    let status = document.createElement('td');
                    status.innerHTML = productList[index].status;

                    row.appendChild(product);
                    row.appendChild(price);
                    row.appendChild(category);
                    row.appendChild(sold);
                    row.appendChild(status);
                    body.appendChild(row);
                }
            </script>
        </section>

        <section id = "sales-performance" class = "card">
            <h1>Sales Performance</h1>
            <?php $salesToday = $_GET['salesToday']; ?>

            <h2>Today:</h2>
            <h4> &emsp;&emsp;&emsp; &#8369; <?php echo $salesToday ?>.00</h4>


            <?php $salesWeek = $_GET['salesWeek']; ?>
            <h2>This Week:</h2>
            <h4> &emsp;&emsp;&emsp; &#8369; <?php echo $salesWeek ?>.00</h4>
        </section>

        <section id = "sales-comparison" class = "card">
            <h1>Sales Comparison</h1>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
            <canvas id="sales-chart"></canvas>
            <script>
                <?php
                $encoded = null;
                if (isset($_GET['xValues']) && isset($_GET['labels'])) {
                    $xValuesUnserialize = unserialize($_GET['xValues']);
                    $labelUnserialize= unserialize($_GET['labels']);
                    $xValues = json_encode($xValuesUnserialize);
                    $label = json_encode($labelUnserialize);
                }
                ?>
                let datum = <?php echo $xValues ?>;
                new Chart("sales-chart", {
                    type: "bar",
                    data: {
                        labels: <?php echo $label ?>,
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


