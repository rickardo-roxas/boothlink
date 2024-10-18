<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="public/css/vendor/sales.css">
        <title>Sales</title>
    </head>

    <body>

    <?php
    $orgPhoto = 'assets/images/placeholder.jpeg';
    $orgName = "SCHEMA";
    $prod1 = new Product("assets/icons/logo-black-outline.png", "iPhone 14 Pro Max 512GB (Gold)", 1399, "Item", "1243 pcs", "In Stock");
    $prod2 = new Product("assets/icons/logo-black-outline.png", "iPhone 14 Pro Max 512GB (Gold)", 1399, "Item", "1243 pcs", "In Stock");
    $productList = [$prod1, $prod2];


    include 'view/vendor/pageFragments/Header.php';
    ?>

    <main class = "sales">

        <div class="grid-container">

            <section id = "product-sales" class = "card">
                <div class="product-sales-head">

                    <h1>Product Sales</h1>

                    <div class = "product-sales-right-head">
                        <div class = "toggle-div">
                            <ul class = "toggle-options">
                                <li>In stock</li>
                                <li> Out of Stock</li>
                            </ul>
                        </div>

                        <form > <!--TO DEFINE ACTION-->
                            <label>
                                <select class="category-select">
                                    <option value="item"> Item</option>
                                    <option value = "service">Service</option>
                                    <option value = "food">Food</option>
                                </select>
                            </label>
                        </form>

                        <p>View All</p>
                    </div>
                </div>

                <table>
                    <thead>
                    <tr>
                        <th class = "product">Product Name</th>
                        <th class = "description">Price</th>
                        <th class = "description">Category</th>
                        <th class = "description">Sold</th>
                        <th class = "description">Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($productList as $product): ?>
                        <tr>

                            <td id="product-td">
                                <img src="<?php echo $product -> getImage() ?>">
                                <?php echo $product -> getName() ?>
                            </td>
                            <td> <?php echo $product -> getPrice() ?> </td>
                            <td> <?php echo $product -> getCategory() ?> </td>
                            <td> <?php echo $product -> getSold() ?> </td>
                            <td> <?php echo $product -> getStatus() ?> </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>


                </table>

            </section>

            <section id = "sales-performance" class = "card">
                <h1>Sales Performance</h1>
                <h2>Today:</h2>
               <!-- <h4><?php echo $performanceToday ?></h4> -->
                <p>&emsp;&emsp;&emsp;289.00</p>
                <h2>This Week:</h2>
                <!-- <h4><?php echo $performanceWeek ?></h4> -->
                <p> &emsp;&emsp;&emsp;1384.00</p>
            </section>

            <section id = "sales-comparison" class = "card">
                <h1>Sales Comparison</h1>

                <div class="chart" style="height: 75%; width: 75%;">
                    <canvas id ="graph" width="100" height="100"> </canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src="/public/javascript/SalesComparison.js"></script>

            </section>



        </div>

    </main>
    </body>

</html>
