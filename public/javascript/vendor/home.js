document.addEventListener("DOMContentLoaded", () => {
    // Example of updating organization information
    const orgName = document.querySelector("#dash-org h3");
    const orgImage = document.querySelector("#dash-org img");
    const orgLinks = document.querySelectorAll("#dash-org .soc-med");

    orgName.textContent = organizationData.name;
    orgImage.src = organizationData.image;

    orgLinks[0].href = organizationData.socialMedia.facebook;
    orgLinks[1].href = organizationData.socialMedia.instagram;
    orgLinks[2].href = organizationData.socialMedia.twitter;

    // Update recent reservations table
    const reservationsTable = document.querySelector("#dash-reservations table tbody");
    reservationsData.forEach(reservation => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${reservation.id}</td>
            <td>${reservation.customer}</td>
            <td>${reservation.product}</td>
            <td>${reservation.qty}</td>
            <td>${reservation.price}</td>
            <td>${reservation.status}</td>
        `;
        reservationsTable.appendChild(row);
    });

    // Example: update sales data
    document.querySelector("#dash-sales .column-container p").textContent = `Php ${salesToday}`;
});

function populateOrganization(organization)