(function() {
    let selectedDate = null; 

    // Highlight today's date in the calendar
    function highlightToday() {
        const today = new Date();
        const todayStr = `${today.getFullYear()}-${today.getMonth() + 1}-${today.getDate()}`;
        document.querySelectorAll("td[data-day]").forEach(cell => {
            if (cell.dataset.date === todayStr) {
                cell.classList.add('today'); 
            }
        });
    }

    // function to highlight current date
    highlightToday();

    document.querySelectorAll("td[data-day]").forEach(cell => {
        cell.addEventListener("click", function() {
            const selectedDay = parseInt(cell.dataset.day);
            const selectedDateStr = cell.dataset.date;
            const today = new Date();
            const todayStr = `${today.getFullYear()}-${today.getMonth() + 1}-${today.getDate()}`;

            const dayOfWeek = new Date(selectedDateStr).getDay();
            if (dayOfWeek === 0) {
                alert("You cannot select a date on Sunday."); // Prevent selection of Sundays
                return;
            }

            if (selectedDay < today.getDate() || selectedDateStr < todayStr) {
                alert("You cannot select a past date."); // Prevent selection of past dates
                return;
            } else {
                document.querySelectorAll("td.selected").forEach(selected => {
                    selected.classList.remove("selected"); // Remove highlight from previously selected date
                });
                cell.classList.add("selected"); // Highlight newly selected date
                selectedDate = selectedDateStr; // Store the selected date

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
        event.preventDefault(); // Prevent form submission 

        if (!selectedDate) {
            alert("Please select a date."); // Alert if no date is selected
            return;
        }

        const startTimeSelect = document.getElementById('start-time');
        const endTimeSelect = document.getElementById('end-time');

        const selectedStartTime = startTimeSelect.value;
        const selectedAMPM = document.querySelector(".am-pm-toggle .selected").textContent;
        const startTimeInMinutes = getTimeIn24HourFormat(selectedStartTime, selectedAMPM); 

        if (startTimeInMinutes > getTimeIn24HourFormat("07:00", "AM")) {
            alert("Start time must be 7 AM or later."); // Alert if start time is before 7 AM
            return;
        }

        const selectedEndTime = endTimeSelect.value;
        const selectedEndAMPM = document.querySelector("#end-time + .am-pm-toggle .selected").textContent;
        const endTimeInMinutes = getTimeIn24HourFormat(selectedEndTime, selectedEndAMPM); 

        if (endTimeInMinutes < startTimeInMinutes) {
            alert("End time cannot be earlier than start time."); // Alert if end time is before start time
            return;
        }

        if (endTimeInMinutes > getTimeIn24HourFormat("19:00", "PM")) {
            alert("End time must be 7 PM or earlier."); // Alert if end time is after 7 PM
            return;
        }

        alert("Selected date and times are valid!"); // for validation only
    });

    // Convert time to 24-hour format in total minutes
    function getTimeIn24HourFormat(time, amPm) {
        let [hour, minute] = time.split(':').map(Number);
        if (amPm === 'PM' && hour < 12) {
            hour += 12; // Convert PM hour to 24-hour format
        } else if (amPm === 'AM' && hour === 12) {
            hour = 0; // Convert 12 AM to 0 hour
        }
        return hour * 60 + minute; 
    }
})();
