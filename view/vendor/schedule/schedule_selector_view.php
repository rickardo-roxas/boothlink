<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../../public/css/vendor/schedule_selector.css">
</head>
<body>
    <?php
        // Get the current month, year, and day
        $currentMonth = date('F');
        $currentYear = date('Y');
        $today = date('j');

        // Get month and year from query parameters or use current values
        $month = $_GET['month'] ?? $currentMonth;
        $year = $_GET['year'] ?? $currentYear;

        // Get start and end times from query parameters or use defaults
        $startTime = $_GET["startTime"] ?? "07:00";
        $endTime = $_GET["endTime"] ?? "7:00";
    ?>

    <div class="schedule-selector card">
        <h3><?php echo "$month $year"; ?></h3>
        
        <table>
            <thead>
                <tr>
                    <th>SUN</th>
                    <th>MON</th>
                    <th>TUE</th>
                    <th>WED</th>
                    <th>THU</th>
                    <th>FRI</th>
                    <th>SAT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Calculate the first day and number of days in the month
                $firstDay = strtotime("$year-$month-01");
                $daysInMonth = date('t', $firstDay);
                $startDayOfWeek = date('w', $firstDay);
                $days = [];

                // Add empty cells for days before the first of the month
                for ($i = 0; $i < $startDayOfWeek; $i++) {
                    $days[] = '';
                }

                // Add each day of the month to the array
                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $days[] = $day;
                }

                // Create table rows for each week
                foreach (array_chunk($days, 7) as $week) {
                    echo '<tr>';
                    foreach ($week as $day) {
                        $highlightClass = ($day == $today) ? 'today' : '';
                        echo '<td class="' . $highlightClass . '" data-day="' . ($day ?: '') . '" data-date="' . ($day ? "$year-$month-$day" : '') . '">' . ($day ?: '') . '</td>';
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <div class="time-input">
            <label>Start Time</label>
            <select id="start-time">
                <?php
                // Generate options for start time dropdown
                for ($hour = 7; $hour <= 19; $hour++) {
                    for ($minute = 0; $minute < 60; $minute += 30) {
                        $displayHour = ($hour > 12) ? $hour - 12 : $hour;
                        $formattedMinute = str_pad($minute, 2, '0', STR_PAD_LEFT);
                        echo "<option value=\"$hour:$formattedMinute\">" . str_pad($displayHour, 2, '0', STR_PAD_LEFT) . ":$formattedMinute</option>";
                    }
                }
                ?>
            </select>
            <div class="am-pm-toggle">
                <button type="button" class="am selected">AM</button>
                <button type="button" class="pm">PM</button>
            </div>
        </div>

        <div class="time-input">
            <label>End Time</label>
            <select id="end-time">
                <?php
                // Generate options for end time dropdown
                for ($hour = 7; $hour <= 19; $hour++) {
                    for ($minute = 0; $minute < 60; $minute += 30) {
                        $displayHour = ($hour > 12) ? $hour - 12 : $hour;
                        $formattedMinute = str_pad($minute, 2, '0', STR_PAD_LEFT);
                        echo "<option value=\"$hour:$formattedMinute\">" . str_pad($displayHour, 2, '0', STR_PAD_LEFT) . ":$formattedMinute</option>";
                    }
                }
                ?>
            </select>
            <div class="am-pm-toggle">
                <button type="button" class="am">AM</button>
                <button type="button" class="pm selected">PM</button>
            </div>
        </div>

        <div class="buttons">
            <button class="cancel">Cancel</button>
            <button class="apply">Apply</button>
        </div>
    </div>
</body>
</html>
