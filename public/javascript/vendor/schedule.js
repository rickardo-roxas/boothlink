
let schedulesDataElement = document.getElementById("schedule-week");
let schedules = JSON.parse(schedulesDataElement.value);

function populateScheduleThisWeek(schedules) {
    const tbody = document.querySelector('.table-schedule table tbody');
    tbody.innerHTML = '';

    const days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const dayCells = {};

    const row = document.createElement('tr');
    days.forEach(day => {
        const cell = document.createElement('td');
        cell.setAttribute('data-day', day);
        dayCells[day] = cell;
        row.appendChild(cell);
    });
    tbody.appendChild(row);

    if (schedules && schedules.length > 0) {
        schedules.forEach(schedule => {
            const date = new Date(schedule.date);
            const dayIndex = date.getDay();
            // map from Monday to Saturday
            const dayName = days[dayIndex - 1];

            if (dayCells[dayName]) {
                dayCells[dayName].innerHTML += `
                    <div class="schedule-entry">
                        <p>Room: ${schedule.locationRoom}</p>
                        <p>Stall: ${schedule.locationStallNum}</p>
                        <p>Start Time: ${schedule.startTime}</p>
                        <p>End Time: ${schedule.endTime}</p>
                    </div>
                `;
            }
        });
    } else {
        const emptyRow = document.createElement('tr');
        const emptyCell = document.createElement('td');
        emptyCell.colSpan = 6;
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
