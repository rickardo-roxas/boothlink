let reservationsDataElement = document.getElementById('reservations-data');
let reservations = JSON.parse(reservationsDataElement.value);

function populateTable(reservations) {
    const tbody = document.querySelector('.table-products tbody');
    tbody.innerHTML = '';

    let row;
    if (reservations.length > 0) {
        reservations.forEach(reservation => {
            row = document.createElement('tr');
            row.innerHTML = `
            <td>${reservation.id}</td>
            <td>${reservation.date}</td>
            <td>${reservation.product}</td>
            <td>${reservation.quantity}</td>
            <td>${reservation.category}</td>
            <td>₱ ${reservation.price}</td>
            <td>${reservation.status}</td>
            <td>${reservation.customer}</td>
            <td>
                <button>Accept</button>
                <button>Reject</button>
            </td>
        `;
            tbody.appendChild(row);
        });
    } else {
        row = document.createElement('tr');
        const cell = document.createElement('td');
        cell.colSpan = 8;
        cell.textContent = "No recent reservations";
        cell.style.textAlign = "center";
        row.appendChild(cell);
        tbody.appendChild(row);
    }

}

populateTable(reservations);