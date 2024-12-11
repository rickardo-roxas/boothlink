let schedulesDataElement = document.getElementById("schedule-week");
let schedules = JSON.parse(schedulesDataElement.value);

function populateScheduleThisWeek(schedules) {
    const tbody = document.querySelector('.table-schedule table tbody');
    const thead = document.querySelector('.table-schedule table thead');

    // Clear previous schedules
    tbody.innerHTML = '';

    // Create table headers once, if they don't already exist
    if (thead && thead.rows.length === 0) {
        const headerRow = document.createElement('tr');
        const days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        days.forEach(day => {
            const cell = document.createElement('th');  // <th> for header
            cell.textContent = day;
            headerRow.appendChild(cell);
        });
        thead.appendChild(headerRow);
    }

    const days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayIndexMap = {
        "Monday": 1,
        "Tuesday": 2,
        "Wednesday": 3,
        "Thursday": 4,
        "Friday": 5,
        "Saturday": 6
    };

    // Create a row for each schedule
    schedules.forEach(schedule => {
        const date = new Date(schedule.date);
        const dayIndex = date.getDay();  // Get the day of the week (0 = Sunday, 1 = Monday, etc.)
        const dayName = days[dayIndex - 1];  // Adjust for Monday to Saturday mapping

        const row = document.createElement('tr');  // Create a new row for each schedule

        // Add empty cells for days before the target day
        for (let i = 0; i < dayIndex - 1; i++) {
            const emptyCell = document.createElement('td');
            row.appendChild(emptyCell);
        }

        // Add the schedule to the correct day column
        const scheduleCell = document.createElement('td');
        scheduleCell.innerHTML = `
            <div class="schedule-entry">
                <p>Room: ${schedule.locationRoom}</p>
                <p>Stall: ${schedule.locationStallNum}</p>
                <p>Start Time: ${schedule.startTime}</p>
                <p>End Time: ${schedule.endTime}</p>
            </div>
        `;
        row.appendChild(scheduleCell);

        // Add empty cells for the rest of the days
        for (let i = dayIndex; i < 6; i++) {
            const emptyCell = document.createElement('td');
            row.appendChild(emptyCell);
        }

        // Append the row to the table body
        tbody.appendChild(row);
    });

    // If no schedules exist at all, display a message in the table
    if (schedules.length === 0) {
        const emptyRow = document.createElement('tr');
        const emptyCell = document.createElement('td');
        emptyCell.colSpan = 7; // One cell per day (7 days)
        emptyCell.textContent = "No schedules for this week";
        emptyCell.style.textAlign = "center";
        emptyRow.appendChild(emptyCell);
        tbody.appendChild(emptyRow);
    }
}

// Open pop up
function openSchedulePopup() {
    document.getElementById("schedule-popup").style.display = "flex";
}

// Close pop up
function closeSchedulePopup() {
    document.getElementById("schedule-popup").style.display = "none";
}

// Close pop up by clicking outside of it
window.onclick = function(event) {
    var popup = document.getElementById("schedule-popup");
    if (event.target == popup) {
        closeSchedulePopup();
    }
};

populateScheduleThisWeek(schedules);
