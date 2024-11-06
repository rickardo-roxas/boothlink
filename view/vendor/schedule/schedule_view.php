<?php
$pageTitle = "Schedule";
require('view/page-fragments/header.php');
?>
<link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/vendor/schedule.css">
<link rel="stylesheet" href="<?php echo BASE_URL ?>/public/css/vendor/schedule_selector.css">
<script src="<?php echo BASE_URL ?>/public/javascript/vendor/schedule.js" defer></script>
<script src="<?php echo BASE_URL ?>/public/javascript/vendor/schedule_selector.js" defer></script>

<main>
    <div class="main-table">
        <div class="table-header">
            <p>Schedule</p>
            <div class="action-buttons">
                <button class="add-button" onclick="openSchedulePopup()">
                    <img src="../../../assets/icons/add-blue-outline.png" alt="Add Icon" class="add-icon">
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
                    <?php for ($i = 0; $i < 6; $i++): ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php endfor; ?>
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

<?php require 'view/page-fragments/Footer.php' ?>
