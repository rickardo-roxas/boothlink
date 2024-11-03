<?php require(__DIR__ . '/../../page-fragments/Header.php'); ?>

<main>
    <div id="dashboard">
        <div class="grid-container">
            <article id="dash-org" class="card">
                <h2>Organization</h2>
                <div class="container">
                    <img src="<?php echo BASE_URL; ?>/assets/images/placeholder.jpeg" alt="Organization picture">
                    <h3><?php echo htmlspecialchars($organization['name']); ?></h3>
                </div>
                <div class="column-container">
                    <a href="" target="_blank" class="container soc-med">
                        <img src="<?php echo BASE_URL; ?>/assets/icons/soc-med/facebook.png" alt="Facebook logo">
                        <p>www.facebook.com/schemaslu</p>
                    </a>
                    <a href="" target="_blank" class="container soc-med">
                        <img src="<?php echo BASE_URL; ?>/assets/icons/soc-med/instagram.png" alt="Instagram logo">
                        <p>www.instagram.com/@schemaslu</p>
                    </a>
                    <a href="" target="_blank" class="container soc-med">
                        <img src="<?php echo BASE_URL; ?>/assets/icons/soc-med/twitter.png" alt="X logo">
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
                <a class="refresh-btn" href="/cs-312_boothlink/reservations" target="_self">View All</a>
            </article>
            <article id="dash-sched" class="card">
                <h2>Schedule Today</h2>
                <p>October 15, 2024</p>
                <table>
                    <thead>
                    <tr>
                        <th>Location</th>
                        <th>Stall Number</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                    </thead>
                    <tr>
                        <td>SLU Maryheights, Lobby</td>
                        <td>Stall #6</td>
                        <td>9:30 AM</td>
                        <td>1:00 PM</td>
                    </tr>
                </table>
            </article>
            <article id="dash-sales" class="card">
                <h2>Sales Today</h2>
                <div class="column-container">
                    <p>Php 289.00</p>
                    <button class="refresh-btn">Refresh</button>
                </div>
                <h2>Sales This Week</h2>
                <div class="column-container">
                    <p>Php 289.00</p>
                    <button class="refresh-btn">Refresh</button>
                </div>
            </article>
            <article id="dash-total-reserv" class="card">
                <h2>Total Reservations Today</h2>
                <div class="column-container">
                    <p>124 Item Products</p>
                    <p>5 Food Products</p>
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
</main>
<script>
    const organizationData = <?php echo json_encode($organizationData); ?>;
    const reservationsData = <?php echo json_encode($recentReservations); ?>;
    const salesToday = <?php echo json_encode($salesToday); ?>;
</script>
<script src="<?php echo BASE_URL?>/public/javascript/vendor/home.js"

<?php require('view/page-fragments/footer.php'); ?>
