<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BoothLink lets you discover and reserve unique products and services from student
    booths at Saint Louis University. Support SLU's vibrant student community today!">
    <title>BoothLink | Reservations</title>
    <link rel="stylesheet" href="../../public/css/vendor/reservations.css">
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
        <div>
            <h2>Reservations</h2>
            <div>
                <button>Pending</button>
                <button>Completed</button>
                <label>
                    <select>Category</select>
                </label>
                <button>View All</button>
            </div>
            <div>
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
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</main>
</body>
