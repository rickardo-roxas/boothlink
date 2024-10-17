<!DOCTYPE html>
<html lang="en">
    
    <head>
        <style>
            h4,h3,h2,p {
                margin: 0;

            }

            p {
                font-size: 1.7vh;
            }

            .container {
                background-color: rgb(214, 211, 211);
                margin: 7vh;
            }

            .card {
                background-color:white;
                padding-left: 2vh;
                padding-top: 3vh;
                padding-right: 2vh;
            }

            h3 {
                font-size: 1.8ch;
            }

            h4 {
                font-size: 1.5ch;
            }

            table {
                margin-top: 4vh;
                width: 100%;
                text-align: left;
            }
            table th,td {
                font-size: 1.5ch;
                font-weight: 100;
                padding: 2%;
            }

            .product {
                width: 30%;
            }
            .price, .category, .sold, .status {
                width: 15%;
            }

            img {
                width: 5vh;
                height: 5vh;
            }

        </style>
    </head>

    <body class="container">
        <div style = "display:grid; 
        grid-template-areas: 
        'left top-right' 
        'left bottom-right'; 
        gap:1px;">
            <section id = "product-sales" class = "card" style = "height: 85vh; width: 105vh; grid-area:left">

                <div id = "sales-head" style="display:flex; align-items: flex-end;">
                    <h3>Product Sales</h3>

                    <div style = "margin-left: auto; display: flex; align-items: flex-end;">
                        <p>In Stock</p>

                        <form id="category-select"> <!--TO DEFINE ACTION-->
                            <select>
                                <option value="item"> Item</option>
                                <option value = "service">Service</option>
                                <option value = "food">Food</option>
                            </select>
                        </form>

                        <p href> View All</p> <!-- to define-->

                    </div>
                    
                </div>

                <table>
                    <thead>
                        <tr>
                            <th class = "product">Product Name</th>
                            <th class = "price">Price</th>
                            <th class = "category">Category</th>
                            <th class = "sold">Sold</th>
                            <th class = "status">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach ($productList as $product): ?>
                            <tr>

                                <td> <img src="<?php echo $product -> getImage() ?>"> <?php echo $product -> getName() ?>
                                <td> <?php echo $product -> getPrice() ?> </td>
                                <td> <?php echo $product -> getCategory() ?> </td>
                                <td> <?php echo $product -> getSold() ?> </td>
                                <td> <?php echo $product -> getStatus() ?> </td>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>

            </section>
            <section id = "sales-performance" class = "card"style="grid-area:top-right; height: 41vh; width: 75vh;"> 
                <h2>Sales Performance</h2>
                <h3>Today:</h3>
                <h4><?php echo $performanceToday ?></h4>
                <h3>This Week:</h3>
                <h4><?php echo $performanceWeek ?></h4>
            </section>

            <section id = "sales-comparison" class = "card" style="grid-area:bottom-right; height: 41vh; width:75vh;">
                <h2>Sales Comparison</h2>

                <div class="chart" style="height: 75%; width: 75%;">
                <canvas id ="graph" width="100" height="100"> </canvas>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src="/public/javascript/SalesComparison.js"></script>


            </section>
        </div>
    </body>
    
    <footer>

    </footer>

</html>