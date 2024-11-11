<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

const BASE_URL = 'cs-312-boothlink';
$title = $pageTitle;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="BoothLink lets you discover and reserve unique products and services from student
    booths at Saint Louis University. Support SLU's vibrant student community today!"/>
        <title>Boothlink <?php echo $title ?></title>
        <link rel="stylesheet" href="<?php echo $BASE_URL; ?> /public/css/customer/interactive.css">
        <link rel="stylesheet" href="<?php echo $BASE_URL; ?> /public/css/customer/style.css">
    </head>

<body>
<header>
    <div class = "logo">
        <a href="/cs-312_boothlink/home" target="_self" class = "container">
            <img src="<?php echo BASE_URL; ?> /assets/icons/logo-black-outline.png" alt="Boothlink Logo">
            <h1>booth<span class="sky-blue">link</span></h1>
        </a>
    </div>
    <nav>
        <ul>
            <li> <a class="<?php if($pageTitle =="HOME") {echo "active"; } ?>" href="/cs-312_boothlink/home" target="_self">Home</a></li>
            <li> <a class = "<?php if($pageTitle =="SHOP") {echo "active"; } ?>" href="/cs-312_boothlink/shop"> Shop </a></li>
            <li> <a class = "<?php if($pageTitle =="ORDERS") {echo "active"; } ?>" href="/cs-312_boothlink/orders"> Orders </a></li>
        </ul>
    </nav>

    <div class = "search-bar">
        <label>
            <input type="text" placeholder="Search for products...">
        </label>
    </div>
</header>
</body>
</html>
