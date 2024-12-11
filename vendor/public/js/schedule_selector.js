(function() {
    let selectedDate = null;

    // Highlight today's date in the calendar
    function highlightToday() {
        const today = new Date();
        const todayStr = today.toISOString().split('T')[0]; // Format as YYYY-MM-DD
        document.querySelectorAll("td[data-day]").forEach(cell => {
            if (cell.dataset.date === todayStr) {
                cell.classList.add('today');
            }
        });
    }

    // Function to highlight current date
    highlightToday();

    document.querySelectorAll("td[data-day]").forEach(cell => {
        cell.addEventListener("click", function() {
            const selectedDay = parseInt(cell.dataset.day);
            const selectedDateStr = cell.dataset.date; // Format: YYYY-MM-DD
            const today = new Date();
            const todayStr = today.toISOString().split('T')[0]; // Format as YYYY-MM-DD

            const dayOfWeek = new Date(selectedDateStr).getDay();
            if (dayOfWeek === 0) {
                alert("You cannot select a date on Sunday.");
                return;
            }

            if (selectedDay < today.getDate() || selectedDateStr < todayStr) {
                alert("You cannot select a past date.");
            } else {
                document.querySelectorAll("td.selected").forEach(selected => {
                    selected.classList.remove("selected");
                });
                cell.classList.add("selected"); // Highlight newly selected date
                selectedDate = selectedDateStr; // Store the selected date

                // Set the hidden input field with the selected date
                document.getElementById('selected-date').value = selectedDate; // This stores the selected date

                document.querySelectorAll("td.today").forEach(todayCell => {
                    todayCell.classList.remove('today');
                });
            }
        });
    });



    // AM/PM toggle buttons
    document.querySelectorAll(".am-pm-toggle").forEach(toggle => {
        toggle.querySelectorAll("button").forEach(button => {
            button.addEventListener("click", function() {
                toggle.querySelectorAll(".selected").forEach(selected => {
                    selected.classList.remove("selected");
                });
                button.classList.add("selected");
            });
        });
    });

    // Add click event listener for the Apply button
    document.querySelector('.apply').addEventListener('click', function(event) {
        event.preventDefault();

        if (!selectedDate) {
            alert("Please select a date.");
            return;
        }

        const startTimeSelect = document.getElementById('start-time');
        const endTimeSelect = document.getElementById('end-time');

        // Get the selected start and end times
        const selectedStartTime = startTimeSelect.value;
        const selectedAMPM = document.querySelector(".am-pm-toggle .selected").textContent;
        const startTimeForSQL = formatTimeForSQL(selectedStartTime, selectedAMPM);

        const selectedEndTime = endTimeSelect.value;
        const selectedEndAMPM = document.querySelector("#end-time + .am-pm-toggle .selected").textContent;
        const endTimeForSQL = formatTimeForSQL(selectedEndTime, selectedEndAMPM);

        // Set the hidden inputs for SQL
        document.getElementById('selected-date').value = selectedDate;
        document.getElementById('selected-start-time').value = startTimeForSQL;
        document.getElementById('selected-end-time').value = endTimeForSQL;

        document.querySelector('form').submit(); // Submit the form
    });

    // Format time in HH:MM:SS format
    function formatTimeForSQL(time, amPm) {
        amPm = amPm.toUpperCase();

        let [hour, minute] = time.split(':').map(Number);

        if (amPm === 'PM' && hour < 12) {
            hour += 12; // Convert PM hour to 24-hour format
        } else if (amPm === 'AM' && hour === 12) {
            hour = 0; // Convert 12 AM to 0 hour
        }

        // Ensure the time format is HH:MM:00 for SQL
        return `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}:00`;
    }
})();
