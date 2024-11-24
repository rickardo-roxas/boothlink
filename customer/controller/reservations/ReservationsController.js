const model = require('../../model/reservations/Reservations');

var reservations;

const index = (req, res) => {
    const username = req.session.username;
    const filter = req.query.filter || 'All'; // Default to 'All' if no filter is provided

    // If no filter is selected, get all reservations; otherwise, get filtered reservations by status
    if (filter === 'All') {
        model.getReservations(username)
            .then(reservations => {
                res.render('reservations/reservations_view', {
                    title: "Reservations",
                    reservations: reservations,
                    filter: filter
                });
            })
            .catch(err => {
                console.error('Error fetching reservations:', err);
                res.status(500).send('Internal Server Error');
            });
    } else {
        model.getReservationsByStatus(filter)
            .then(reservations => {
                res.render('reservations/reservations_view', {
                    title: "Reservations",
                    reservations: reservations,
                    filter: filter
                });
            })
            .catch(err => {
                console.error('Error fetching reservations:', err);
                res.status(500).send('Internal Server Error');
            });
    }
}

module.exports = {
    index
}
