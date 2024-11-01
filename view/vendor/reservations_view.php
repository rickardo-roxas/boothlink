<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BoothLink lets you discover and reserve unique products and services from student
    booths at Saint Louis University. Support SLU's vibrant student community today!">
    <title>BoothLink | Reservations</title>
    <link rel="stylesheet" href="../../public/css/vendor/products.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../../assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../../assets/favicon_io/site.webmanifest">
</head>
<body>
<?php
include (__DIR__.'/page-fragments/Header.php');
?>
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
</body>
