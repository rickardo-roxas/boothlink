let orgDataElement = document.getElementById("org-data");
let organization = JSON.parse(orgDataElement.value);

let recentReservationsDataElement = document.getElementById("recent-reservations-data");
let recentReservations = JSON.parse(recentReservationsDataElement.value);

let schedulesDataElement = document.getElementById("schedule-data");
let schedules = JSON.parse(schedulesDataElement.value);

let salesTodayDataElement = document.getElementById("sales-today-data");
let salesToday = JSON.parse(salesTodayDataElement.value);

let salesWeekDataElement = document.getElementById("sales-week-data");
let salesWeek = JSON.parse(salesWeekDataElement.value);

let pendingDataElement = document.getElementById("pending-data");
let completedDataElement = document.getElementById("completed-data");
let totalDataElement = document.getElementById("total-reservation-data")

let itemDataElement = document.getElementById("item-data");
let foodDataElement = document.getElementById("food-data");
let serviceDataElement = document.getElementById("service-data");

function populateOrganization() {
    const nameElement = document.getElementById("dash-org-name");
    const imgElement = document.getElementById("dash-org-img");
    const fbElement = document.getElementById("fb-link");
    const igElement = document.getElementById("ig-link");
    const xElement = document.getElementById("x-link");

    nameElement.textContent = organization.name;
    imgElement.src += organization.image;

    fbElement.href = organization.fbLink.startsWith('http') ? organization.fbLink : 'http://' + organization.fbLink;
    fbElement.querySelector("p").textContent = organization.fbLink;

    igElement.href = organization.igLink.startsWith('http') ? organization.igLink : 'http://' + organization.igLink;
    igElement.querySelector("p").textContent = organization.igLink;

    xElement.href = organization.xLink.startsWith('http') ? organization.xLink : 'http://' + organization.xLink;
    xElement.querySelector("p").textContent = organization.xLink;
}

function populateRecentReservations() {
    const tbody = document.querySelector('#dash-recent-reservations tbody')
    tbody.innerHTML = '';

    if (recentReservations && recentReservations.length > 0) {
        recentReservations.forEach(recentReservation => {
            let row = document.createElement('tr');
            row.innerHTML = `
                <td>${recentReservation.id}</td>
                <td>${recentReservation.customer}</td>
                <td>${recentReservation.product}</td>
                <td>${recentReservation.quantity}</td>
                <td>₱ ${recentReservation.price}</td>
                <td>${recentReservation.status}</td>
            `;
            tbody.appendChild(row);
        })
    } else {
        const row = document.createElement('tr');
        const cell = document.createElement('td');
        cell.colSpan = 6;
        cell.textContent = "No recent reservations";
        cell.style.textAlign = "center";
        row.appendChild(cell);
        tbody.appendChild(row);
    }
}

function populateSchedule() {
    const tbody = document.querySelector('#dash-sched-table tbody');
    tbody.innerHTML = '';

    if (schedules && schedules.length > 0) {
        schedules.forEach(schedule => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${schedule.locationRoom}</td>
                <td>Stall #${schedule.locationStallNum}</td>
                <td>${schedule.startTime}</td>
                <td>${schedule.endTime}</td>
            `;
            tbody.appendChild(row);
        })
    } else {
        const row = document.createElement('tr');
        const cell = document.createElement('td');
        cell.colSpan = 4;
        cell.textContent = "No schedule today";
        cell.style.textAlign = "center";
        row.appendChild(cell);
        tbody.appendChild(row);
    }
}

function populateSales() {
    const salesTodayElement = document.getElementById("dash-sales-today");
    const salesWeekElement = document.getElementById("dash-sales-week");

    if (salesToday > 0) {
        salesTodayElement.textContent = salesToday;
    } else {
        salesTodayElement.textContent = "0.00";
    }

    if (salesWeek > 0) {
        salesWeekElement.textContent = salesWeek;
    } else {
        salesWeekElement.textContent = "0.00";
    }
}

function populateReservationsSummary() {
    const pendingElement = document.getElementById("pending-stats");
    const pendingPercentElement = document.getElementById("pending-percent");
    const completedElement = document.getElementById("completed-stats");
    const completedPercentElement = document.getElementById("completed-percent");

    const pendingProgressBar = document.getElementById("pending");
    const completedProgressBar = document.getElementById("completed");

    const totalValue = parseInt(totalDataElement.value) || 0;
    const pendingValue = parseInt(pendingDataElement.value) || 0;
    const completedValue = parseInt(completedDataElement.value) || 0;

    if (totalValue > 0) {
        const pendingPercent = (pendingValue / totalValue) * 100;
        const completedPercent = (completedValue / totalValue) * 100;

        pendingElement.textContent = `${pendingValue} reservation${pendingValue !== 1 ? 's' : ''}`;
        pendingPercentElement.textContent = pendingPercent.toFixed(0);

        completedElement.textContent = `${completedValue} reservation${completedValue !== 1 ? 's' : ''}`;
        completedPercentElement.textContent = completedPercent.toFixed(0);

        pendingProgressBar.style.width = `${pendingPercent}%`;
        completedProgressBar.style.width = `${completedPercent}%`;
    } else {
        pendingElement.textContent = "0 reservations";
        pendingPercentElement.textContent = "0";
        pendingProgressBar.style.width = "0";

        completedElement.textContent = "0 reservations";
        completedPercentElement.textContent = "0";
        completedProgressBar.style.width = "0";
    }
}

function populateTotalReservations() {
    const itemElement = document.getElementById("item-count");
    const foodElement = document.getElementById("food-count");
    const serviceElement = document.getElementById("service-count");

    const itemCount = parseInt(itemDataElement.value) || 0;
    const foodCount = parseInt(foodDataElement.value) || 0;
    const serviceCount = parseInt(serviceDataElement.value) || 0;

    itemElement.textContent = `${itemCount}`;
    foodElement.textContent = `${foodCount}`;
    serviceElement.textContent = `${serviceCount}`;
}

populateOrganization();
populateRecentReservations();
populateSchedule();
populateSales();
populateReservationsSummary();
populateTotalReservations();