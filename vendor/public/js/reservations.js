let reservationsDataElement = document.getElementById('reservations-data');
let reservations = JSON.parse(reservationsDataElement.value);

function populateTable(reservations) {
    const tbody = document.querySelector('.table-products tbody');
    tbody.innerHTML = '';

    if (reservations.length > 0) {
        reservations.forEach(reservation => {
            let actionButtonsHTML = '';

            if (reservation.status === "Pending") {
                actionButtonsHTML = `
                    <td class="actions-column">
                        <form action="/cs-312_boothlink/reservations/complete" method="POST"  onsubmit="return confirm('Are you sure you want to accept this reservation?')">
                            <input type="hidden" name="reservation_id" value="${reservation.id}">
                            <input type="hidden" name="customer_id" value="${reservation.customer_id}">
                            <input type="hidden" name="grand_total" value="${reservation.price}">
                            <button class="accept-btn" type="submit">Mark As Completed</button>
                        </form>
                        <form action="/cs-312_boothlink/reservations/reject" method="POST" onsubmit="return confirm('Are you sure you want to reject this reservation?')">
                            <input type="hidden" name="reservation_id" value="${reservation.id}">
                            <button class="reject-btn" type="submit">Reject</button>
                        </form>
                    </td>
                `;
            } else {
                actionButtonsHTML = `<td></td>`;
            }

            const rowHTML = `
                <tr>
                    <td>${reservation.id}</td>
                    <td>${formatDate(reservation.date)}</td>
                    <td>${reservation.product}</td>
                    <td>${reservation.quantity}</td>
                    <td><span class="category-text">${reservation.category}</span></td>
                    <td>₱ <span style="text-align: right">${parseFloat(reservation.price).toFixed(2)}</span></td>
                    <td>${reservation.status}</td>
                    <td>${reservation.customer}</td>
                    ${actionButtonsHTML}
                </tr>
            `;
            // Append the row only once
            tbody.insertAdjacentHTML('beforeend', rowHTML);
        });
    } else {
        const noReservationsRow = `
            <tr>
                <td colspan="8" style="text-align: center;">No reservations</td>
            </tr>
        `;
        tbody.innerHTML = noReservationsRow;
    }
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('en-US', { month: 'short', day: 'numeric', year: 'numeric' }).format(date);
}

populateTable(reservations);
