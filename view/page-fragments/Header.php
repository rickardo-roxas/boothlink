<?php

const BASE_URL = '/cs-312_boothlink';
$pageHandler = new PageHandler();
$title = $_SESSION['page_title'] ?? 'Default Title';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BoothLink lets you discover and reserve unique products and services from student
    booths at Saint Louis University. Support SLU's vibrant student community today!">
    <title>BoothLink | <?php echo $title?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/vendor/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>/assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>/assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>/assets/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="<?php echo BASE_URL; ?>/assets/favicon_io/site.webmanifest">
</head>
<body>
<header>
    <div class="logo">
        <a href="/home" target="_self" class="container">
            <img src="<?php echo BASE_URL; ?>/assets/icons/logo-black-outline.png" alt="BoothLink logo">
            <h1>booth<span class="sky-blue">link</span></h1>
        </a>
    </div>
    <nav>
        <ul>
            <li><a href="/cs-312_boothlink/home" target="_self">Home</a></li>
            <li><a href="/cs-312_boothlink/reservations" target="_self">Reservations</a></li>
            <li><a href="/cs-312_boothlink/products" target="_self">Products</a></li>
            <li><a href="/cs-312_boothlink/schedule" target="_self">Schedule</a></li>
            <li><a href="/cs-312_boothlink/sales" target="_self">Sales</a></li>
        </ul>
    </nav>
    <div class="container">
        <button>Add New Listing</button>
        <button>
            <span><img alt= "Organization picture" src=></span>
            <span></span>
        </button>
    </div>
</header>
