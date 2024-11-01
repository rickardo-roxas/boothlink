<?php

include (__DIR__.'/../../../controller/PageHandler.php');

session_start();

$orgName = $_SESSION['orgName'];
$orgPhoto = $_SESSION['orgPhoto'];

if (isset($_GET['page'])) {
    $handler = unserialize($_SESSION['handler']);
    $handler->getFromURL();
}

?>

<header>
<div class="logo">
        <a href="?page=home" target="_self" class="container">
            <img src="../../assets/icons/logo-black-outline.png" alt="BoothLink logo">
            <h1>booth<span class="sky-blue">link</span></h1>
        </a>
    </div>
    <nav>
        <ul>
            <li><a href="?page=home" target="_self">Home</a></li>
            <li><a href="?page=reservations" target="_self">Reservations</a></li>
            <li><a href="?page=products" target="_self">Products</a></li>
            <li><a href="?page=schedule" target="_self">Schedule</a></li>
            <li><a href="?page=sales" target="_self">Sales</a></li>
        </ul>
    </nav>
    <div class="container">
        <button>Add New Listing</button>
        <ul class="profile">
            <li><img alt= "Organization picture" src= <?php echo $orgPhoto ?>  ></li>
            <li><p> <?php echo $orgName ?></p></li>
        </ul>
    </div>
</header>
