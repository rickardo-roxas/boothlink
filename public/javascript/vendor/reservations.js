let reservationsDataElement = document.getElementById('reservations-data');
let reservations = JSON.parse(reservationsDataElement.value);

function populateTable(reservations) {
    const tbody = document.querySelector('.table-products tbody');
    tbody.innerHTML = '';

    if (reservations.length > 0) {
        reservations.forEach(reservation => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${reservation.id}</td>
                <td>${reservation.date}</td>
                <td>${reservation.product}</td>
                <td>${reservation.quantity}</td>
                <td>${reservation.category}</td>
                <td>₱ ${parseFloat(reservation.price).toFixed(2)}</td>
                <td>${reservation.status}</td>
                <td>${reservation.customer}</td>
            `;

            // Add buttons only if the status is "Pending"
            if (reservation.status === "Pending") {
                const actionCell = document.createElement('td');
                const acceptButton = document.createElement('button');
                const rejectButton = document.createElement('button');

                acceptButton.className = "btn-file"
                rejectButton.className = "btn-file"

                acceptButton.textContent = "Accept";
                rejectButton.textContent = "Reject";

                actionCell.appendChild(acceptButton);
                actionCell.appendChild(rejectButton);
                row.appendChild(actionCell);

                // addActionListeners(row, reservation.id);
            } else {
                const td = document.createElement('td');
                row.appendChild(td);
            }

            tbody.appendChild(row);
        });
    } else {
        const row = document.createElement('tr');
        const cell = document.createElement('td');
        cell.colSpan = 8;
        cell.textContent = "No reservations";
        cell.style.textAlign = "center";
        row.appendChild(cell);
        tbody.appendChild(row);
    }
}

function addActionListeners(row, reservationId) {
    const acceptButton = row.querySelector('.accept-btn');
    const rejectButton = row.querySelector('.reject-btn');

    acceptButton.addEventListener('click', function () {
        // Handle accept action (e.g., send a request to the server to change status)
        console.log(`Accept reservation with ID: ${reservationId}`);
    });

    rejectButton.addEventListener('click', function () {
        // Handle reject action (e.g., send a request to the server to change status)
        console.log(`Reject reservation with ID: ${reservationId}`);
    });
}

populateTable(reservations);