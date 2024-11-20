<?php
$pageTitle = "Schedule";
require('view/vendor/page-fragments/Header.php');
?>
<link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/vendor/schedule.css">
<link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/vendor/schedule_selector.css">
<script src="<?php echo BASE_URL ?>/public/javascript/vendor/schedule.js" defer></script>
<script src="<?php echo BASE_URL ?>/public/javascript/vendor/schedule_selector.js" defer></script>
<main>
    <input type="hidden" id="schedule-week" value="<?php echo htmlspecialchars(json_encode($scheduleThisWeek), ENT_QUOTES);;?>">
    <div class="main-table">
        <div class="table-header">
            <p>Schedule</p>
            <p><?php echo $dateRange?></p>
            <div class="action-buttons">
                <button class="add-button" onclick="openSchedulePopup()">
                    <img src="<?php echo BASE_URL?>/assets/icons/add-blue-outline.png" alt="Add Icon" class="add-icon">
                    Add Schedule
                </button>
            </div>
        </div>
        <!-- Schedule Table -->
        <div class="table-schedule">
            <table>
                <thead>
                <tr>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </tr>
                </thead>
                <tbody>
                <!--To be populated using schedule.js-->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Popup -->
    <div id="schedule-popup" onclick="closeSchedulePopup()">
        <div class="popup-content" onclick="event.stopPropagation();">
            <?php include 'schedule_selector_view.php'; ?>
        </div>
    </div>
</main>

<?php require('vendor/view/page-fragments/Footer.php'); ?>
