<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BoothLink lets you discover and reserve unique products and services from student
    booths at Saint Louis University. Support SLU's vibrant student community today!">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../public/css/vendor/style.css">
</head>
<body>
<?php
$orgPhoto = $_GET['orgPhoto'];
$orgName = $_GET['orgName'];
include '../../view/vendor/pageFragments/Header.php';
?>

<main>
    <div id="dashboard" class="container">
        <div class="grid-container">
            <div class="column-container">
                <div class="container">
                    <article id="dash-profile" class="card">
                        <h2>Profile</h2>
                        <div class="container">
                            <img src="../../assets/images/placeholder.jpeg" alt="Organization picture">
                            <h3>SCHEMA</h3>
                        </div>
                        <div class="column-container">
                            <a href="" target="_blank" class="container soc-med">
                                <img src="../../assets/icons/soc-med/facebook.png" alt="Facebook logo">
                                <p>www.facebook.com/schemaslu</p>
                            </a>
                            <a href="" target="_blank" class="container soc-med">
                                <img src="../../assets/icons/soc-med/instagram.png" alt="Instagram logo">
                                <p>www.instagram.com/@schemaslu</p>
                            </a>
                            <a href="" target="_blank" class="container soc-med">
                                <img src="../../assets/icons/soc-med/twitter.png" alt="X logo">
                                <p>www.x.com/@schemaslu</p>
                            </a>
                        </div>
                    </article>
                    <article id="dash-reservations" class="card">
                        <h2>Recent Reservations</h2>
                        <table>
                            <thead>
                            <tr>
                                <th>Reservation No.</th>
                                <th>Customer (Last Name)</th>
                                <th>Product/Service</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tr>
                                <td>1</td>
                                <td>Tank</td>
                                <td>Veggie Burger</td>
                                <td>5</td>
                                <td>Php 500.00</td>
                                <td>Completed</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Tank</td>
                                <td>Veggie Burger</td>
                                <td>5</td>
                                <td>Php 500.00</td>
                                <td>Completed</td>
                            </tr>
                        </table>
                        <button class="refresh-btn">View All</button>
                    </article>
                </div>
                <article id="dash-sched" class="card">
                    <h2>Schedule Today</h2>
                    <p>October 15, 2024</p>
                    <table>
                        <thead>
                        <tr>
                            <th>Location and Stall Number</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>SLU Maryheights, Lobby, Stall #6</td>
                            <td>9:30 AM</td>
                            <td>1:00 PM</td>
                        </tr>
                        <tr>
                            <td>SLU Marheights, Lobby, Stall #6</td>
                            <td>2:00 PM</td>
                            <td>4:00 PM</td>
                        </tr>
                    </table>
                </article>
            </div>
        </div>
        <div class="grid-container">
            <div class="column-container">
                <article id="dash-sales" class="card">
                    <h2>Total Sales</h2>
                    <div class="column-container">
                        <p>Php 289.00</p>
                        <button class="refresh-btn">Refresh</button>
                    </div>
                </article>
                <article id="dash-total-reserv" class="card">
                    <h2>Total Reservations</h2>
                    <div class="column-container">
                        <p>124 Products</p>
                        <p>5 Services</p>
                        <button class="refresh-btn">Refresh</button>
                    </div>
                </article>
                <article id= "dash-summary" class="card">
                    <h2>Reservations Summary</h2>
                    <div class="column-container">
                        <div class="column-container">
                            <h3>Pending</h3>
                            <div class="stats">
                                <h4>70%</h4>
                                <p>70/100 reservations</p>
                            </div>
                            <div class="progress-bar">
                                <div class="progress" id="pending"></div>
                            </div>
                        </div>
                        <div class="column-container">
                            <h3>Completed</h3>
                            <div class="stats">
                                <h4>30%</h4>
                                <p>30/100 reservations</p>
                            </div>
                            <div class="progress-bar">
                                <div class="progress" id="completed"></div>
                            </div>

                        </div>
                        <button class="refresh-btn">Refresh</button>
                    </div>
                </article>
            </div>
        </div>
    </div>
</main>
<footer>
    <!--To be done by Patrick Lacanilao-->
</footer>
</body>
</html>