<?php
$pageTitle = "Home";
require('vendor/view/page-fragments/Header.php');
?>
<script src="<?php echo BASE_URL?>../../public/js/home.js" defer></script>
<main>
    <input type="hidden" id="org-data" value='<?php echo htmlspecialchars(json_encode($organizationData), ENT_QUOTES); ?>'>
    <input type="hidden" id="recent-reservations-data" value='<?php echo htmlspecialchars(json_encode($recentReservations), ENT_QUOTES); ?>'>
    <input type="hidden" id="schedule-data" value='<?php echo htmlspecialchars(json_encode($scheduleToday), ENT_QUOTES); ?>'>
    <input type="hidden" id="sales-today-data" value='<?php echo htmlspecialchars(json_encode($salesToday), ENT_QUOTES); ?>'>
    <input type="hidden" id="sales-week-data" value='<?php echo htmlspecialchars(json_encode($salesThisWeek), ENT_QUOTES); ?>'>
    <input type="hidden" id="pending-data" value='<?php echo htmlspecialchars(json_encode($pendingReservations), ENT_QUOTES); ?>'>
    <input type="hidden" id="completed-data" value='<?php echo htmlspecialchars(json_encode($completedReservations), ENT_QUOTES); ?>'>
    <input type="hidden" id="total-reservation-data" value='<?php echo htmlspecialchars(json_encode($totalReservations), ENT_QUOTES); ?>'>
    <input type="hidden" id="item-data" value='<?php echo htmlspecialchars(json_encode($itemReservations), ENT_QUOTES); ?>'>
    <input type="hidden" id="food-data" value='<?php echo htmlspecialchars(json_encode($foodReservations), ENT_QUOTES); ?>'>
    <input type="hidden" id="service-data" value='<?php echo htmlspecialchars(json_encode($serviceReservations), ENT_QUOTES); ?>'>
    <div id="dashboard">
        <div class="grid-container">
            <article id="dash-org" class="card">
                <h2>Organization</h2>
                <div class="container">
                    <img id="dash-org-img" src="<?php echo BASE_URL; ?>/shared/assets/images/org/" alt="Organization picture">
                    <h3 id="dash-org-name"></h3>
                </div>
                <div class="column-container">
                    <a id="fb-link" href="" target="_blank" class="container soc-med">
                        <img src="<?php echo BASE_URL; ?>/shared/assets/icons/soc-med/facebook.png" alt="Facebook logo">
                        <p></p>
                    </a>
                    <a id="ig-link" href="" target="_blank" class="container soc-med">
                        <img src="<?php echo BASE_URL; ?>/shared/assets/icons/soc-med/instagram.png" alt="Instagram logo">
                        <p></p>
                    </a>
                    <a id="x-link" href="" target="_blank" class="container soc-med">
                        <img src="<?php echo BASE_URL; ?>/shared/assets/icons/soc-med/twitter.png" alt="X logo">
                        <p></p>
                    </a>
                </div>
            </article>
            <article id="dash-reservations" class="card">
                <h2>Recent Reservations</h2>
                <table id="dash-recent-reservations">
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
                    <tbody>
                    <!--To be populated using home.js-->
                    </tbody>
                </table>
                <a class="refresh-btn" href="/cs-312_boothlink/reservations" target="_self">View All</a>
            </article>
            <article id="dash-sched" class="card">
                <h2>Schedule Today</h2>
                <p><?php echo date('F j, Y')?></p>
                <table id="dash-sched-table">
                    <thead>
                    <tr>
                        <th>Location</th>
                        <th>Stall Number</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--To be populated using home.js-->
                    </tbody>
                </table>
            </article>
            <article id="dash-sales" class="card">
                <h2>Sales Today</h2>
                <div class="column-container">
                    <p>₱ <span id="dash-sales-today"></span></p>
                    <button class="refresh-btn">Refresh</button>
                </div>
                <h2>Sales This Week</h2>
                <div class="column-container">
                    <p>₱ <span id="dash-sales-week"></span></p>
                    <button class="refresh-btn">Refresh</button>
                </div>
            </article>
            <article id="dash-total-reserv" class="card">
                <h2>Total Reservations Today</h2>
                <div class="column-container">
                    <p><span id="item-count"></span> Item Products</p>
                    <p><span id="food-count"></span> Food Products</p>
                    <p><span id="service-count"></span> Services</p>
                    <button class="refresh-btn">Refresh</button>
                </div>
            </article>
            <article id= "dash-summary" class="card">
                <h2>Reservations Summary Today</h2>
                <div class="column-container">
                    <div class="column-container">
                        <h3>Pending</h3>
                        <div class="stats">
                            <h4><span id="pending-percent"></span> %</h4>
                            <p><span id="pending-stats"></span> reservation/s</p>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" id="pending"></div>
                        </div>
                    </div>
                    <div class="column-container">
                        <h3>Completed</h3>
                        <div class="stats">
                            <h4><span id="completed-percent"></span> %</h4>
                            <p><span id="completed-stats"></span> reservation/s</p>
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
<?php require('vendor/view/page-fragments/Footer.php'); ?>
